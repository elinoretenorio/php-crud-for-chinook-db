<?php

declare(strict_types=1);

namespace Chinook\Tests\Album;

use PHPUnit\Framework\TestCase;
use Chinook\Album\{ AlbumDto, AlbumModel, IAlbumService, AlbumService };

class AlbumServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private AlbumDto $dto;
    private AlbumModel $model;
    private IAlbumService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Chinook\Album\IAlbumRepository");
        $this->input = [
            "Album_Id" => 7613,
            "Title" => "that",
            "Artist_Id" => 3530,
        ];
        $this->dto = new AlbumDto($this->input);
        $this->model = new AlbumModel($this->dto);
        $this->service = new AlbumService($this->repository);
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
        $expected = 7178;

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
        $expected = 6979;

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
        $albumId = 2895;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($albumId)
            ->willReturn(null);

        $actual = $this->service->get($albumId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $albumId = 1234;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($albumId)
            ->willReturn($this->dto);

        $actual = $this->service->get($albumId);
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
        $albumId = 480;
        $expected = 2276;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($albumId)
            ->willReturn($expected);

        $actual = $this->service->delete($albumId);
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