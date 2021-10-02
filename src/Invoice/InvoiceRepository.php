<?php

declare(strict_types=1);

namespace Chinook\Invoice;

use Chinook\Database\IDatabase;
use Chinook\Database\DatabaseException;

class InvoiceRepository implements IInvoiceRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(InvoiceDto $dto): int
    {
        $sql = "INSERT INTO `Invoice` (`Customer_Id`, `Invoice_Date`, `Billing_Address`, `Billing_City`, `Billing_State`, `Billing_Country`, `Billing_Postal_Code`, `Total`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->customerId,
                $dto->invoiceDate,
                $dto->billingAddress,
                $dto->billingCity,
                $dto->billingState,
                $dto->billingCountry,
                $dto->billingPostalCode,
                $dto->total
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(InvoiceDto $dto): int
    {
        $sql = "UPDATE `Invoice` SET `Customer_Id` = ?, `Invoice_Date` = ?, `Billing_Address` = ?, `Billing_City` = ?, `Billing_State` = ?, `Billing_Country` = ?, `Billing_Postal_Code` = ?, `Total` = ?
                WHERE `Invoice_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->customerId,
                $dto->invoiceDate,
                $dto->billingAddress,
                $dto->billingCity,
                $dto->billingState,
                $dto->billingCountry,
                $dto->billingPostalCode,
                $dto->total,
                $dto->invoiceId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $invoiceId): ?InvoiceDto
    {
        $sql = "SELECT `Invoice_Id`, `Customer_Id`, `Invoice_Date`, `Billing_Address`, `Billing_City`, `Billing_State`, `Billing_Country`, `Billing_Postal_Code`, `Total`
                FROM `Invoice` WHERE `Invoice_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$invoiceId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new InvoiceDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `Invoice_Id`, `Customer_Id`, `Invoice_Date`, `Billing_Address`, `Billing_City`, `Billing_State`, `Billing_Country`, `Billing_Postal_Code`, `Total`
                FROM `Invoice`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new InvoiceDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $invoiceId): int
    {
        $sql = "DELETE FROM `Invoice` WHERE `Invoice_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$invoiceId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}