<?php

declare(strict_types=1);

namespace Chinook\Genre;

use Chinook\Database\IDatabase;
use Chinook\Database\DatabaseException;

class GenreRepository implements IGenreRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(GenreDto $dto): int
    {
        $sql = "INSERT INTO `Genre` (`Name`)
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

    public function update(GenreDto $dto): int
    {
        $sql = "UPDATE `Genre` SET `Name` = ?
                WHERE `Genre_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->name,
                $dto->genreId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $genreId): ?GenreDto
    {
        $sql = "SELECT `Genre_Id`, `Name`
                FROM `Genre` WHERE `Genre_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$genreId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new GenreDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `Genre_Id`, `Name`
                FROM `Genre`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new GenreDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $genreId): int
    {
        $sql = "DELETE FROM `Genre` WHERE `Genre_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$genreId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}