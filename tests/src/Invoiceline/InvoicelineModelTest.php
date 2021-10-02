<?php

declare(strict_types=1);

namespace Chinook\Tests\Invoiceline;

use PHPUnit\Framework\TestCase;
use Chinook\Invoiceline\{ InvoicelineDto, InvoicelineModel };

class InvoicelineModelTest extends TestCase
{
    private array $input;
    private InvoicelineDto $dto;
    private InvoicelineModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "Invoice_Line_Id" => 1671,
            "Invoice_Id" => 6929,
            "Track_Id" => 4926,
            "Unit_Price" => 303.19,
            "Quantity" => 7877,
        ];
        $this->dto = new InvoicelineDto($this->input);
        $this->model = new InvoicelineModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new InvoicelineModel(null);

        $this->assertInstanceOf(InvoicelineModel::class, $model);
    }

    public function testGetInvoiceLineId(): void
    {
        $this->assertEquals($this->dto->invoiceLineId, $this->model->getInvoiceLineId());
    }

    public function testSetInvoiceLineId(): void
    {
        $expected = 1739;
        $model = $this->model;
        $model->setInvoiceLineId($expected);

        $this->assertEquals($expected, $model->getInvoiceLineId());
    }

    public function testGetInvoiceId(): void
    {
        $this->assertEquals($this->dto->invoiceId, $this->model->getInvoiceId());
    }

    public function testSetInvoiceId(): void
    {
        $expected = 4287;
        $model = $this->model;
        $model->setInvoiceId($expected);

        $this->assertEquals($expected, $model->getInvoiceId());
    }

    public function testGetTrackId(): void
    {
        $this->assertEquals($this->dto->trackId, $this->model->getTrackId());
    }

    public function testSetTrackId(): void
    {
        $expected = 9774;
        $model = $this->model;
        $model->setTrackId($expected);

        $this->assertEquals($expected, $model->getTrackId());
    }

    public function testGetUnitPrice(): void
    {
        $this->assertEquals($this->dto->unitPrice, $this->model->getUnitPrice());
    }

    public function testSetUnitPrice(): void
    {
        $expected = 100.30;
        $model = $this->model;
        $model->setUnitPrice($expected);

        $this->assertEquals($expected, $model->getUnitPrice());
    }

    public function testGetQuantity(): void
    {
        $this->assertEquals($this->dto->quantity, $this->model->getQuantity());
    }

    public function testSetQuantity(): void
    {
        $expected = 8008;
        $model = $this->model;
        $model->setQuantity($expected);

        $this->assertEquals($expected, $model->getQuantity());
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