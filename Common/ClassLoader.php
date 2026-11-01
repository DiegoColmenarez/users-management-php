<?php

declare(strict_types=1);

final class ClassLoader
{
    /**
     * @var array<string, string>
     */
    private static array $classMap = array(
        'InvalidUserEmailException' => 'Domain/Exceptions/InvalidUserEmailException.php',
        'InvalidUserIdException' => 'Domain/Exceptions/InvalidUserIdException.php',
        'InvalidUserNameException' => 'Domain/Exceptions/InvalidUserNameException.php',
        'InvalidUserPasswordException' => 'Domain/Exceptions/InvalidUserPasswordException.php',
        'InvalidUserRoleException' => 'Domain/Exceptions/InvalidUserRoleException.php',
        'InvalidUserStatusException' => 'Domain/Exceptions/InvalidUserStatusException.php',
        'UserAlreadyExistsException' => 'Domain/Exceptions/UserAlreadyExistsException.php',
        'UserNotFoundException' => 'Domain/Exceptions/UserNotFoundException.php',
        'InvalidCredentialsException' => 'Domain/Exceptions/InvalidCredentialsException.php',
        'InvalidComputerBrandException' => 'Domain/Exceptions/InvalidComputerBrandException.php',
        'InvalidComputerConnectivityException' => 'Domain/Exceptions/InvalidComputerConnectivityException.php',
        'InvalidComputerDisplayException' => 'Domain/Exceptions/InvalidComputerDisplayException.php',
        'InvalidComputerIdException' => 'Domain/Exceptions/InvalidComputerIdException.php',
        'InvalidComputerMemoryException' => 'Domain/Exceptions/InvalidComputerMemoryException.php',
        'InvalidComputerPriceException' => 'Domain/Exceptions/InvalidComputerPriceException.php',
        'InvalidComputerProcessorException' => 'Domain/Exceptions/InvalidComputerProcessorException.php',
        'InvalidComputerStorageException' => 'Domain/Exceptions/InvalidComputerStorageException.php',
        'ComputerAlreadyExistsException' => 'Domain/Exceptions/ComputerAlreadyExistsException.php',
        'ComputerNotFoundException' => 'Domain/Exceptions/ComputerNotFoundException.php',

        'UserRoleEnum' => 'Domain/Enums/UserRoleEnum.php',
        'UserStatusEnum' => 'Domain/Enums/UserStatusEnum.php',
        'CategoryEnum' => 'Domain/Enums/CategoryEnum.php',

        'UserId' => 'Domain/ValueObjects/UserId.php',
        'UserName' => 'Domain/ValueObjects/UserName.php',
        'UserEmail' => 'Domain/ValueObjects/UserEmail.php',
        'UserPassword' => 'Domain/ValueObjects/UserPassword.php',
        'ComputerId' => 'Domain/ValueObjects/ComputerId.php',
        'ComputerBrand' => 'Domain/ValueObjects/ComputerBrand.php',
        'ComputerProcessor' => 'Domain/ValueObjects/ComputerProcessor.php',
        'ComputerMemory' => 'Domain/ValueObjects/ComputerMemory.php',
        'ComputerStorage' => 'Domain/ValueObjects/ComputerStorage.php',
        'ComputerConnectivity' => 'Domain/ValueObjects/ComputerConnectivity.php',
        'ComputerDisplay' => 'Domain/ValueObjects/ComputerDisplay.php',
        'ComputerPrice' => 'Domain/ValueObjects/ComputerPrice.php',

        'UserModel' => 'Domain/Models/UserModel.php',
        'ComputerModel' => 'Domain/Models/ComputerModel.php',
        'EmailDestinationModel' => 'Domain/Models/EmailDestinationModel.php',
        'EmailSenderException' => 'Domain/Exceptions/EmailSenderException.php',
        'EmailSenderPort' => 'Application/Ports/Out/EmailSenderPort.php',
        'EmailNotificationService' => 'Application/Services/EmailNotificationService.php',
        'EmailSenderService' => 'Infrastructure/Adapters/Email/EmailSenderService.php',

        'CreateUserUseCase' => 'Application/Ports/In/CreateUserUseCase.php',
        'UpdateUserUseCase' => 'Application/Ports/In/UpdateUserUseCase.php',
        'GetUserByIdUseCase' => 'Application/Ports/In/GetUserByIdUseCase.php',
        'GetAllUsersUseCase' => 'Application/Ports/In/GetAllUsersUseCase.php',
        'DeleteUserUseCase' => 'Application/Ports/In/DeleteUserUseCase.php',
        'LoginUseCase' => 'Application/Ports/In/LoginUseCase.php',
        'CreateComputerUseCase' => 'Application/Ports/In/CreateComputerUseCase.php',
        'UpdateComputerUseCase' => 'Application/Ports/In/UpdateComputerUseCase.php',
        'GetComputerByIdUseCase' => 'Application/Ports/In/GetComputerByIdUseCase.php',
        'GetAllComputersUseCase' => 'Application/Ports/In/GetAllComputersUseCase.php',
        'DeleteComputerUseCase' => 'Application/Ports/In/DeleteComputerUseCase.php',

        'SaveUserPort' => 'Application/Ports/Out/SaveUserPort.php',
        'UpdateUserPort' => 'Application/Ports/Out/UpdateUserPort.php',
        'GetUserByIdPort' => 'Application/Ports/Out/GetUserByIdPort.php',
        'GetUserByEmailPort' => 'Application/Ports/Out/GetUserByEmailPort.php',
        'GetAllUsersPort' => 'Application/Ports/Out/GetAllUsersPort.php',
        'DeleteUserPort' => 'Application/Ports/Out/DeleteUserPort.php',
        'SaveComputerPort' => 'Application/Ports/Out/SaveComputerPort.php',
        'UpdateComputerPort' => 'Application/Ports/Out/UpdateComputerPort.php',
        'GetComputerByIdPort' => 'Application/Ports/Out/GetComputerByIdPort.php',
        'GetAllComputersPort' => 'Application/Ports/Out/GetAllComputersPort.php',
        'DeleteComputerPort' => 'Application/Ports/Out/DeleteComputerPort.php',

        'CreateUserCommand' => 'Application/Services/Dto/Commands/CreateUserCommand.php',
        'UpdateUserCommand' => 'Application/Services/Dto/Commands/UpdateUserCommand.php',
        'DeleteUserCommand' => 'Application/Services/Dto/Commands/DeleteUserCommand.php',
        'LoginCommand' => 'Application/Services/Dto/Commands/LoginCommand.php',
        'GetUserByIdQuery' => 'Application/Services/Dto/Queries/GetUserByIdQuery.php',
        'GetAllUsersQuery' => 'Application/Services/Dto/Queries/GetAllUsersQuery.php',
        'SaveComputerCommand' => 'Application/Services/Dto/Commands/SaveComputerCommand.php',

        'CreateUserService' => 'Application/Services/CreateUserService.php',
        'UpdateUserService' => 'Application/Services/UpdateUserService.php',
        'GetUserByIdService' => 'Application/Services/GetUserByIdService.php',
        'GetAllUsersService' => 'Application/Services/GetAllUsersService.php',
        'DeleteUserService' => 'Application/Services/DeleteUserService.php',
        'LoginService' => 'Application/Services/LoginService.php',
        'UserApplicationMapper' => 'Application/Services/Mappers/UserApplicationMapper.php',
        'CreateComputerService' => 'Application/Services/CreateComputerService.php',
        'UpdateComputerService' => 'Application/Services/UpdateComputerService.php',
        'GetComputerByIdService' => 'Application/Services/GetComputerByIdService.php',
        'GetAllComputersService' => 'Application/Services/GetAllComputersService.php',
        'DeleteComputerService' => 'Application/Services/DeleteComputerService.php',

        'Connection' => 'Infrastructure/Adapters/Persistence/MySQL/Config/Connection.php',
        'UserPersistenceDto' => 'Infrastructure/Adapters/Persistence/MySQL/Dto/UserPersistenceDto.php',
        'UserEntity' => 'Infrastructure/Adapters/Persistence/MySQL/Entity/UserEntity.php',
        'UserPersistenceMapper' => 'Infrastructure/Adapters/Persistence/MySQL/Mapper/UserPersistenceMapper.php',
        'UserRepositoryMySQL' => 'Infrastructure/Adapters/Persistence/MySQL/Repository/UserRepositoryMySQL.php',
        'ComputerPersistenceMapper' => 'Infrastructure/Adapters/Persistence/MySQL/Mapper/ComputerPersistenceMapper.php',
        'ComputerRepositoryMySQL' => 'Infrastructure/Adapters/Persistence/MySQL/Repository/ComputerRepositoryMySQL.php',

        'CreateUserWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/CreateUserRequest.php',
        'UpdateUserWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/UpdateUserRequest.php',
        'LoginWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/LoginWebRequest.php',
        'UserResponse' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/UserResponse.php',
        'UserWebMapper' => 'Infrastructure/Entrypoints/Web/Controllers/Mapper/UserWebMapper.php',
        'UserController' => 'Infrastructure/Entrypoints/Web/Controllers/UserController.php',
        'ComputerWebMapper' => 'Infrastructure/Entrypoints/Web/Controllers/Mapper/ComputerWebMapper.php',
        'ComputerController' => 'Infrastructure/Entrypoints/Web/Controllers/ComputerController.php',
        'WebRoutes' => 'Infrastructure/Entrypoints/Web/Controllers/Config/WebRoutes.php',

        'View' => 'Infrastructure/Entrypoints/Web/Presentation/View.php',
        'Flash' => 'Infrastructure/Entrypoints/Web/Presentation/Flash.php',

        'DependencyInjection' => 'Common/DependencyInjection.php',
    );

    public static function register(): void
    {
        spl_autoload_register(array(self::class, 'loadClass'));
    }

    public static function loadClass(string $className): void
    {
        if (!isset(self::$classMap[$className])) {
            return;
        }

        $baseDir = dirname(__DIR__) . DIRECTORY_SEPARATOR;
        $filePath = $baseDir . self::$classMap[$className];

        if (!file_exists($filePath)) {
            throw new RuntimeException(
                sprintf('No se encontró el archivo para la clase %s en %s', $className, $filePath)
            );
        }

        require_once $filePath;
    }
}