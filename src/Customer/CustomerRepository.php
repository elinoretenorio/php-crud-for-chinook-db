<?php

declare(strict_types=1);

namespace Chinook\Customer;

use Chinook\Database\IDatabase;
use Chinook\Database\DatabaseException;

class CustomerRepository implements ICustomerRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(CustomerDto $dto): int
    {
        $sql = "INSERT INTO `Customer` (`First_Name`, `Last_Name`, `Company`, `Address`, `City`, `State`, `Country`, `Postal_Code`, `Phone`, `Fax`, `Email`, `Support_Rep_Id`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->firstName,
                $dto->lastName,
                $dto->company,
                $dto->address,
                $dto->city,
                $dto->state,
                $dto->country,
                $dto->postalCode,
                $dto->phone,
                $dto->fax,
                $dto->email,
                $dto->supportRepId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(CustomerDto $dto): int
    {
        $sql = "UPDATE `Customer` SET `First_Name` = ?, `Last_Name` = ?, `Company` = ?, `Address` = ?, `City` = ?, `State` = ?, `Country` = ?, `Postal_Code` = ?, `Phone` = ?, `Fax` = ?, `Email` = ?, `Support_Rep_Id` = ?
                WHERE `Customer_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->firstName,
                $dto->lastName,
                $dto->company,
                $dto->address,
                $dto->city,
                $dto->state,
                $dto->country,
                $dto->postalCode,
                $dto->phone,
                $dto->fax,
                $dto->email,
                $dto->supportRepId,
                $dto->customerId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $customerId): ?CustomerDto
    {
        $sql = "SELECT `Customer_Id`, `First_Name`, `Last_Name`, `Company`, `Address`, `City`, `State`, `Country`, `Postal_Code`, `Phone`, `Fax`, `Email`, `Support_Rep_Id`
                FROM `Customer` WHERE `Customer_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$customerId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new CustomerDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `Customer_Id`, `First_Name`, `Last_Name`, `Company`, `Address`, `City`, `State`, `Country`, `Postal_Code`, `Phone`, `Fax`, `Email`, `Support_Rep_Id`
                FROM `Customer`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new CustomerDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $customerId): int
    {
        $sql = "DELETE FROM `Customer` WHERE `Customer_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$customerId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}