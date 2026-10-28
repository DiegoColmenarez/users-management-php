<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/ComputerModel.php';

use Domain\Models\ComputerModel;

interface GetAllComputersUseCase
{
   
    public function execute(): array;
}
