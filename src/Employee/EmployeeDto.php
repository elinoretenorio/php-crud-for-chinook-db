<?php

declare(strict_types=1);

namespace Chinook\Employee;

class EmployeeDto 
{
    public int $employeeId;
    public string $lastName;
    public string $firstName;
    public string $title;
    public int $reportsTo;
    public string $birthDate;
    public string $hireDate;
    public string $address;
    public string $city;
    public string $state;
    public string $country;
    public string $postalCode;
    public string $phone;
    public string $fax;
    public string $email;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->employeeId = (int) ($row["Employee_Id"] ?? 0);
        $this->lastName = $row["Last_Name"] ?? "";
        $this->firstName = $row["First_Name"] ?? "";
        $this->title = $row["Title"] ?? "";
        $this->reportsTo = (int) ($row["Reports_To"] ?? 0);
        $this->birthDate = $row["Birth_Date"] ?? "";
        $this->hireDate = $row["Hire_Date"] ?? "";
        $this->address = $row["Address"] ?? "";
        $this->city = $row["City"] ?? "";
        $this->state = $row["State"] ?? "";
        $this->country = $row["Country"] ?? "";
        $this->postalCode = $row["Postal_Code"] ?? "";
        $this->phone = $row["Phone"] ?? "";
        $this->fax = $row["Fax"] ?? "";
        $this->email = $row["Email"] ?? "";
    }
}