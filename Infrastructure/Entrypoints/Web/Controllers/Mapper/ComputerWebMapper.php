<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/SaveComputerCommand.php';
require_once __DIR__ . '/../../../../../Domain/Models/ComputerModel.php';

use Domain\Models\ComputerModel;

final class ComputerWebMapper
{
    /**
     * @param array<string, mixed> $data
     */
    public function fromFormDataToSaveCommand(array $data, bool $includeId = false): SaveComputerCommand
    {
        return new SaveComputerCommand(
            $includeId ? $this->stringValue($data, 'id') : null,
            $this->stringValue($data, 'brand'),
            $this->stringValue($data, 'category'),
            $this->stringValue($data, 'cpu_brand'),
            $this->floatValue($data, 'cpu_speed'),
            $this->stringValue($data, 'ram_technology'),
            $this->floatValue($data, 'ram_capacity'),
            $this->stringValue($data, 'storage_technology'),
            $this->floatValue($data, 'storage_capacity'),
            $this->intValue($data, 'usb_ports'),
            $this->intValue($data, 'hdmi_ports'),
            $this->stringValue($data, 'monitor_brand'),
            $this->floatValue($data, 'screen_size_inches'),
            $this->stringValue($data, 'price')
        );
    }

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
     * @param array<string, mixed> $data
     */
    private function stringValue(array $data, string $key): string
    {
        $value = $data[$key] ?? null;

        if (!is_string($value)) {
            throw new InvalidArgumentException('The "' . $key . '" form field must be a string.');
        }

        return $value;
    }

    /**
     * @param array<string, mixed> $data
     */
    private function floatValue(array $data, string $key): float
    {
        $value = $this->stringValue($data, $key);

        if (!is_numeric($value)) {
            throw new InvalidArgumentException('The "' . $key . '" form field must be numeric.');
        }

        return (float) $value;
    }

    /**
     * @param array<string, mixed> $data
     */
    private function intValue(array $data, string $key): int
    {
        $value = filter_var(
            $this->stringValue($data, $key),
            FILTER_VALIDATE_INT
        );

        if ($value === false) {
            throw new InvalidArgumentException('The "' . $key . '" form field must be an integer.');
        }

        return $value;
    }
}