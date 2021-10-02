<?php

declare(strict_types=1);

namespace Chinook\Employee;

interface IEmployeeRepository
{
    public function insert(EmployeeDto $dto): int;

    public function update(EmployeeDto $dto): int;

    public function get(int $employeeId): ?EmployeeDto;

    public function getAll(): array;

    public function delete(int $employeeId): int;
}