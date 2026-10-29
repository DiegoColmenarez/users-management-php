<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetAllComputersUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetAllComputersPort.php';

final class GetAllComputersService implements GetAllComputersUseCase
{
    private GetAllComputersPort $getAllComputersPort;

    public function __construct(GetAllComputersPort $getAllComputersPort)
    {
        $this->getAllComputersPort = $getAllComputersPort;
    }

    /**
     * @return \Domain\Models\ComputerModel[]
     */
    public function execute(): array
    {
        return $this->getAllComputersPort->getAll();
    }
}
