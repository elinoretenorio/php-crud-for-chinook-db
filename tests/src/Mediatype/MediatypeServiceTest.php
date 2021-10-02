<?php

declare(strict_types=1);

namespace Chinook\Tests\Mediatype;

use PHPUnit\Framework\TestCase;
use Chinook\Mediatype\{ MediatypeDto, MediatypeModel, IMediatypeService, MediatypeService };

class MediatypeServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private MediatypeDto $dto;
    private MediatypeModel $model;
    private IMediatypeService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Chinook\Mediatype\IMediatypeRepository");
        $this->input = [
            "Media_Type_Id" => 2094,
            "Name" => "power",
        ];
        $this->dto = new MediatypeDto($this->input);
        $this->model = new MediatypeModel($this->dto);
        $this->service = new MediatypeService($this->repository);
    }

    protected function tearDown(): void
    {
        unset($this->repository);
        unset($this->input);
        unset($this->dto);
        unset($this->model);
        unset($this->service);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 8882;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEmpty($actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 6044;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsNull(): void
    {
        $mediaTypeId = 4989;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($mediaTypeId)
            ->willReturn(null);

        $actual = $this->service->get($mediaTypeId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $mediaTypeId = 8137;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($mediaTypeId)
            ->willReturn($this->dto);

        $actual = $this->service->get($mediaTypeId);
        $this->assertEquals($this->model, $actual);
    }

    public function testGetAll_ReturnsEmpty(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([]);

        $actual = $this->service->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsModels(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([$this->dto]);

        $actual = $this->service->getAll();
        $this->assertEquals([$this->model], $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $mediaTypeId = 731;
        $expected = 9087;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($mediaTypeId)
            ->willReturn($expected);

        $actual = $this->service->delete($mediaTypeId);
        $this->assertEquals($expected, $actual);
    }

    public function testCreateModel_ReturnsNullIfEmpty(): void
    {
        $actual = $this->service->createModel([]);
        $this->assertNull($actual);
    }

    public function testCreateModel_ReturnsModel(): void
    {
        $actual = $this->service->createModel($this->input);
        $this->assertEquals($this->model, $actual);
    }
}