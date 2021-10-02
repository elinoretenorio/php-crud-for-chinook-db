<?php

declare(strict_types=1);

namespace Chinook\Invoiceline;

class InvoicelineDto 
{
    public int $invoiceLineId;
    public int $invoiceId;
    public int $trackId;
    public float $unitPrice;
    public int $quantity;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->invoiceLineId = (int) ($row["Invoice_Line_Id"] ?? 0);
        $this->invoiceId = (int) ($row["Invoice_Id"] ?? 0);
        $this->trackId = (int) ($row["Track_Id"] ?? 0);
        $this->unitPrice = (float) ($row["Unit_Price"] ?? 0);
        $this->quantity = (int) ($row["Quantity"] ?? 0);
    }
}