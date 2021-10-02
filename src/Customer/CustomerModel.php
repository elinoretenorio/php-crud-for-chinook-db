<?php

declare(strict_types=1);

namespace Chinook\Customer;

use JsonSerializable;

class CustomerModel implements JsonSerializable
{
    private int $customerId;
    private string $firstName;
    private string $lastName;
    private string $company;
    private string $address;
    private string $city;
    private string $state;
    private string $country;
    private string $postalCode;
    private string $phone;
    private string $fax;
    private string $email;
    private int $supportRepId;

    public function __construct(CustomerDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->customerId = $dto->customerId;
        $this->firstName = $dto->firstName;
        $this->lastName = $dto->lastName;
        $this->company = $dto->company;
        $this->address = $dto->address;
        $this->city = $dto->city;
        $this->state = $dto->state;
        $this->country = $dto->country;
        $this->postalCode = $dto->postalCode;
        $this->phone = $dto->phone;
        $this->fax = $dto->fax;
        $this->email = $dto->email;
        $this->supportRepId = $dto->supportRepId;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function setCustomerId(int $customerId): void
    {
        $this->customerId = $customerId;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getCompany(): string
    {
        return $this->company;
    }

    public function setCompany(string $company): void
    {
        $this->company = $company;
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

    public function getSupportRepId(): int
    {
        return $this->supportRepId;
    }

    public function setSupportRepId(int $supportRepId): void
    {
        $this->supportRepId = $supportRepId;
    }

    public function toDto(): CustomerDto
    {
        $dto = new CustomerDto();
        $dto->customerId = (int) ($this->customerId ?? 0);
        $dto->firstName = $this->firstName ?? "";
        $dto->lastName = $this->lastName ?? "";
        $dto->company = $this->company ?? "";
        $dto->address = $this->address ?? "";
        $dto->city = $this->city ?? "";
        $dto->state = $this->state ?? "";
        $dto->country = $this->country ?? "";
        $dto->postalCode = $this->postalCode ?? "";
        $dto->phone = $this->phone ?? "";
        $dto->fax = $this->fax ?? "";
        $dto->email = $this->email ?? "";
        $dto->supportRepId = (int) ($this->supportRepId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "Customer_Id" => $this->customerId,
            "First_Name" => $this->firstName,
            "Last_Name" => $this->lastName,
            "Company" => $this->company,
            "Address" => $this->address,
            "City" => $this->city,
            "State" => $this->state,
            "Country" => $this->country,
            "Postal_Code" => $this->postalCode,
            "Phone" => $this->phone,
            "Fax" => $this->fax,
            "Email" => $this->email,
            "Support_Rep_Id" => $this->supportRepId,
        ];
    }
}