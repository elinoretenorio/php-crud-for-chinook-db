<?php

declare(strict_types=1);

namespace Chinook\Album;

use Chinook\Database\IDatabase;
use Chinook\Database\DatabaseException;

class AlbumRepository implements IAlbumRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(AlbumDto $dto): int
    {
        $sql = "INSERT INTO `Album` (`Title`, `Artist_Id`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->title,
                $dto->artistId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(AlbumDto $dto): int
    {
        $sql = "UPDATE `Album` SET `Title` = ?, `Artist_Id` = ?
                WHERE `Album_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->title,
                $dto->artistId,
                $dto->albumId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $albumId): ?AlbumDto
    {
        $sql = "SELECT `Album_Id`, `Title`, `Artist_Id`
                FROM `Album` WHERE `Album_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$albumId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new AlbumDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `Album_Id`, `Title`, `Artist_Id`
                FROM `Album`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new AlbumDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $albumId): int
    {
        $sql = "DELETE FROM `Album` WHERE `Album_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$albumId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}