<?php

declare(strict_types=1);

namespace Chinook\Tests\Track;

use PHPUnit\Framework\TestCase;
use Chinook\Database\DatabaseException;
use Chinook\Track\{ TrackDto, ITrackRepository, TrackRepository };

class TrackRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private TrackDto $dto;
    private ITrackRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Chinook\Database\IDatabase");
        $this->result = $this->createMock("Chinook\Database\IDatabaseResult");
        $this->input = [
            "Track_Id" => 4391,
            "Name" => "anything",
            "Album_Id" => 6714,
            "Media_Type_Id" => 9834,
            "Genre_Id" => 430,
            "Composer" => "first",
            "Milliseconds" => 7093,
            "Bytes" => 4863,
            "Unit_Price" => 675.95,
        ];
        $this->dto = new TrackDto($this->input);
        $this->repository = new TrackRepository($this->db);
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
        $expected = 7396;

        $sql = "INSERT INTO `Track` (`Name`, `Album_Id`, `Media_Type_Id`, `Genre_Id`, `Composer`, `Milliseconds`, `Bytes`, `Unit_Price`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->name,
                $this->dto->albumId,
                $this->dto->mediaTypeId,
                $this->dto->genreId,
                $this->dto->composer,
                $this->dto->milliseconds,
                $this->dto->bytes,
                $this->dto->unitPrice
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
        $expected = 9513;

        $sql = "UPDATE `Track` SET `Name` = ?, `Album_Id` = ?, `Media_Type_Id` = ?, `Genre_Id` = ?, `Composer` = ?, `Milliseconds` = ?, `Bytes` = ?, `Unit_Price` = ?
                WHERE `Track_Id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->name,
                $this->dto->albumId,
                $this->dto->mediaTypeId,
                $this->dto->genreId,
                $this->dto->composer,
                $this->dto->milliseconds,
                $this->dto->bytes,
                $this->dto->unitPrice,
                $this->dto->trackId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $trackId = 405;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($trackId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $trackId = 772;

        $sql = "SELECT `Track_Id`, `Name`, `Album_Id`, `Media_Type_Id`, `Genre_Id`, `Composer`, `Milliseconds`, `Bytes`, `Unit_Price`
                FROM `Track` WHERE `Track_Id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$trackId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($trackId);
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
        $sql = "SELECT `Track_Id`, `Name`, `Album_Id`, `Media_Type_Id`, `Genre_Id`, `Composer`, `Milliseconds`, `Bytes`, `Unit_Price`
                FROM `Track`";

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
        $trackId = 9818;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($trackId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $trackId = 4157;
        $expected = 6030;

        $sql = "DELETE FROM `Track` WHERE `Track_Id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$trackId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($trackId);
        $this->assertEquals($expected, $actual);
    }
}