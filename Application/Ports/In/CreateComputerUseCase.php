<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/ComputerModel.php';

use Domain\Models\ComputerModel;

interface CreateComputerUseCase
{
    public function execute(ComputerModel $computer): ComputerModel;
}
