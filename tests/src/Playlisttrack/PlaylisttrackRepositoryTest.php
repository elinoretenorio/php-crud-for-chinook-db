<?php

declare(strict_types=1);

namespace Chinook\Tests\Playlisttrack;

use PHPUnit\Framework\TestCase;
use Chinook\Database\DatabaseException;
use Chinook\Playlisttrack\{ PlaylisttrackDto, IPlaylisttrackRepository, PlaylisttrackRepository };

class PlaylisttrackRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private PlaylisttrackDto $dto;
    private IPlaylisttrackRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Chinook\Database\IDatabase");
        $this->result = $this->createMock("Chinook\Database\IDatabaseResult");
        $this->input = [
            "Playlist_Track_Id" => 4064,
            "Playlist_Id" => 9013,
            "Track_Id" => 2589,
        ];
        $this->dto = new PlaylisttrackDto($this->input);
        $this->repository = new PlaylisttrackRepository($this->db);
    }

    protected function tearDown(): void
    {
        unset($this->db);
        unset($this->result);
        unset($this->input);
        unset($this->dto);
        unset($this->repository);
    }

    public function testInsert_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 2404;

        $sql = "INSERT INTO `PlaylistTrack` (`Playlist_Id`, `Track_Id`)
                VALUES (?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->playlistId,
                $this->dto->trackId
            ]);
        $this->db->expects($this->once())
            ->method("lastInsertId")
            ->willReturn($expected);

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 5426;

        $sql = "UPDATE `PlaylistTrack` SET `Playlist_Id` = ?, `Track_Id` = ?
                WHERE `Playlist_Track_Id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->playlistId,
                $this->dto->trackId,
                $this->dto->playlistTrackId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $playlistTrackId = 4902;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($playlistTrackId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $playlistTrackId = 4888;

        $sql = "SELECT `Playlist_Track_Id`, `Playlist_Id`, `Track_Id`
                FROM `PlaylistTrack` WHERE `Playlist_Track_Id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$playlistTrackId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($playlistTrackId);
        $this->assertEquals($this->dto, $actual);
    }

    public function testGetAll_ReturnsEmptyOnException(): void
    {
        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsDtos(): void
    {
        $sql = "SELECT `Playlist_Track_Id`, `Playlist_Id`, `Track_Id`
                FROM `PlaylistTrack`";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute");
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->getAll();
        $this->assertEquals([$this->dto], $actual);
    }

    public function testDelete_ReturnsFailedOnException(): void
    {
        $playlistTrackId = 8993;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($playlistTrackId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $playlistTrackId = 5152;
        $expected = 1513;

        $sql = "DELETE FROM `PlaylistTrack` WHERE `Playlist_Track_Id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$playlistTrackId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($playlistTrackId);
        $this->assertEquals($expected, $actual);
    }
}