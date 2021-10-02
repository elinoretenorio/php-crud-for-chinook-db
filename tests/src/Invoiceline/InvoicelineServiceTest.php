<?php

declare(strict_types=1);

namespace Chinook\Tests\Invoiceline;

use PHPUnit\Framework\TestCase;
use Chinook\Invoiceline\{ InvoicelineDto, InvoicelineModel, IInvoicelineService, InvoicelineService };

class InvoicelineServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private InvoicelineDto $dto;
    private InvoicelineModel $model;
    private IInvoicelineService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Chinook\Invoiceline\IInvoicelineRepository");
        $this->input = [
            "Invoice_Line_Id" => 7104,
            "Invoice_Id" => 9003,
            "Track_Id" => 8095,
            "Unit_Price" => 648.30,
            "Quantity" => 7431,
        ];
        $this->dto = new InvoicelineDto($this->input);
        $this->model = new InvoicelineModel($this->dto);
        $this->service = new InvoicelineService($this->repository);
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
        $expected = 9701;

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
        $expected = 7591;

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
        $invoiceLineId = 5223;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($invoiceLineId)
            ->willReturn(null);

        $actual = $this->service->get($invoiceLineId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $invoiceLineId = 4153;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($invoiceLineId)
            ->willReturn($this->dto);

        $actual = $this->service->get($invoiceLineId);
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
        $invoiceLineId = 3869;
        $expected = 6531;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($invoiceLineId)
            ->willReturn($expected);

        $actual = $this->service->delete($invoiceLineId);
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