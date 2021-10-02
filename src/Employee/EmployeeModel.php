<?php

declare(strict_types=1);

namespace Chinook\Employee;

use JsonSerializable;

class EmployeeModel implements JsonSerializable
{
    private int $employeeId;
    private string $lastName;
    private string $firstName;
    private string $title;
    private int $reportsTo;
    private string $birthDate;
    private string $hireDate;
    private string $address;
    private string $city;
    private string $state;
    private string $country;
    private string $postalCode;
    private string $phone;
    private string $fax;
    private string $email;

    public function __construct(EmployeeDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->employeeId = $dto->employeeId;
        $this->lastName = $dto->lastName;
        $this->firstName = $dto->firstName;
        $this->title = $dto->title;
        $this->reportsTo = $dto->reportsTo;
        $this->birthDate = $dto->birthDate;
        $this->hireDate = $dto->hireDate;
        $this->address = $dto->address;
        $this->city = $dto->city;
        $this->state = $dto->state;
        $this->country = $dto->country;
        $this->postalCode = $dto->postalCode;
        $this->phone = $dto->phone;
        $this->fax = $dto->fax;
        $this->email = $dto->email;
    }

    public function getEmployeeId(): int
    {
        return $this->employeeId;
    }

    public function setEmployeeId(int $employeeId): void
    {
        $this->employeeId = $employeeId;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getReportsTo(): int
    {
        return $this->reportsTo;
    }

    public function setReportsTo(int $reportsTo): void
    {
        $this->reportsTo = $reportsTo;
    }

    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    public function setBirthDate(string $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    public function getHireDate(): string
    {
        return $this->hireDate;
    }

    public function setHireDate(string $hireDate): void
    {
        $this->hireDate = $hireDate;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getFax(): string
    {
        return $this->fax;
    }

    public function setFax(string $fax): void
    {
        $this->fax = $fax;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function toDto(): EmployeeDto
    {
        $dto = new EmployeeDto();
        $dto->employeeId = (int) ($this->employeeId ?? 0);
        $dto->lastName = $this->lastName ?? "";
        $dto->firstName = $this->firstName ?? "";
        $dto->title = $this->title ?? "";
        $dto->reportsTo = (int) ($this->reportsTo ?? 0);
        $dto->birthDate = $this->birthDate ?? "";
        $dto->hireDate = $this->hireDate ?? "";
        $dto->address = $this->address ?? "";
        $dto->city = $this->city ?? "";
        $dto->state = $this->state ?? "";
        $dto->country = $this->country ?? "";
        $dto->postalCode = $this->postalCode ?? "";
        $dto->phone = $this->phone ?? "";
        $dto->fax = $this->fax ?? "";
        $dto->email = $this->email ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "Employee_Id" => $this->employeeId,
            "Last_Name" => $this->lastName,
            "First_Name" => $this->firstName,
            "Title" => $this->title,
            "Reports_To" => $this->reportsTo,
            "Birth_Date" => $this->birthDate,
            "Hire_Date" => $this->hireDate,
            "Address" => $this->address,
            "City" => $this->city,
            "State" => $this->state,
            "Country" => $this->country,
            "Postal_Code" => $this->postalCode,
            "Phone" => $this->phone,
            "Fax" => $this->fax,
            "Email" => $this->email,
        ];
    }
}