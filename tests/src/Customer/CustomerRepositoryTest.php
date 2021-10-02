<?php

declare(strict_types=1);

namespace Chinook\Tests\Customer;

use PHPUnit\Framework\TestCase;
use Chinook\Database\DatabaseException;
use Chinook\Customer\{ CustomerDto, ICustomerRepository, CustomerRepository };

class CustomerRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private CustomerDto $dto;
    private ICustomerRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Chinook\Database\IDatabase");
        $this->result = $this->createMock("Chinook\Database\IDatabaseResult");
        $this->input = [
            "Customer_Id" => 6930,
            "First_Name" => "exist",
            "Last_Name" => "show",
            "Company" => "return",
            "Address" => "religious",
            "City" => "probably",
            "State" => "mouth",
            "Country" => "network",
            "Postal_Code" => "more",
            "Phone" => "where",
            "Fax" => "general",
            "Email" => "Buy site care table let.",
            "Support_Rep_Id" => 3454,
        ];
        $this->dto = new CustomerDto($this->input);
        $this->repository = new CustomerRepository($this->db);
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
        $expected = 8092;

        $sql = "INSERT INTO `Customer` (`First_Name`, `Last_Name`, `Company`, `Address`, `City`, `State`, `Country`, `Postal_Code`, `Phone`, `Fax`, `Email`, `Support_Rep_Id`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->firstName,
                $this->dto->lastName,
                $this->dto->company,
                $this->dto->address,
                $this->dto->city,
                $this->dto->state,
                $this->dto->country,
                $this->dto->postalCode,
                $this->dto->phone,
                $this->dto->fax,
                $this->dto->email,
                $this->dto->supportRepId
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
        $expected = 3069;

        $sql = "UPDATE `Customer` SET `First_Name` = ?, `Last_Name` = ?, `Company` = ?, `Address` = ?, `City` = ?, `State` = ?, `Country` = ?, `Postal_Code` = ?, `Phone` = ?, `Fax` = ?, `Email` = ?, `Support_Rep_Id` = ?
                WHERE `Customer_Id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->firstName,
                $this->dto->lastName,
                $this->dto->company,
                $this->dto->address,
                $this->dto->city,
                $this->dto->state,
                $this->dto->country,
                $this->dto->postalCode,
                $this->dto->phone,
                $this->dto->fax,
                $this->dto->email,
                $this->dto->supportRepId,
                $this->dto->customerId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $customerId = 198;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($customerId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $customerId = 3147;

        $sql = "SELECT `Customer_Id`, `First_Name`, `Last_Name`, `Company`, `Address`, `City`, `State`, `Country`, `Postal_Code`, `Phone`, `Fax`, `Email`, `Support_Rep_Id`
                FROM `Customer` WHERE `Customer_Id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$customerId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($customerId);
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
        $sql = "SELECT `Customer_Id`, `First_Name`, `Last_Name`, `Company`, `Address`, `City`, `State`, `Country`, `Postal_Code`, `Phone`, `Fax`, `Email`, `Support_Rep_Id`
                FROM `Customer`";

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
        $customerId = 9949;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($customerId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $customerId = 1581;
        $expected = 8872;

        $sql = "DELETE FROM `Customer` WHERE `Customer_Id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$customerId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($customerId);
        $this->assertEquals($expected, $actual);
    }
}