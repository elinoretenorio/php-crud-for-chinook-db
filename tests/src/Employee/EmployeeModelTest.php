<?php

declare(strict_types=1);

namespace Chinook\Tests\Employee;

use PHPUnit\Framework\TestCase;
use Chinook\Employee\{ EmployeeDto, EmployeeModel };

class EmployeeModelTest extends TestCase
{
    private array $input;
    private EmployeeDto $dto;
    private EmployeeModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "Employee_Id" => 9675,
            "Last_Name" => "soldier",
            "First_Name" => "child",
            "Title" => "building",
            "Reports_To" => 4861,
            "Birth_Date" => "2021-10-02 10:17:04",
            "Hire_Date" => "2021-10-07 18:55:12",
            "Address" => "movie",
            "City" => "discuss",
            "State" => "feel",
            "Country" => "add",
            "Postal_Code" => "according",
            "Phone" => "page",
            "Fax" => "suddenly",
            "Email" => "State those off crime artist time include news.",
        ];
        $this->dto = new EmployeeDto($this->input);
        $this->model = new EmployeeModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new EmployeeModel(null);

        $this->assertInstanceOf(EmployeeModel::class, $model);
    }

    public function testGetEmployeeId(): void
    {
        $this->assertEquals($this->dto->employeeId, $this->model->getEmployeeId());
    }

    public function testSetEmployeeId(): void
    {
        $expected = 2470;
        $model = $this->model;
        $model->setEmployeeId($expected);

        $this->assertEquals($expected, $model->getEmployeeId());
    }

    public function testGetLastName(): void
    {
        $this->assertEquals($this->dto->lastName, $this->model->getLastName());
    }

    public function testSetLastName(): void
    {
        $expected = "nearly";
        $model = $this->model;
        $model->setLastName($expected);

        $this->assertEquals($expected, $model->getLastName());
    }

    public function testGetFirstName(): void
    {
        $this->assertEquals($this->dto->firstName, $this->model->getFirstName());
    }

    public function testSetFirstName(): void
    {
        $expected = "life";
        $model = $this->model;
        $model->setFirstName($expected);

        $this->assertEquals($expected, $model->getFirstName());
    }

    public function testGetTitle(): void
    {
        $this->assertEquals($this->dto->title, $this->model->getTitle());
    }

    public function testSetTitle(): void
    {
        $expected = "fact";
        $model = $this->model;
        $model->setTitle($expected);

        $this->assertEquals($expected, $model->getTitle());
    }

    public function testGetReportsTo(): void
    {
        $this->assertEquals($this->dto->reportsTo, $this->model->getReportsTo());
    }

    public function testSetReportsTo(): void
    {
        $expected = 6515;
        $model = $this->model;
        $model->setReportsTo($expected);

        $this->assertEquals($expected, $model->getReportsTo());
    }

    public function testGetBirthDate(): void
    {
        $this->assertEquals($this->dto->birthDate, $this->model->getBirthDate());
    }

    public function testSetBirthDate(): void
    {
        $expected = "2021-09-25 04:42:06";
        $model = $this->model;
        $model->setBirthDate($expected);

        $this->assertEquals($expected, $model->getBirthDate());
    }

    public function testGetHireDate(): void
    {
        $this->assertEquals($this->dto->hireDate, $this->model->getHireDate());
    }

    public function testSetHireDate(): void
    {
        $expected = "2021-09-20 21:34:38";
        $model = $this->model;
        $model->setHireDate($expected);

        $this->assertEquals($expected, $model->getHireDate());
    }

    public function testGetAddress(): void
    {
        $this->assertEquals($this->dto->address, $this->model->getAddress());
    }

    public function testSetAddress(): void
    {
        $expected = "church";
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
        $expected = "protect";
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
        $expected = "like";
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
        $expected = "tree";
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
        $expected = "run";
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
        $expected = "green";
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
        $expected = "organization";
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
        $expected = "Six road become although.";
        $model = $this->model;
        $model->setEmail($expected);

        $this->assertEquals($expected, $model->getEmail());
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