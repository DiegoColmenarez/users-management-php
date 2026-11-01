<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/ComputerModel.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/ComputerId.php';

use Domain\Models\ComputerModel;
use Domain\ValueObjects\ComputerId;

interface GetComputerByIdUseCase
{
    public function execute(ComputerId $computerId): ComputerModel;
}
