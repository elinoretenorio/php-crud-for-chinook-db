<?php

declare(strict_types=1);

namespace Chinook\Tests\Invoice;

use PHPUnit\Framework\TestCase;
use Chinook\Database\DatabaseException;
use Chinook\Invoice\{ InvoiceDto, IInvoiceRepository, InvoiceRepository };

class InvoiceRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private InvoiceDto $dto;
    private IInvoiceRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Chinook\Database\IDatabase");
        $this->result = $this->createMock("Chinook\Database\IDatabaseResult");
        $this->input = [
            "Invoice_Id" => 4103,
            "Customer_Id" => 8120,
            "Invoice_Date" => "2021-09-24 23:18:52",
            "Billing_Address" => "hear",
            "Billing_City" => "American",
            "Billing_State" => "dinner",
            "Billing_Country" => "hit",
            "Billing_Postal_Code" => "wish",
            "Total" => 70.00,
        ];
        $this->dto = new InvoiceDto($this->input);
        $this->repository = new InvoiceRepository($this->db);
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
        $expected = 1140;

        $sql = "INSERT INTO `Invoice` (`Customer_Id`, `Invoice_Date`, `Billing_Address`, `Billing_City`, `Billing_State`, `Billing_Country`, `Billing_Postal_Code`, `Total`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->customerId,
                $this->dto->invoiceDate,
                $this->dto->billingAddress,
                $this->dto->billingCity,
                $this->dto->billingState,
                $this->dto->billingCountry,
                $this->dto->billingPostalCode,
                $this->dto->total
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
        $expected = 2117;

        $sql = "UPDATE `Invoice` SET `Customer_Id` = ?, `Invoice_Date` = ?, `Billing_Address` = ?, `Billing_City` = ?, `Billing_State` = ?, `Billing_Country` = ?, `Billing_Postal_Code` = ?, `Total` = ?
                WHERE `Invoice_Id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->customerId,
                $this->dto->invoiceDate,
                $this->dto->billingAddress,
                $this->dto->billingCity,
                $this->dto->billingState,
                $this->dto->billingCountry,
                $this->dto->billingPostalCode,
                $this->dto->total,
                $this->dto->invoiceId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $invoiceId = 1559;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($invoiceId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $invoiceId = 8306;

        $sql = "SELECT `Invoice_Id`, `Customer_Id`, `Invoice_Date`, `Billing_Address`, `Billing_City`, `Billing_State`, `Billing_Country`, `Billing_Postal_Code`, `Total`
                FROM `Invoice` WHERE `Invoice_Id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$invoiceId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($invoiceId);
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
        $sql = "SELECT `Invoice_Id`, `Customer_Id`, `Invoice_Date`, `Billing_Address`, `Billing_City`, `Billing_State`, `Billing_Country`, `Billing_Postal_Code`, `Total`
                FROM `Invoice`";

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
        $invoiceId = 7576;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($invoiceId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $invoiceId = 3783;
        $expected = 4743;

        $sql = "DELETE FROM `Invoice` WHERE `Invoice_Id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$invoiceId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($invoiceId);
        $this->assertEquals($expected, $actual);
    }
}