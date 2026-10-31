<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../../../Domain/Models/ComputerModel.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/ComputerId.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/ComputerBrand.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/ComputerProcessor.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/ComputerMemory.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/ComputerStorage.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/ComputerConnectivity.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/ComputerDisplay.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/ComputerPrice.php';

use Domain\Models\ComputerModel;
use Domain\ValueObjects\ComputerBrand;
use Domain\ValueObjects\ComputerConnectivity;
use Domain\ValueObjects\ComputerDisplay;
use Domain\ValueObjects\ComputerId;
use Domain\ValueObjects\ComputerMemory;
use Domain\ValueObjects\ComputerPrice;
use Domain\ValueObjects\ComputerProcessor;
use Domain\ValueObjects\ComputerStorage;

final class ComputerPersistenceMapper
{
    /**
     * @return array<string, string|int|float>
     */
    public function fromModelToArray(ComputerModel $computer): array
    {
        return array(
            'id' => $computer->id()->value(),
            'brand' => $computer->brand()->value(),
            'category' => $computer->category(),
            'cpu_brand' => $computer->processor()->cpuBrand(),
            'cpu_speed' => $computer->processor()->cpuSpeed(),
            'ram_technology' => $computer->memory()->ramTechnology(),
            'ram_capacity' => $computer->memory()->ramCapacity(),
            'storage_technology' => $computer->storage()->storageTechnology(),
            'storage_capacity' => $computer->storage()->storageCapacity(),
            'usb_ports' => $computer->connectivity()->usbPorts(),
            'hdmi_ports' => $computer->connectivity()->hdmiPorts(),
            'monitor_brand' => $computer->display()->monitorBrand(),
            'screen_size_inches' => $computer->display()->screenSizeInches(),
            'price' => $computer->price()->value(),
        );
    }

    /**
     * @param array<string, mixed> $row
     */
    public function fromArrayToModel(array $row): ComputerModel
    {
        return new ComputerModel(
            new ComputerId((string) $row['id']),
            new ComputerBrand((string) $row['brand']),
            (string) $row['category'],
            new ComputerProcessor(
                (string) $row['cpu_brand'],
                (float) $row['cpu_speed']
            ),
            new ComputerMemory(
                (string) $row['ram_technology'],
                (float) $row['ram_capacity']
            ),
            new ComputerStorage(
                (string) $row['storage_technology'],
                (float) $row['storage_capacity']
            ),
            new ComputerConnectivity(
                (int) $row['usb_ports'],
                (int) $row['hdmi_ports']
            ),
            new ComputerDisplay(
                (string) $row['monitor_brand'],
                (float) $row['screen_size_inches']
            ),
            new ComputerPrice((string) $row['price'])
        );
    }

    /**
     * @param array<int, array<string, mixed>> $rows
     * @return ComputerModel[]
     */
    public function fromRowsToModels(array $rows): array
    {
        $computers = array();

        foreach ($rows as $row) {
            $computers[] = $this->fromArrayToModel($row);
        }

        return $computers;
    }
}
