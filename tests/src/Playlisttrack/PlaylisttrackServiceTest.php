<?php

declare(strict_types=1);

namespace Chinook\Tests\Playlisttrack;

use PHPUnit\Framework\TestCase;
use Chinook\Playlisttrack\{ PlaylisttrackDto, PlaylisttrackModel, IPlaylisttrackService, PlaylisttrackService };

class PlaylisttrackServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private PlaylisttrackDto $dto;
    private PlaylisttrackModel $model;
    private IPlaylisttrackService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Chinook\Playlisttrack\IPlaylisttrackRepository");
        $this->input = [
            "Playlist_Track_Id" => 2594,
            "Playlist_Id" => 8564,
            "Track_Id" => 24,
        ];
        $this->dto = new PlaylisttrackDto($this->input);
        $this->model = new PlaylisttrackModel($this->dto);
        $this->service = new PlaylisttrackService($this->repository);
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
        $expected = 9076;

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
        $expected = 8175;

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
        $playlistTrackId = 6529;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($playlistTrackId)
            ->willReturn(null);

        $actual = $this->service->get($playlistTrackId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $playlistTrackId = 7876;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($playlistTrackId)
            ->willReturn($this->dto);

        $actual = $this->service->get($playlistTrackId);
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
        $playlistTrackId = 9577;
        $expected = 9181;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($playlistTrackId)
            ->willReturn($expected);

        $actual = $this->service->delete($playlistTrackId);
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