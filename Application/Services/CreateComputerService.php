<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/CreateComputerUseCase.php';
require_once __DIR__ . '/../Ports/Out/SaveComputerPort.php';

use Domain\Models\ComputerModel;
use Domain\ValueObjects\ComputerBrand;
use Domain\ValueObjects\ComputerConnectivity;
use Domain\ValueObjects\ComputerDisplay;
use Domain\ValueObjects\ComputerMemory;
use Domain\ValueObjects\ComputerPrice;
use Domain\ValueObjects\ComputerProcessor;
use Domain\ValueObjects\ComputerStorage;

final class CreateComputerService implements CreateComputerUseCase
{
    private SaveComputerPort $saveComputerPort;

    public function __construct(SaveComputerPort $saveComputerPort)
    {
        $this->saveComputerPort = $saveComputerPort;
    }

    public function execute(SaveComputerCommand $command): ComputerModel
    {
        if ($command->getId() !== null) {
            throw new InvalidArgumentException('A computer id must not be provided when creating a computer.');
        }

        $computer = ComputerModel::create(
            new ComputerBrand($command->getBrand()),
            $command->getCategory(),
            new ComputerProcessor($command->getCpuBrand(), $command->getCpuSpeed()),
            new ComputerMemory($command->getRamTechnology(), $command->getRamCapacity()),
            new ComputerStorage($command->getStorageTechnology(), $command->getStorageCapacity()),
            new ComputerConnectivity($command->getUsbPorts(), $command->getHdmiPorts()),
            new ComputerDisplay($command->getMonitorBrand(), $command->getScreenSizeInches()),
            new ComputerPrice($command->getPrice())
        );

        return $this->saveComputerPort->save($computer);
    }
}
