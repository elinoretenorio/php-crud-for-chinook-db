<?php

declare(strict_types=1);

namespace Chinook\Invoice;

class InvoiceDto 
{
    public int $invoiceId;
    public int $customerId;
    public string $invoiceDate;
    public string $billingAddress;
    public string $billingCity;
    public string $billingState;
    public string $billingCountry;
    public string $billingPostalCode;
    public float $total;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->invoiceId = (int) ($row["Invoice_Id"] ?? 0);
        $this->customerId = (int) ($row["Customer_Id"] ?? 0);
        $this->invoiceDate = $row["Invoice_Date"] ?? "";
        $this->billingAddress = $row["Billing_Address"] ?? "";
        $this->billingCity = $row["Billing_City"] ?? "";
        $this->billingState = $row["Billing_State"] ?? "";
        $this->billingCountry = $row["Billing_Country"] ?? "";
        $this->billingPostalCode = $row["Billing_Postal_Code"] ?? "";
        $this->total = (float) ($row["Total"] ?? 0);
    }
}