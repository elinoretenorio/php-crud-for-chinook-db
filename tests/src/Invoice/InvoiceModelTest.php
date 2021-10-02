<?php

declare(strict_types=1);

namespace Chinook\Tests\Invoice;

use PHPUnit\Framework\TestCase;
use Chinook\Invoice\{ InvoiceDto, InvoiceModel };

class InvoiceModelTest extends TestCase
{
    private array $input;
    private InvoiceDto $dto;
    private InvoiceModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "Invoice_Id" => 3765,
            "Customer_Id" => 2218,
            "Invoice_Date" => "2021-09-30 07:15:21",
            "Billing_Address" => "which",
            "Billing_City" => "would",
            "Billing_State" => "glass",
            "Billing_Country" => "argue",
            "Billing_Postal_Code" => "first",
            "Total" => 324.23,
        ];
        $this->dto = new InvoiceDto($this->input);
        $this->model = new InvoiceModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new InvoiceModel(null);

        $this->assertInstanceOf(InvoiceModel::class, $model);
    }

    public function testGetInvoiceId(): void
    {
        $this->assertEquals($this->dto->invoiceId, $this->model->getInvoiceId());
    }

    public function testSetInvoiceId(): void
    {
        $expected = 4652;
        $model = $this->model;
        $model->setInvoiceId($expected);

        $this->assertEquals($expected, $model->getInvoiceId());
    }

    public function testGetCustomerId(): void
    {
        $this->assertEquals($this->dto->customerId, $this->model->getCustomerId());
    }

    public function testSetCustomerId(): void
    {
        $expected = 8830;
        $model = $this->model;
        $model->setCustomerId($expected);

        $this->assertEquals($expected, $model->getCustomerId());
    }

    public function testGetInvoiceDate(): void
    {
        $this->assertEquals($this->dto->invoiceDate, $this->model->getInvoiceDate());
    }

    public function testSetInvoiceDate(): void
    {
        $expected = "2021-10-08 01:31:51";
        $model = $this->model;
        $model->setInvoiceDate($expected);

        $this->assertEquals($expected, $model->getInvoiceDate());
    }

    public function testGetBillingAddress(): void
    {
        $this->assertEquals($this->dto->billingAddress, $this->model->getBillingAddress());
    }

    public function testSetBillingAddress(): void
    {
        $expected = "eye";
        $model = $this->model;
        $model->setBillingAddress($expected);

        $this->assertEquals($expected, $model->getBillingAddress());
    }

    public function testGetBillingCity(): void
    {
        $this->assertEquals($this->dto->billingCity, $this->model->getBillingCity());
    }

    public function testSetBillingCity(): void
    {
        $expected = "standard";
        $model = $this->model;
        $model->setBillingCity($expected);

        $this->assertEquals($expected, $model->getBillingCity());
    }

    public function testGetBillingState(): void
    {
        $this->assertEquals($this->dto->billingState, $this->model->getBillingState());
    }

    public function testSetBillingState(): void
    {
        $expected = "kitchen";
        $model = $this->model;
        $model->setBillingState($expected);

        $this->assertEquals($expected, $model->getBillingState());
    }

    public function testGetBillingCountry(): void
    {
        $this->assertEquals($this->dto->billingCountry, $this->model->getBillingCountry());
    }

    public function testSetBillingCountry(): void
    {
        $expected = "television";
        $model = $this->model;
        $model->setBillingCountry($expected);

        $this->assertEquals($expected, $model->getBillingCountry());
    }

    public function testGetBillingPostalCode(): void
    {
        $this->assertEquals($this->dto->billingPostalCode, $this->model->getBillingPostalCode());
    }

    public function testSetBillingPostalCode(): void
    {
        $expected = "discuss";
        $model = $this->model;
        $model->setBillingPostalCode($expected);

        $this->assertEquals($expected, $model->getBillingPostalCode());
    }

    public function testGetTotal(): void
    {
        $this->assertEquals($this->dto->total, $this->model->getTotal());
    }

    public function testSetTotal(): void
    {
        $expected = 664.83;
        $model = $this->model;
        $model->setTotal($expected);

        $this->assertEquals($expected, $model->getTotal());
    }

    public function testToDto(): void
    {
        $this->assertEquals($this->dto, $this->model->toDto());
    }

    public function testJsonSerialize(): void
    {
        $this->assertEquals($this->input, $this->model->jsonSerialize());
    }
}