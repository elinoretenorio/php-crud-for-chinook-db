<?php

declare(strict_types=1);

namespace Chinook\Invoiceline;

use Chinook\Database\IDatabase;
use Chinook\Database\DatabaseException;

class InvoicelineRepository implements IInvoicelineRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(InvoicelineDto $dto): int
    {
        $sql = "INSERT INTO `InvoiceLine` (`Invoice_Id`, `Track_Id`, `Unit_Price`, `Quantity`)
                VALUES (?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->invoiceId,
                $dto->trackId,
                $dto->unitPrice,
                $dto->quantity
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(InvoicelineDto $dto): int
    {
        $sql = "UPDATE `InvoiceLine` SET `Invoice_Id` = ?, `Track_Id` = ?, `Unit_Price` = ?, `Quantity` = ?
                WHERE `Invoice_Line_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->invoiceId,
                $dto->trackId,
                $dto->unitPrice,
                $dto->quantity,
                $dto->invoiceLineId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $invoiceLineId): ?InvoicelineDto
    {
        $sql = "SELECT `Invoice_Line_Id`, `Invoice_Id`, `Track_Id`, `Unit_Price`, `Quantity`
                FROM `InvoiceLine` WHERE `Invoice_Line_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$invoiceLineId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new InvoicelineDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `Invoice_Line_Id`, `Invoice_Id`, `Track_Id`, `Unit_Price`, `Quantity`
                FROM `InvoiceLine`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new InvoicelineDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $invoiceLineId): int
    {
        $sql = "DELETE FROM `InvoiceLine` WHERE `Invoice_Line_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$invoiceLineId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}