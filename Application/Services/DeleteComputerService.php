<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/DeleteComputerUseCase.php';
require_once __DIR__ . '/../Ports/Out/DeleteComputerPort.php';
require_once __DIR__ . '/../Ports/Out/GetComputerByIdPort.php';
require_once __DIR__ . '/../../Domain/Exceptions/ComputerNotFoundException.php';

use Domain\ValueObjects\ComputerId;

final class DeleteComputerService implements DeleteComputerUseCase
{
    private DeleteComputerPort $deleteComputerPort;
    private GetComputerByIdPort $getComputerByIdPort;

    public function __construct(
        DeleteComputerPort $deleteComputerPort,
        GetComputerByIdPort $getComputerByIdPort
    ) {
        $this->deleteComputerPort = $deleteComputerPort;
        $this->getComputerByIdPort = $getComputerByIdPort;
    }

    public function execute(ComputerId $computerId): void
    {
        $computer = $this->getComputerByIdPort->getById($computerId);

        if ($computer === null) {
            throw ComputerNotFoundException::becauseIdWasNotFound($computerId->value());
        }

        $this->deleteComputerPort->delete($computerId);
    }
}
