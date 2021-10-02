<?php

declare(strict_types=1);

namespace Chinook\Tests\Employee;

use PHPUnit\Framework\TestCase;
use Chinook\Database\DatabaseException;
use Chinook\Employee\{ EmployeeDto, IEmployeeRepository, EmployeeRepository };

class EmployeeRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private EmployeeDto $dto;
    private IEmployeeRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Chinook\Database\IDatabase");
        $this->result = $this->createMock("Chinook\Database\IDatabaseResult");
        $this->input = [
            "Employee_Id" => 5380,
            "Last_Name" => "heart",
            "First_Name" => "detail",
            "Title" => "run",
            "Reports_To" => 5009,
            "Birth_Date" => "2021-10-14 05:44:39",
            "Hire_Date" => "2021-10-06 15:23:08",
            "Address" => "glass",
            "City" => "leg",
            "State" => "charge",
            "Country" => "turn",
            "Postal_Code" => "suddenly",
            "Phone" => "run",
            "Fax" => "half",
            "Email" => "Ball herself office star movement moment.",
        ];
        $this->dto = new EmployeeDto($this->input);
        $this->repository = new EmployeeRepository($this->db);
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
        $expected = 4632;

        $sql = "INSERT INTO `Employee` (`Last_Name`, `First_Name`, `Title`, `Reports_To`, `Birth_Date`, `Hire_Date`, `Address`, `City`, `State`, `Country`, `Postal_Code`, `Phone`, `Fax`, `Email`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->lastName,
                $this->dto->firstName,
                $this->dto->title,
                $this->dto->reportsTo,
                $this->dto->birthDate,
                $this->dto->hireDate,
                $this->dto->address,
                $this->dto->city,
                $this->dto->state,
                $this->dto->country,
                $this->dto->postalCode,
                $this->dto->phone,
                $this->dto->fax,
                $this->dto->email
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
        $expected = 3819;

        $sql = "UPDATE `Employee` SET `Last_Name` = ?, `First_Name` = ?, `Title` = ?, `Reports_To` = ?, `Birth_Date` = ?, `Hire_Date` = ?, `Address` = ?, `City` = ?, `State` = ?, `Country` = ?, `Postal_Code` = ?, `Phone` = ?, `Fax` = ?, `Email` = ?
                WHERE `Employee_Id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->lastName,
                $this->dto->firstName,
                $this->dto->title,
                $this->dto->reportsTo,
                $this->dto->birthDate,
                $this->dto->hireDate,
                $this->dto->address,
                $this->dto->city,
                $this->dto->state,
                $this->dto->country,
                $this->dto->postalCode,
                $this->dto->phone,
                $this->dto->fax,
                $this->dto->email,
                $this->dto->employeeId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $employeeId = 2776;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($employeeId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $employeeId = 9878;

        $sql = "SELECT `Employee_Id`, `Last_Name`, `First_Name`, `Title`, `Reports_To`, `Birth_Date`, `Hire_Date`, `Address`, `City`, `State`, `Country`, `Postal_Code`, `Phone`, `Fax`, `Email`
                FROM `Employee` WHERE `Employee_Id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$employeeId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($employeeId);
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
        $sql = "SELECT `Employee_Id`, `Last_Name`, `First_Name`, `Title`, `Reports_To`, `Birth_Date`, `Hire_Date`, `Address`, `City`, `State`, `Country`, `Postal_Code`, `Phone`, `Fax`, `Email`
                FROM `Employee`";

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
        $employeeId = 7439;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($employeeId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $employeeId = 7174;
        $expected = 1636;

        $sql = "DELETE FROM `Employee` WHERE `Employee_Id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$employeeId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($employeeId);
        $this->assertEquals($expected, $actual);
    }
}