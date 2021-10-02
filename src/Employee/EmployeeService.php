<?php

declare(strict_types=1);

namespace Chinook\Employee;

class EmployeeService implements IEmployeeService
{
    private IEmployeeRepository $repository;

    public function __construct(IEmployeeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(EmployeeModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(EmployeeModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $employeeId): ?EmployeeModel
    {
        $dto = $this->repository->get($employeeId);
        if ($dto === null) {
            return null;
        }

        return new EmployeeModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var EmployeeDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new EmployeeModel($dto);
        }

        return $result;
    }

    public function delete(int $employeeId): int
    {
        return $this->repository->delete($employeeId);
    }

    public function createModel(array $row): ?EmployeeModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new EmployeeDto($row);

        return new EmployeeModel($dto);
    }
}