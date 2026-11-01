<?php

declare(strict_types=1);

final readonly class SaveComputerCommand
{
    public function __construct(
        private ?string $id,
        private string $brand,
        private string $category,
        private string $cpuBrand,
        private float $cpuSpeed,
        private string $ramTechnology,
        private float $ramCapacity,
        private string $storageTechnology,
        private float $storageCapacity,
        private int $usbPorts,
        private int $hdmiPorts,
        private string $monitorBrand,
        private float $screenSizeInches,
        private string $price
    ) {}

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getCpuBrand(): string
    {
        return $this->cpuBrand;
    }

    public function getCpuSpeed(): float
    {
        return $this->cpuSpeed;
    }

    public function getRamTechnology(): string
    {
        return $this->ramTechnology;
    }

    public function getRamCapacity(): float
    {
        return $this->ramCapacity;
    }

    public function getStorageTechnology(): string
    {
        return $this->storageTechnology;
    }

    public function getStorageCapacity(): float
    {
        return $this->storageCapacity;
    }

    public function getUsbPorts(): int
    {
        return $this->usbPorts;
    }

    public function getHdmiPorts(): int
    {
        return $this->hdmiPorts;
    }

    public function getMonitorBrand(): string
    {
        return $this->monitorBrand;
    }

    public function getScreenSizeInches(): float
    {
        return $this->screenSizeInches;
    }

    public function getPrice(): string
    {
        return $this->price;
    }
}
