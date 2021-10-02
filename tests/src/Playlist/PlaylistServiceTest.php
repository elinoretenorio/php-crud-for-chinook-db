<?php

declare(strict_types=1);

namespace Chinook\Tests\Playlist;

use PHPUnit\Framework\TestCase;
use Chinook\Playlist\{ PlaylistDto, PlaylistModel, IPlaylistService, PlaylistService };

class PlaylistServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private PlaylistDto $dto;
    private PlaylistModel $model;
    private IPlaylistService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Chinook\Playlist\IPlaylistRepository");
        $this->input = [
            "Playlist_Id" => 4744,
            "Name" => "can",
        ];
        $this->dto = new PlaylistDto($this->input);
        $this->model = new PlaylistModel($this->dto);
        $this->service = new PlaylistService($this->repository);
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
        $expected = 8674;

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
        $expected = 6708;

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
        $playlistId = 3279;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($playlistId)
            ->willReturn(null);

        $actual = $this->service->get($playlistId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $playlistId = 7450;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($playlistId)
            ->willReturn($this->dto);

        $actual = $this->service->get($playlistId);
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
        $playlistId = 6746;
        $expected = 7633;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($playlistId)
            ->willReturn($expected);

        $actual = $this->service->delete($playlistId);
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