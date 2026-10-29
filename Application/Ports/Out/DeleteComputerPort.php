<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/ValueObjects/ComputerId.php';

use Domain\ValueObjects\ComputerId;

interface DeleteComputerPort
{
    public function delete(ComputerId $computerId): void;
}
