<?php

declare(strict_types=1);

namespace Chinook\Tests\Artist;

use PHPUnit\Framework\TestCase;
use Chinook\Artist\{ ArtistDto, ArtistModel, IArtistService, ArtistService };

class ArtistServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private ArtistDto $dto;
    private ArtistModel $model;
    private IArtistService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Chinook\Artist\IArtistRepository");
        $this->input = [
            "Artist_Id" => 4122,
            "Name" => "share",
        ];
        $this->dto = new ArtistDto($this->input);
        $this->model = new ArtistModel($this->dto);
        $this->service = new ArtistService($this->repository);
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
        $expected = 3689;

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
        $expected = 792;

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
        $artistId = 2832;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($artistId)
            ->willReturn(null);

        $actual = $this->service->get($artistId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $artistId = 3085;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($artistId)
            ->willReturn($this->dto);

        $actual = $this->service->get($artistId);
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
        $artistId = 5128;
        $expected = 2421;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($artistId)
            ->willReturn($expected);

        $actual = $this->service->delete($artistId);
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