<?php

declare(strict_types=1);

namespace Chinook\Tests\Employee;

use PHPUnit\Framework\TestCase;
use Chinook\Employee\{ EmployeeDto, EmployeeModel, IEmployeeService, EmployeeService };

class EmployeeServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private EmployeeDto $dto;
    private EmployeeModel $model;
    private IEmployeeService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Chinook\Employee\IEmployeeRepository");
        $this->input = [
            "Employee_Id" => 9177,
            "Last_Name" => "degree",
            "First_Name" => "hair",
            "Title" => "science",
            "Reports_To" => 8359,
            "Birth_Date" => "2021-09-26 16:02:58",
            "Hire_Date" => "2021-09-29 22:21:00",
            "Address" => "wrong",
            "City" => "assume",
            "State" => "travel",
            "Country" => "fire",
            "Postal_Code" => "garden",
            "Phone" => "red",
            "Fax" => "pressure",
            "Email" => "The experience spring dog by argue sit.",
        ];
        $this->dto = new EmployeeDto($this->input);
        $this->model = new EmployeeModel($this->dto);
        $this->service = new EmployeeService($this->repository);
    }

    protected function tearDown(): void
    {
        unset($this->repository);
        unset($this->input);
        unset($this->dto);
        unset($this->model);
        unset($this->service);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 2396;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEmpty($actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 5213;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsNull(): void
    {
        $employeeId = 2885;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($employeeId)
            ->willReturn(null);

        $actual = $this->service->get($employeeId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $employeeId = 2254;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($employeeId)
            ->willReturn($this->dto);

        $actual = $this->service->get($employeeId);
        $this->assertEquals($this->model, $actual);
    }

    public function testGetAll_ReturnsEmpty(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([]);

        $actual = $this->service->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsModels(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([$this->dto]);

        $actual = $this->service->getAll();
        $this->assertEquals([$this->model], $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $employeeId = 4193;
        $expected = 7768;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($employeeId)
            ->willReturn($expected);

        $actual = $this->service->delete($employeeId);
        $this->assertEquals($expected, $actual);
    }

    public function testCreateModel_ReturnsNullIfEmpty(): void
    {
        $actual = $this->service->createModel([]);
        $this->assertNull($actual);
    }

    public function testCreateModel_ReturnsModel(): void
    {
        $actual = $this->service->createModel($this->input);
        $this->assertEquals($this->model, $actual);
    }
}