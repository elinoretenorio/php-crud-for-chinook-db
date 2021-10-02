<?php

declare(strict_types=1);

namespace Chinook\Artist;

use Chinook\Database\IDatabase;
use Chinook\Database\DatabaseException;

class ArtistRepository implements IArtistRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(ArtistDto $dto): int
    {
        $sql = "INSERT INTO `Artist` (`Name`)
                VALUES (?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->name
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(ArtistDto $dto): int
    {
        $sql = "UPDATE `Artist` SET `Name` = ?
                WHERE `Artist_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->name,
                $dto->artistId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $artistId): ?ArtistDto
    {
        $sql = "SELECT `Artist_Id`, `Name`
                FROM `Artist` WHERE `Artist_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$artistId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new ArtistDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `Artist_Id`, `Name`
                FROM `Artist`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new ArtistDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $artistId): int
    {
        $sql = "DELETE FROM `Artist` WHERE `Artist_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$artistId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}