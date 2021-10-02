<?php

declare(strict_types=1);

namespace Chinook\Employee;

interface IEmployeeService
{
    public function insert(EmployeeModel $model): int;

    public function update(EmployeeModel $model): int;

    public function get(int $employeeId): ?EmployeeModel;

    public function getAll(): array;

    public function delete(int $employeeId): int;

    public function createModel(array $row): ?EmployeeModel;
}