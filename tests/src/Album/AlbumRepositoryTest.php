<?php

declare(strict_types=1);

namespace Chinook\Tests\Album;

use PHPUnit\Framework\TestCase;
use Chinook\Database\DatabaseException;
use Chinook\Album\{ AlbumDto, IAlbumRepository, AlbumRepository };

class AlbumRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private AlbumDto $dto;
    private IAlbumRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Chinook\Database\IDatabase");
        $this->result = $this->createMock("Chinook\Database\IDatabaseResult");
        $this->input = [
            "Album_Id" => 1975,
            "Title" => "long",
            "Artist_Id" => 4453,
        ];
        $this->dto = new AlbumDto($this->input);
        $this->repository = new AlbumRepository($this->db);
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
        $expected = 7614;

        $sql = "INSERT INTO `Album` (`Title`, `Artist_Id`)
                VALUES (?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->title,
                $this->dto->artistId
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
        $expected = 1552;

        $sql = "UPDATE `Album` SET `Title` = ?, `Artist_Id` = ?
                WHERE `Album_Id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->title,
                $this->dto->artistId,
                $this->dto->albumId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $albumId = 7069;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($albumId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $albumId = 7212;

        $sql = "SELECT `Album_Id`, `Title`, `Artist_Id`
                FROM `Album` WHERE `Album_Id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$albumId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($albumId);
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
        $sql = "SELECT `Album_Id`, `Title`, `Artist_Id`
                FROM `Album`";

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
        $albumId = 489;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($albumId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $albumId = 5260;
        $expected = 135;

        $sql = "DELETE FROM `Album` WHERE `Album_Id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$albumId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($albumId);
        $this->assertEquals($expected, $actual);
    }
}