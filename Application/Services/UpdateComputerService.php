<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/UpdateComputerUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetComputerByIdPort.php';
require_once __DIR__ . '/../Ports/Out/UpdateComputerPort.php';
require_once __DIR__ . '/../../Domain/Exceptions/ComputerNotFoundException.php';
require_once __DIR__ . '/../../Domain/ValueObjects/ComputerId.php';

use Domain\Models\ComputerModel;
use Domain\ValueObjects\ComputerBrand;
use Domain\ValueObjects\ComputerConnectivity;
use Domain\ValueObjects\ComputerDisplay;
use Domain\ValueObjects\ComputerId;
use Domain\ValueObjects\ComputerMemory;
use Domain\ValueObjects\ComputerPrice;
use Domain\ValueObjects\ComputerProcessor;
use Domain\ValueObjects\ComputerStorage;

final class UpdateComputerService implements UpdateComputerUseCase
{
    private GetComputerByIdPort $getComputerByIdPort;
    private UpdateComputerPort $updateComputerPort;

    public function __construct(
        GetComputerByIdPort $getComputerByIdPort,
        UpdateComputerPort $updateComputerPort
    ) {
        $this->getComputerByIdPort = $getComputerByIdPort;
        $this->updateComputerPort = $updateComputerPort;
    }

    public function execute(SaveComputerCommand $command): ComputerModel
    {
        $id = $command->getId();

        if ($id === null) {
            throw new InvalidArgumentException('A computer id is required to update a computer.');
        }

        $computerId = new ComputerId($id);
        $currentComputer = $this->getComputerByIdPort->getById($computerId);

        if ($currentComputer === null) {
            throw ComputerNotFoundException::becauseIdWasNotFound($computerId->value());
        }

        $computer = new ComputerModel(
            $computerId,
            new ComputerBrand($command->getBrand()),
            $command->getCategory(),
            new ComputerProcessor($command->getCpuBrand(), $command->getCpuSpeed()),
            new ComputerMemory($command->getRamTechnology(), $command->getRamCapacity()),
            new ComputerStorage($command->getStorageTechnology(), $command->getStorageCapacity()),
            new ComputerConnectivity($command->getUsbPorts(), $command->getHdmiPorts()),
            new ComputerDisplay($command->getMonitorBrand(), $command->getScreenSizeInches()),
            new ComputerPrice($command->getPrice())
        );

        return $this->updateComputerPort->update($computer);
    }
}
