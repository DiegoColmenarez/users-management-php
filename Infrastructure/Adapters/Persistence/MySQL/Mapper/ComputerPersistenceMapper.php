<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../../../Domain/Models/ComputerModel.php';

use Domain\Models\ComputerModel;

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
}
