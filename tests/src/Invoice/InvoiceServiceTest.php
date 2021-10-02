<?php

declare(strict_types=1);

namespace Chinook\Tests\Invoice;

use PHPUnit\Framework\TestCase;
use Chinook\Invoice\{ InvoiceDto, InvoiceModel, IInvoiceService, InvoiceService };

class InvoiceServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private InvoiceDto $dto;
    private InvoiceModel $model;
    private IInvoiceService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Chinook\Invoice\IInvoiceRepository");
        $this->input = [
            "Invoice_Id" => 1274,
            "Customer_Id" => 3641,
            "Invoice_Date" => "2021-09-30 15:14:52",
            "Billing_Address" => "attorney",
            "Billing_City" => "forget",
            "Billing_State" => "maybe",
            "Billing_Country" => "employee",
            "Billing_Postal_Code" => "me",
            "Total" => 485.00,
        ];
        $this->dto = new InvoiceDto($this->input);
        $this->model = new InvoiceModel($this->dto);
        $this->service = new InvoiceService($this->repository);
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
        $expected = 3721;

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
        $expected = 1268;

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
        $invoiceId = 1694;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($invoiceId)
            ->willReturn(null);

        $actual = $this->service->get($invoiceId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $invoiceId = 9157;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($invoiceId)
            ->willReturn($this->dto);

        $actual = $this->service->get($invoiceId);
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
        $invoiceId = 8163;
        $expected = 26;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($invoiceId)
            ->willReturn($expected);

        $actual = $this->service->delete($invoiceId);
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