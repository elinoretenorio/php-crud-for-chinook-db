<?php

declare(strict_types=1);

namespace Chinook\Invoiceline;

use JsonSerializable;

class InvoicelineModel implements JsonSerializable
{
    private int $invoiceLineId;
    private int $invoiceId;
    private int $trackId;
    private float $unitPrice;
    private int $quantity;

    public function __construct(InvoicelineDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->invoiceLineId = $dto->invoiceLineId;
        $this->invoiceId = $dto->invoiceId;
        $this->trackId = $dto->trackId;
        $this->unitPrice = $dto->unitPrice;
        $this->quantity = $dto->quantity;
    }

    public function getInvoiceLineId(): int
    {
        return $this->invoiceLineId;
    }

    public function setInvoiceLineId(int $invoiceLineId): void
    {
        $this->invoiceLineId = $invoiceLineId;
    }

    public function getInvoiceId(): int
    {
        return $this->invoiceId;
    }

    public function setInvoiceId(int $invoiceId): void
    {
        $this->invoiceId = $invoiceId;
    }

    public function getTrackId(): int
    {
        return $this->trackId;
    }

    public function setTrackId(int $trackId): void
    {
        $this->trackId = $trackId;
    }

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(float $unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function toDto(): InvoicelineDto
    {
        $dto = new InvoicelineDto();
        $dto->invoiceLineId = (int) ($this->invoiceLineId ?? 0);
        $dto->invoiceId = (int) ($this->invoiceId ?? 0);
        $dto->trackId = (int) ($this->trackId ?? 0);
        $dto->unitPrice = (float) ($this->unitPrice ?? 0);
        $dto->quantity = (int) ($this->quantity ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "Invoice_Line_Id" => $this->invoiceLineId,
            "Invoice_Id" => $this->invoiceId,
            "Track_Id" => $this->trackId,
            "Unit_Price" => $this->unitPrice,
            "Quantity" => $this->quantity,
        ];
    }
}