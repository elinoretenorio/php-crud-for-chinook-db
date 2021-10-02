<?php

declare(strict_types=1);

namespace Chinook\Customer;

class CustomerDto 
{
    public int $customerId;
    public string $firstName;
    public string $lastName;
    public string $company;
    public string $address;
    public string $city;
    public string $state;
    public string $country;
    public string $postalCode;
    public string $phone;
    public string $fax;
    public string $email;
    public int $supportRepId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->customerId = (int) ($row["Customer_Id"] ?? 0);
        $this->firstName = $row["First_Name"] ?? "";
        $this->lastName = $row["Last_Name"] ?? "";
        $this->company = $row["Company"] ?? "";
        $this->address = $row["Address"] ?? "";
        $this->city = $row["City"] ?? "";
        $this->state = $row["State"] ?? "";
        $this->country = $row["Country"] ?? "";
        $this->postalCode = $row["Postal_Code"] ?? "";
        $this->phone = $row["Phone"] ?? "";
        $this->fax = $row["Fax"] ?? "";
        $this->email = $row["Email"] ?? "";
        $this->supportRepId = (int) ($row["Support_Rep_Id"] ?? 0);
    }
}