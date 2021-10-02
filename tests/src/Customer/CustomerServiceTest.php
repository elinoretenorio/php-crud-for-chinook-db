<?php

declare(strict_types=1);

namespace Chinook\Tests\Customer;

use PHPUnit\Framework\TestCase;
use Chinook\Customer\{ CustomerDto, CustomerModel, ICustomerService, CustomerService };

class CustomerServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private CustomerDto $dto;
    private CustomerModel $model;
    private ICustomerService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Chinook\Customer\ICustomerRepository");
        $this->input = [
            "Customer_Id" => 658,
            "First_Name" => "development",
            "Last_Name" => "international",
            "Company" => "opportunity",
            "Address" => "production",
            "City" => "management",
            "State" => "Republican",
            "Country" => "until",
            "Postal_Code" => "paper",
            "Phone" => "coach",
            "Fax" => "but",
            "Email" => "Form week order lead along over song every.",
            "Support_Rep_Id" => 5347,
        ];
        $this->dto = new CustomerDto($this->input);
        $this->model = new CustomerModel($this->dto);
        $this->service = new CustomerService($this->repository);
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
        $expected = 8880;

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
        $expected = 711;

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
        $customerId = 6473;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($customerId)
            ->willReturn(null);

        $actual = $this->service->get($customerId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $customerId = 6478;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($customerId)
            ->willReturn($this->dto);

        $actual = $this->service->get($customerId);
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
        $customerId = 4737;
        $expected = 8833;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($customerId)
            ->willReturn($expected);

        $actual = $this->service->delete($customerId);
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