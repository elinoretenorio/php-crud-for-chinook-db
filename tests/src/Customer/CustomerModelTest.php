<?php

declare(strict_types=1);

namespace Chinook\Tests\Customer;

use PHPUnit\Framework\TestCase;
use Chinook\Customer\{ CustomerDto, CustomerModel };

class CustomerModelTest extends TestCase
{
    private array $input;
    private CustomerDto $dto;
    private CustomerModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "Customer_Id" => 1293,
            "First_Name" => "staff",
            "Last_Name" => "nature",
            "Company" => "necessary",
            "Address" => "success",
            "City" => "campaign",
            "State" => "ability",
            "Country" => "old",
            "Postal_Code" => "return",
            "Phone" => "receive",
            "Fax" => "mission",
            "Email" => "Store remain question ten ten drive.",
            "Support_Rep_Id" => 3009,
        ];
        $this->dto = new CustomerDto($this->input);
        $this->model = new CustomerModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new CustomerModel(null);

        $this->assertInstanceOf(CustomerModel::class, $model);
    }

    public function testGetCustomerId(): void
    {
        $this->assertEquals($this->dto->customerId, $this->model->getCustomerId());
    }

    public function testSetCustomerId(): void
    {
        $expected = 6179;
        $model = $this->model;
        $model->setCustomerId($expected);

        $this->assertEquals($expected, $model->getCustomerId());
    }

    public function testGetFirstName(): void
    {
        $this->assertEquals($this->dto->firstName, $this->model->getFirstName());
    }

    public function testSetFirstName(): void
    {
        $expected = "turn";
        $model = $this->model;
        $model->setFirstName($expected);

        $this->assertEquals($expected, $model->getFirstName());
    }

    public function testGetLastName(): void
    {
        $this->assertEquals($this->dto->lastName, $this->model->getLastName());
    }

    public function testSetLastName(): void
    {
        $expected = "kid";
        $model = $this->model;
        $model->setLastName($expected);

        $this->assertEquals($expected, $model->getLastName());
    }

    public function testGetCompany(): void
    {
        $this->assertEquals($this->dto->company, $this->model->getCompany());
    }

    public function testSetCompany(): void
    {
        $expected = "sort";
        $model = $this->model;
        $model->setCompany($expected);

        $this->assertEquals($expected, $model->getCompany());
    }

    public function testGetAddress(): void
    {
        $this->assertEquals($this->dto->address, $this->model->getAddress());
    }

    public function testSetAddress(): void
    {
        $expected = "affect";
        $model = $this->model;
        $model->setAddress($expected);

        $this->assertEquals($expected, $model->getAddress());
    }

    public function testGetCity(): void
    {
        $this->assertEquals($this->dto->city, $this->model->getCity());
    }

    public function testSetCity(): void
    {
        $expected = "number";
        $model = $this->model;
        $model->setCity($expected);

        $this->assertEquals($expected, $model->getCity());
    }

    public function testGetState(): void
    {
        $this->assertEquals($this->dto->state, $this->model->getState());
    }

    public function testSetState(): void
    {
        $expected = "lot";
        $model = $this->model;
        $model->setState($expected);

        $this->assertEquals($expected, $model->getState());
    }

    public function testGetCountry(): void
    {
        $this->assertEquals($this->dto->country, $this->model->getCountry());
    }

    public function testSetCountry(): void
    {
        $expected = "institution";
        $model = $this->model;
        $model->setCountry($expected);

        $this->assertEquals($expected, $model->getCountry());
    }

    public function testGetPostalCode(): void
    {
        $this->assertEquals($this->dto->postalCode, $this->model->getPostalCode());
    }

    public function testSetPostalCode(): void
    {
        $expected = "he";
        $model = $this->model;
        $model->setPostalCode($expected);

        $this->assertEquals($expected, $model->getPostalCode());
    }

    public function testGetPhone(): void
    {
        $this->assertEquals($this->dto->phone, $this->model->getPhone());
    }

    public function testSetPhone(): void
    {
        $expected = "example";
        $model = $this->model;
        $model->setPhone($expected);

        $this->assertEquals($expected, $model->getPhone());
    }

    public function testGetFax(): void
    {
        $this->assertEquals($this->dto->fax, $this->model->getFax());
    }

    public function testSetFax(): void
    {
        $expected = "five";
        $model = $this->model;
        $model->setFax($expected);

        $this->assertEquals($expected, $model->getFax());
    }

    public function testGetEmail(): void
    {
        $this->assertEquals($this->dto->email, $this->model->getEmail());
    }

    public function testSetEmail(): void
    {
        $expected = "Condition issue address a heart radio.";
        $model = $this->model;
        $model->setEmail($expected);

        $this->assertEquals($expected, $model->getEmail());
    }

    public function testGetSupportRepId(): void
    {
        $this->assertEquals($this->dto->supportRepId, $this->model->getSupportRepId());
    }

    public function testSetSupportRepId(): void
    {
        $expected = 6385;
        $model = $this->model;
        $model->setSupportRepId($expected);

        $this->assertEquals($expected, $model->getSupportRepId());
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