<?php

declare(strict_types=1);

namespace Chinook\Tests\Employee;

use PHPUnit\Framework\TestCase;
use Chinook\Employee\{ EmployeeDto, EmployeeModel, EmployeeController };

class EmployeeControllerTest extends TestCase
{
    private array $input;
    private EmployeeDto $dto;
    private EmployeeModel $model;
    private $service;
    private $request;
    private $stream;
    private EmployeeController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "Employee_Id" => 3031,
            "Last_Name" => "tough",
            "First_Name" => "lose",
            "Title" => "hair",
            "Reports_To" => 1223,
            "Birth_Date" => "2021-09-21 23:21:26",
            "Hire_Date" => "2021-09-19 21:55:33",
            "Address" => "edge",
            "City" => "should",
            "State" => "thank",
            "Country" => "political",
            "Postal_Code" => "light",
            "Phone" => "bit",
            "Fax" => "myself",
            "Email" => "Firm believe behind young.",
        ];
        $this->dto = new EmployeeDto($this->input);
        $this->model = new EmployeeModel($this->dto);
        $this->service = $this->createMock("Chinook\Employee\IEmployeeService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new EmployeeController(
            $this->service
        );

        $this->stream->method("getContents")
            ->willReturn("[]");

        $this->request->method("getBody")
            ->willReturn($this->stream);

        $this->request->method("getParsedBody")
            ->willReturn($this->input);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
        unset($this->service);
        unset($this->request);
        unset($this->stream);
        unset($this->controller);
    }

    public function testInsert_ReturnsResponse(): void
    {
        $id = 9970;
        $expected = ["result" => $id];
        $args = [];

        $this->service->expects($this->once())
            ->method("createModel")
            ->with($this->request->getParsedBody())
            ->willReturn($this->model);
        $this->service->expects($this->once())
            ->method("insert")
            ->with($this->model)
            ->willReturn($id);

        $actual = $this->controller->insert($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["Employee_Id" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 510;
        $expected = ["result" => $id];
        $args = ["Employee_Id" => 2168];

        $this->service->expects($this->once())
            ->method("createModel")
            ->with($this->request->getParsedBody())
            ->willReturn($this->model);
        $this->service->expects($this->once())
            ->method("update")
            ->with($this->model)
            ->willReturn($id);

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["Employee_Id" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["Employee_Id" => 6714];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["Employee_Id"])
            ->willReturn($this->model);

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGetAll_ReturnsResponse(): void
    {
        $expected = ["result" => [$this->model->jsonSerialize()]];
        $args = [];

        $this->service->expects($this->once())
            ->method("getAll")
            ->willReturn([$this->model]);

        $actual = $this->controller->getAll($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["Employee_Id" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 1549;
        $expected = ["result" => $id];
        $args = ["Employee_Id" => 885];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["Employee_Id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}