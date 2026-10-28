<?php

declare(strict_types=1);

namespace Domain\Models;

require_once __DIR__ . '/../Enums/CategoryEnum.php';
require_once __DIR__ . '/../ValueObjects/ComputerId.php';
require_once __DIR__ . '/../ValueObjects/ComputerBrand.php';
require_once __DIR__ . '/../ValueObjects/ComputerProcessor.php';
require_once __DIR__ . '/../ValueObjects/ComputerMemory.php';
require_once __DIR__ . '/../ValueObjects/ComputerStorage.php';
require_once __DIR__ . '/../ValueObjects/ComputerConnectivity.php';
require_once __DIR__ . '/../ValueObjects/ComputerDisplay.php';
require_once __DIR__ . '/../ValueObjects/ComputerPrice.php';

use Domain\ValueObjects\ComputerBrand;
use Domain\ValueObjects\ComputerConnectivity;
use Domain\ValueObjects\ComputerDisplay;
use Domain\ValueObjects\ComputerId;
use Domain\ValueObjects\ComputerMemory;
use Domain\ValueObjects\ComputerPrice;
use Domain\ValueObjects\ComputerProcessor;
use Domain\ValueObjects\ComputerStorage;

final readonly class ComputerModel
{
    private ComputerId $id;
    private ComputerBrand $brand;
    private string $category;
    private ComputerProcessor $processor;
    private ComputerMemory $memory;
    private ComputerStorage $storage;
    private ComputerConnectivity $connectivity;
    private ComputerDisplay $display;
    private ComputerPrice $price;

    public function __construct(
        ComputerId $id,
        ComputerBrand $brand,
        string $category,
        ComputerProcessor $processor,
        ComputerMemory $memory,
        ComputerStorage $storage,
        ComputerConnectivity $connectivity,
        ComputerDisplay $display,
        ComputerPrice $price
    ) {
        \CategoryEnum::ensureIsValid($category);

        $this->id = $id;
        $this->brand = $brand;
        $this->category = $category;
        $this->processor = $processor;
        $this->memory = $memory;
        $this->storage = $storage;
        $this->connectivity = $connectivity;
        $this->display = $display;
        $this->price = $price;
    }

    public static function create(
        ComputerBrand $brand,
        string $category,
        ComputerProcessor $processor,
        ComputerMemory $memory,
        ComputerStorage $storage,
        ComputerConnectivity $connectivity,
        ComputerDisplay $display,
        ComputerPrice $price
    ): self {
        return new self(
            ComputerId::generate(),
            $brand,
            $category,
            $processor,
            $memory,
            $storage,
            $connectivity,
            $display,
            $price
        );
    }

    public function id(): ComputerId
    {
        return $this->id;
    }

    public function brand(): ComputerBrand
    {
        return $this->brand;
    }

    public function category(): string
    {
        return $this->category;
    }

    public function processor(): ComputerProcessor
    {
        return $this->processor;
    }

    public function memory(): ComputerMemory
    {
        return $this->memory;
    }

    
    public function storage(): ComputerStorage
    {
        return $this->storage;
    }

    public function connectivity(): ComputerConnectivity
    {
        return $this->connectivity;
    }

    public function display(): ComputerDisplay
    {
        return $this->display;
    }

    public function price(): ComputerPrice
    {
        return $this->price;
    }

    public function changeBrand(ComputerBrand $brand): self
    {
        return $this->withChanges(brand: $brand);
    }

    public function changeCategory(string $category): self
    {
        return $this->withChanges(category: $category);
    }

    public function changeProcessor(ComputerProcessor $processor): self
    {
        return $this->withChanges(processor: $processor);
    }

    public function changeMemory(ComputerMemory $memory): self
    {
        return $this->withChanges(memory: $memory);
    }

    public function changeStorage(ComputerStorage $storage): self
    {
        return $this->withChanges(storage: $storage);
    }

    public function changeConnectivity(ComputerConnectivity $connectivity): self
    {
        return $this->withChanges(connectivity: $connectivity);
    }

    public function changeDisplay(ComputerDisplay $display): self
    {
        return $this->withChanges(display: $display);
    }

    public function changePrice(ComputerPrice $price): self
    {
        return $this->withChanges(price: $price);
    }

    public function equals(ComputerModel $other): bool
    {
        return $this->id->equals($other->id());
    }

    private function withChanges(
        ?ComputerBrand $brand = null,
        ?string $category = null,
        ?ComputerProcessor $processor = null,
        ?ComputerMemory $memory = null,
        ?ComputerStorage $storage = null,
        ?ComputerConnectivity $connectivity = null,
        ?ComputerDisplay $display = null,
        ?ComputerPrice $price = null
    ): self {
        return new self(
            $this->id,
            $brand ?? $this->brand,
            $category ?? $this->category,
            $processor ?? $this->processor,
            $memory ?? $this->memory,
            $storage ?? $this->storage,
            $connectivity ?? $this->connectivity,
            $display ?? $this->display,
            $price ?? $this->price
        );
    }
}
