<?php

declare(strict_types=1);

namespace Chinook\Invoice;

use JsonSerializable;

class InvoiceModel implements JsonSerializable
{
    private int $invoiceId;
    private int $customerId;
    private string $invoiceDate;
    private string $billingAddress;
    private string $billingCity;
    private string $billingState;
    private string $billingCountry;
    private string $billingPostalCode;
    private float $total;

    public function __construct(InvoiceDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->invoiceId = $dto->invoiceId;
        $this->customerId = $dto->customerId;
        $this->invoiceDate = $dto->invoiceDate;
        $this->billingAddress = $dto->billingAddress;
        $this->billingCity = $dto->billingCity;
        $this->billingState = $dto->billingState;
        $this->billingCountry = $dto->billingCountry;
        $this->billingPostalCode = $dto->billingPostalCode;
        $this->total = $dto->total;
    }

    public function getInvoiceId(): int
    {
        return $this->invoiceId;
    }

    public function setInvoiceId(int $invoiceId): void
    {
        $this->invoiceId = $invoiceId;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function setCustomerId(int $customerId): void
    {
        $this->customerId = $customerId;
    }

    public function getInvoiceDate(): string
    {
        return $this->invoiceDate;
    }

    public function setInvoiceDate(string $invoiceDate): void
    {
        $this->invoiceDate = $invoiceDate;
    }

    public function getBillingAddress(): string
    {
        return $this->billingAddress;
    }

    public function setBillingAddress(string $billingAddress): void
    {
        $this->billingAddress = $billingAddress;
    }

    public function getBillingCity(): string
    {
        return $this->billingCity;
    }

    public function setBillingCity(string $billingCity): void
    {
        $this->billingCity = $billingCity;
    }

    public function getBillingState(): string
    {
        return $this->billingState;
    }

    public function setBillingState(string $billingState): void
    {
        $this->billingState = $billingState;
    }

    public function getBillingCountry(): string
    {
        return $this->billingCountry;
    }

    public function setBillingCountry(string $billingCountry): void
    {
        $this->billingCountry = $billingCountry;
    }

    public function getBillingPostalCode(): string
    {
        return $this->billingPostalCode;
    }

    public function setBillingPostalCode(string $billingPostalCode): void
    {
        $this->billingPostalCode = $billingPostalCode;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function setTotal(float $total): void
    {
        $this->total = $total;
    }

    public function toDto(): InvoiceDto
    {
        $dto = new InvoiceDto();
        $dto->invoiceId = (int) ($this->invoiceId ?? 0);
        $dto->customerId = (int) ($this->customerId ?? 0);
        $dto->invoiceDate = $this->invoiceDate ?? "";
        $dto->billingAddress = $this->billingAddress ?? "";
        $dto->billingCity = $this->billingCity ?? "";
        $dto->billingState = $this->billingState ?? "";
        $dto->billingCountry = $this->billingCountry ?? "";
        $dto->billingPostalCode = $this->billingPostalCode ?? "";
        $dto->total = (float) ($this->total ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "Invoice_Id" => $this->invoiceId,
            "Customer_Id" => $this->customerId,
            "Invoice_Date" => $this->invoiceDate,
            "Billing_Address" => $this->billingAddress,
            "Billing_City" => $this->billingCity,
            "Billing_State" => $this->billingState,
            "Billing_Country" => $this->billingCountry,
            "Billing_Postal_Code" => $this->billingPostalCode,
            "Total" => $this->total,
        ];
    }
}