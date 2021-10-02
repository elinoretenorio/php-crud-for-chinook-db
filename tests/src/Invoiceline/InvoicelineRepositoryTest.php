<?php

declare(strict_types=1);

namespace Chinook\Tests\Invoiceline;

use PHPUnit\Framework\TestCase;
use Chinook\Database\DatabaseException;
use Chinook\Invoiceline\{ InvoicelineDto, IInvoicelineRepository, InvoicelineRepository };

class InvoicelineRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private InvoicelineDto $dto;
    private IInvoicelineRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Chinook\Database\IDatabase");
        $this->result = $this->createMock("Chinook\Database\IDatabaseResult");
        $this->input = [
            "Invoice_Line_Id" => 7796,
            "Invoice_Id" => 3308,
            "Track_Id" => 4718,
            "Unit_Price" => 618.71,
            "Quantity" => 8934,
        ];
        $this->dto = new InvoicelineDto($this->input);
        $this->repository = new InvoicelineRepository($this->db);
    }

    protected function tearDown(): void
    {
        unset($this->db);
        unset($this->result);
        unset($this->input);
        unset($this->dto);
        unset($this->repository);
    }

    public function testInsert_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 8295;

        $sql = "INSERT INTO `InvoiceLine` (`Invoice_Id`, `Track_Id`, `Unit_Price`, `Quantity`)
                VALUES (?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->invoiceId,
                $this->dto->trackId,
                $this->dto->unitPrice,
                $this->dto->quantity
            ]);
        $this->db->expects($this->once())
            ->method("lastInsertId")
            ->willReturn($expected);

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 3331;

        $sql = "UPDATE `InvoiceLine` SET `Invoice_Id` = ?, `Track_Id` = ?, `Unit_Price` = ?, `Quantity` = ?
                WHERE `Invoice_Line_Id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->invoiceId,
                $this->dto->trackId,
                $this->dto->unitPrice,
                $this->dto->quantity,
                $this->dto->invoiceLineId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $invoiceLineId = 8704;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($invoiceLineId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $invoiceLineId = 7357;

        $sql = "SELECT `Invoice_Line_Id`, `Invoice_Id`, `Track_Id`, `Unit_Price`, `Quantity`
                FROM `InvoiceLine` WHERE `Invoice_Line_Id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$invoiceLineId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($invoiceLineId);
        $this->assertEquals($this->dto, $actual);
    }

    public function testGetAll_ReturnsEmptyOnException(): void
    {
        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsDtos(): void
    {
        $sql = "SELECT `Invoice_Line_Id`, `Invoice_Id`, `Track_Id`, `Unit_Price`, `Quantity`
                FROM `InvoiceLine`";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute");
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->getAll();
        $this->assertEquals([$this->dto], $actual);
    }

    public function testDelete_ReturnsFailedOnException(): void
    {
        $invoiceLineId = 3555;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($invoiceLineId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $invoiceLineId = 3273;
        $expected = 1401;

        $sql = "DELETE FROM `InvoiceLine` WHERE `Invoice_Line_Id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$invoiceLineId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($invoiceLineId);
        $this->assertEquals($expected, $actual);
    }
}