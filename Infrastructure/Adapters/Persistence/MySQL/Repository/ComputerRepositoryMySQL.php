<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../../../Application/Ports/Out/SaveComputerPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetComputerByIdPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetAllComputersPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/UpdateComputerPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/DeleteComputerPort.php';
require_once __DIR__ . '/../Mapper/ComputerPersistenceMapper.php';
require_once __DIR__ . '/../../../../../Domain/Exceptions/ComputerNotFoundException.php';

use Domain\Models\ComputerModel;
use Domain\ValueObjects\ComputerId;

final class ComputerRepositoryMySQL implements
    SaveComputerPort,
    GetComputerByIdPort,
    GetAllComputersPort,
    UpdateComputerPort,
    DeleteComputerPort
{
    private PDO $pdo;
    private ComputerPersistenceMapper $mapper;

    public function __construct(PDO $pdo, ComputerPersistenceMapper $mapper)
    {
        $this->pdo = $pdo;
        $this->mapper = $mapper;
    }

    public function save(ComputerModel $computer): ComputerModel
    {
        $data = $this->mapper->fromModelToArray($computer);
        $columns = array_keys($data);
        $placeholders = array_map(
            static fn (string $column): string => ':' . $column,
            $columns
        );

        $sql = sprintf(
            'INSERT INTO computers (%s) VALUES (%s)',
            implode(', ', $columns),
            implode(', ', $placeholders)
        );

        $statement = $this->pdo->prepare($sql);
        $statement->execute($this->toParameters($data));

        return $computer;
    }

    public function getById(ComputerId $computerId): ?ComputerModel
    {
        $sql = '
            SELECT
                id,
                brand,
                category,
                cpu_brand,
                cpu_speed,
                ram_technology,
                ram_capacity,
                storage_technology,
                storage_capacity,
                usb_ports,
                hdmi_ports,
                monitor_brand,
                screen_size_inches,
                price
            FROM computers
            WHERE id = :id
            LIMIT 1
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $computerId->value(),
        ));

        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        return $this->mapper->fromArrayToModel($row);
    }

    /**
     * @return ComputerModel[]
     */
    public function getAll(): array
    {
        $sql = '
            SELECT
                id,
                brand,
                category,
                cpu_brand,
                cpu_speed,
                ram_technology,
                ram_capacity,
                storage_technology,
                storage_capacity,
                usb_ports,
                hdmi_ports,
                monitor_brand,
                screen_size_inches,
                price
            FROM computers
            ORDER BY brand ASC
        ';

        $rows = $this->pdo->query($sql)->fetchAll();

        return $this->mapper->fromRowsToModels($rows);
    }

    public function update(ComputerModel $computer): ComputerModel
    {
        $data = $this->mapper->fromModelToArray($computer);
        unset($data['id']);

        $assignments = array_map(
            static fn (string $column): string => $column . ' = :' . $column,
            array_keys($data)
        );

        $sql = sprintf(
            'UPDATE computers SET %s WHERE id = :id',
            implode(', ', $assignments)
        );

        $statement = $this->pdo->prepare($sql);
        $parameters = $this->toParameters($data);
        $parameters[':id'] = $computer->id()->value();
        $statement->execute($parameters);

        if ($statement->rowCount() === 0 && $this->getById($computer->id()) === null) {
            throw ComputerNotFoundException::becauseIdWasNotFound($computer->id()->value());
        }

        return $computer;
    }

    public function delete(ComputerId $computerId): void
    {
        $sql = 'DELETE FROM computers WHERE id = :id';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $computerId->value(),
        ));

        if ($statement->rowCount() === 0) {
            throw ComputerNotFoundException::becauseIdWasNotFound($computerId->value());
        }
    }

    /**
     * @param array<string, string|int|float> $data
     * @return array<string, string|int|float>
     */
    private function toParameters(array $data): array
    {
        $parameters = array();

        foreach ($data as $column => $value) {
            $parameters[':' . $column] = $value;
        }

        return $parameters;
    }
}
