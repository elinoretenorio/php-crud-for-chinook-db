<?php

declare(strict_types=1);

namespace Chinook\Employee;

use Chinook\Database\IDatabase;
use Chinook\Database\DatabaseException;

class EmployeeRepository implements IEmployeeRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(EmployeeDto $dto): int
    {
        $sql = "INSERT INTO `Employee` (`Last_Name`, `First_Name`, `Title`, `Reports_To`, `Birth_Date`, `Hire_Date`, `Address`, `City`, `State`, `Country`, `Postal_Code`, `Phone`, `Fax`, `Email`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->lastName,
                $dto->firstName,
                $dto->title,
                $dto->reportsTo,
                $dto->birthDate,
                $dto->hireDate,
                $dto->address,
                $dto->city,
                $dto->state,
                $dto->country,
                $dto->postalCode,
                $dto->phone,
                $dto->fax,
                $dto->email
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(EmployeeDto $dto): int
    {
        $sql = "UPDATE `Employee` SET `Last_Name` = ?, `First_Name` = ?, `Title` = ?, `Reports_To` = ?, `Birth_Date` = ?, `Hire_Date` = ?, `Address` = ?, `City` = ?, `State` = ?, `Country` = ?, `Postal_Code` = ?, `Phone` = ?, `Fax` = ?, `Email` = ?
                WHERE `Employee_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->lastName,
                $dto->firstName,
                $dto->title,
                $dto->reportsTo,
                $dto->birthDate,
                $dto->hireDate,
                $dto->address,
                $dto->city,
                $dto->state,
                $dto->country,
                $dto->postalCode,
                $dto->phone,
                $dto->fax,
                $dto->email,
                $dto->employeeId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $employeeId): ?EmployeeDto
    {
        $sql = "SELECT `Employee_Id`, `Last_Name`, `First_Name`, `Title`, `Reports_To`, `Birth_Date`, `Hire_Date`, `Address`, `City`, `State`, `Country`, `Postal_Code`, `Phone`, `Fax`, `Email`
                FROM `Employee` WHERE `Employee_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$employeeId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new EmployeeDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `Employee_Id`, `Last_Name`, `First_Name`, `Title`, `Reports_To`, `Birth_Date`, `Hire_Date`, `Address`, `City`, `State`, `Country`, `Postal_Code`, `Phone`, `Fax`, `Email`
                FROM `Employee`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new EmployeeDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $employeeId): int
    {
        $sql = "DELETE FROM `Employee` WHERE `Employee_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$employeeId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}