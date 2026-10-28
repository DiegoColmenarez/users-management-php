<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/ComputerModel.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/ComputerId.php';

use Domain\Models\ComputerModel;
use Domain\ValueObjects\ComputerId;

interface GetComputerPort
{
    public function getById(ComputerId $computerId): ?ComputerModel;

    /**
     * @return ComputerModel[]
     */
    public function getAll(): array;
}
