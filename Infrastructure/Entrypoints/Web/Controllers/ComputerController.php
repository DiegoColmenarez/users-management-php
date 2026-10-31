<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../../Application/Ports/In/CreateComputerUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/UpdateComputerUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/GetComputerByIdUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/GetAllComputersUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/DeleteComputerUseCase.php';
require_once __DIR__ . '/Mapper/ComputerWebMapper.php';
require_once __DIR__ . '/../../../../Domain/Models/ComputerModel.php';
require_once __DIR__ . '/../../../../Domain/ValueObjects/ComputerId.php';

use Domain\Models\ComputerModel;
use Domain\ValueObjects\ComputerId;

final class ComputerController
{
    private CreateComputerUseCase $createComputerUseCase;
    private UpdateComputerUseCase $updateComputerUseCase;
    private GetComputerByIdUseCase $getComputerByIdUseCase;
    private GetAllComputersUseCase $getAllComputersUseCase;
    private DeleteComputerUseCase $deleteComputerUseCase;
    private ComputerWebMapper $mapper;

    public function __construct(
        CreateComputerUseCase $createComputerUseCase,
        UpdateComputerUseCase $updateComputerUseCase,
        GetComputerByIdUseCase $getComputerByIdUseCase,
        GetAllComputersUseCase $getAllComputersUseCase,
        DeleteComputerUseCase $deleteComputerUseCase,
        ComputerWebMapper $mapper
    ) {
        $this->createComputerUseCase = $createComputerUseCase;
        $this->updateComputerUseCase = $updateComputerUseCase;
        $this->getComputerByIdUseCase = $getComputerByIdUseCase;
        $this->getAllComputersUseCase = $getAllComputersUseCase;
        $this->deleteComputerUseCase = $deleteComputerUseCase;
        $this->mapper = $mapper;
    }

    /**
     * @return array<int, array<string, string|int|float>>
     */
    public function index(): array
    {
        $computers = $this->getAllComputersUseCase->execute();
        $result = array();

        foreach ($computers as $computer) {
            $result[] = $this->mapper->fromModelToArray($computer);
        }

        return $result;
    }

    /**
     * @return array<string, string|int|float>
     */
    public function show(string $id): array
    {
        $computer = $this->getComputerByIdUseCase->execute(new ComputerId($id));

        return $this->mapper->fromModelToArray($computer);
    }

    /**
     * @return array<string, string|int|float>
     */
    public function store(): array
    {
        $computer = $this->createComputerUseCase->execute(
            $this->mapper->fromFormDataToSaveCommand($_POST)
        );

        return $this->mapper->fromModelToArray($computer);
    }

    /**
     * @return array<string, string|int|float>
     */
    public function update(): array
    {
        $computer = $this->updateComputerUseCase->execute(
            $this->mapper->fromFormDataToSaveCommand(
                $_POST,
                true
            )
        );

        return $this->mapper->fromModelToArray($computer);
    }

    public function delete(string $id): void
    {
        $this->deleteComputerUseCase->execute(new ComputerId($id));
    }
}
