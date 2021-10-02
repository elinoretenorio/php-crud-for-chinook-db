<?php

declare(strict_types=1);

namespace Chinook\Tests\Track;

use PHPUnit\Framework\TestCase;
use Chinook\Track\{ TrackDto, TrackModel, ITrackService, TrackService };

class TrackServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private TrackDto $dto;
    private TrackModel $model;
    private ITrackService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Chinook\Track\ITrackRepository");
        $this->input = [
            "Track_Id" => 9006,
            "Name" => "boy",
            "Album_Id" => 7048,
            "Media_Type_Id" => 2562,
            "Genre_Id" => 6715,
            "Composer" => "form",
            "Milliseconds" => 3440,
            "Bytes" => 8261,
            "Unit_Price" => 420.97,
        ];
        $this->dto = new TrackDto($this->input);
        $this->model = new TrackModel($this->dto);
        $this->service = new TrackService($this->repository);
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
        $expected = 8462;

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
        $expected = 4549;

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
        $trackId = 729;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($trackId)
            ->willReturn(null);

        $actual = $this->service->get($trackId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $trackId = 3774;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($trackId)
            ->willReturn($this->dto);

        $actual = $this->service->get($trackId);
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
        $trackId = 3832;
        $expected = 823;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($trackId)
            ->willReturn($expected);

        $actual = $this->service->delete($trackId);
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