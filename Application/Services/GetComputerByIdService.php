<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetComputerByIdUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetComputerByIdPort.php';
require_once __DIR__ . '/../../Domain/Exceptions/ComputerNotFoundException.php';

use Domain\Models\ComputerModel;
use Domain\ValueObjects\ComputerId;

final class GetComputerByIdService implements GetComputerByIdUseCase
{
    private GetComputerByIdPort $getComputerByIdPort;

    public function __construct(GetComputerByIdPort $getComputerByIdPort)
    {
        $this->getComputerByIdPort = $getComputerByIdPort;
    }

    public function execute(ComputerId $computerId): ComputerModel
    {
        $computer = $this->getComputerByIdPort->getById($computerId);

        if ($computer === null) {
            throw ComputerNotFoundException::becauseIdWasNotFound($computerId->value());
        }

        return $computer;
    }
}
