<?php

declare(strict_types=1);

require_once __DIR__ . '/ClassLoader.php';
require_once __DIR__ . '/EnvLoader.php';

final class DependencyInjection
{
    public static function boot(): void
    {
        EnvLoader::load(dirname(__DIR__) . '/.env');
        ClassLoader::register();
    }

    public static function getConnection(): Connection
    {
        ClassLoader::loadClass('Connection');

        return new Connection(
            host: EnvLoader::get('DB_HOST', '127.0.0.1'),
            port: EnvLoader::getInt('DB_PORT', 3306),
            database: EnvLoader::get('DB_DATABASE', 'crud_usuarios'),
            username: EnvLoader::get('DB_USERNAME', 'root'),
            password: EnvLoader::get('DB_PASSWORD', ''),
            charset: EnvLoader::get('DB_CHARSET', 'utf8mb4')
        );
    }

    public static function getPdo(): PDO
    {
        return self::getConnection()->createPdo();
    }

    public static function getUserPersistenceMapper(): UserPersistenceMapper
    {
        ClassLoader::loadClass('UserPersistenceMapper');

        return new UserPersistenceMapper();
    }

    public static function getUserRepository(): UserRepositoryMySQL
    {
        ClassLoader::loadClass('UserRepositoryMySQL');

        return new UserRepositoryMySQL(
            self::getPdo(),
            self::getUserPersistenceMapper()
        );
    }

    public static function getEmailSenderService(): EmailSenderService
    {
        ClassLoader::loadClass('EmailSenderService');

        return new EmailSenderService(
            host: EnvLoader::get('SMTP_HOST', 'smtp.gmail.com'),
            username: EnvLoader::get('SMTP_USERNAME', ''),
            password: EnvLoader::get('SMTP_PASSWORD', ''),
            fromAddress: EnvLoader::get('SMTP_FROM_ADDRESS', ''),
            fromName: EnvLoader::get('SMTP_FROM_NAME', 'CRUD Usuarios'),
            encryption: EnvLoader::get('SMTP_ENCRYPTION', 'tls'),
            port: EnvLoader::getInt('SMTP_PORT', 587)
        );
    }

    public static function getEmailNotificationService(): EmailNotificationService
    {
        ClassLoader::loadClass('EmailNotificationService');

        return new EmailNotificationService(
            self::getEmailSenderService()
        );
    }

    public static function getCreateUserUseCase(): CreateUserUseCase
    {
        ClassLoader::loadClass('CreateUserService');
        $repository = self::getUserRepository();

        return new CreateUserService(
            $repository,
            $repository,
            self::getEmailNotificationService()
        );
    }

    public static function getUpdateUserUseCase(): UpdateUserUseCase
    {
        ClassLoader::loadClass('UpdateUserService');
        $repository = self::getUserRepository();

        return new UpdateUserService(
            $repository,
            $repository,
            $repository,
            self::getEmailNotificationService()
        );
    }

    public static function getGetUserByIdUseCase(): GetUserByIdUseCase
    {
        ClassLoader::loadClass('GetUserByIdService');

        return new GetUserByIdService(
            self::getUserRepository()
        );
    }

    public static function getGetAllUsersUseCase(): GetAllUsersUseCase
    {
        ClassLoader::loadClass('GetAllUsersService');

        return new GetAllUsersService(
            self::getUserRepository()
        );
    }

    public static function getDeleteUserUseCase(): DeleteUserUseCase
    {
        ClassLoader::loadClass('DeleteUserService');
        $repository = self::getUserRepository();

        return new DeleteUserService(
            $repository,
            $repository
        );
    }

    public static function getUserWebMapper(): UserWebMapper
    {
        ClassLoader::loadClass('UserWebMapper');

        return new UserWebMapper();
    }

    public static function getUserController(): UserController
    {
        ClassLoader::loadClass('UserController');

        return new UserController(
            self::getCreateUserUseCase(),
            self::getUpdateUserUseCase(),
            self::getGetUserByIdUseCase(),
            self::getGetAllUsersUseCase(),
            self::getDeleteUserUseCase(),
            self::getUserWebMapper()
        );
    }

    public static function getComputerRepository(): ComputerRepositoryMySQL
    {
        self::validateComputerDatabaseConfiguration();
        ClassLoader::loadClass('ComputerRepositoryMySQL');
        ClassLoader::loadClass('ComputerPersistenceMapper');

        $pdo = self::getPdo();
        $pdo->query(
            'SELECT id, brand, category, cpu_brand, cpu_speed, ram_technology, ' .
            'ram_capacity, storage_technology, storage_capacity, usb_ports, ' .
            'hdmi_ports, monitor_brand, screen_size_inches, price ' .
            'FROM computers LIMIT 0'
        );

        return new ComputerRepositoryMySQL($pdo, new ComputerPersistenceMapper());
    }

    public static function getComputerController(): ComputerController
    {
        ClassLoader::loadClass('ComputerController');
        ClassLoader::loadClass('CreateComputerService');
        ClassLoader::loadClass('UpdateComputerService');
        ClassLoader::loadClass('GetComputerByIdService');
        ClassLoader::loadClass('GetAllComputersService');
        ClassLoader::loadClass('DeleteComputerService');

        $repository = self::getComputerRepository();

        return new ComputerController(
            new CreateComputerService($repository),
            new UpdateComputerService($repository, $repository),
            new GetComputerByIdService($repository),
            new GetAllComputersService($repository),
            new DeleteComputerService($repository, $repository),
            new ComputerWebMapper()
        );
    }

    private static function validateComputerDatabaseConfiguration(): void
    {
        foreach (array('DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_CHARSET') as $key) {
            if (EnvLoader::get($key) === '') {
                throw new RuntimeException('La configuración de base de datos requiere ' . $key . '.');
            }
        }

        $port = EnvLoader::get('DB_PORT');
        if (filter_var($port, FILTER_VALIDATE_INT) === false || (int) $port < 1) {
            throw new RuntimeException('DB_PORT debe ser un puerto válido.');
        }

        if (!array_key_exists('DB_PASSWORD', $_ENV) && getenv('DB_PASSWORD') === false) {
            throw new RuntimeException('La configuración de base de datos requiere DB_PASSWORD.');
        }
    }

    public static function getLoginUseCase(): LoginUseCase
    {
        ClassLoader::loadClass('LoginService');

        return new LoginService(
            self::getUserRepository()
        );
    }
}