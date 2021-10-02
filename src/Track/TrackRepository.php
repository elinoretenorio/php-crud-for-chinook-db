<?php

declare(strict_types=1);

namespace Chinook\Track;

use Chinook\Database\IDatabase;
use Chinook\Database\DatabaseException;

class TrackRepository implements ITrackRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(TrackDto $dto): int
    {
        $sql = "INSERT INTO `Track` (`Name`, `Album_Id`, `Media_Type_Id`, `Genre_Id`, `Composer`, `Milliseconds`, `Bytes`, `Unit_Price`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->name,
                $dto->albumId,
                $dto->mediaTypeId,
                $dto->genreId,
                $dto->composer,
                $dto->milliseconds,
                $dto->bytes,
                $dto->unitPrice
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(TrackDto $dto): int
    {
        $sql = "UPDATE `Track` SET `Name` = ?, `Album_Id` = ?, `Media_Type_Id` = ?, `Genre_Id` = ?, `Composer` = ?, `Milliseconds` = ?, `Bytes` = ?, `Unit_Price` = ?
                WHERE `Track_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->name,
                $dto->albumId,
                $dto->mediaTypeId,
                $dto->genreId,
                $dto->composer,
                $dto->milliseconds,
                $dto->bytes,
                $dto->unitPrice,
                $dto->trackId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $trackId): ?TrackDto
    {
        $sql = "SELECT `Track_Id`, `Name`, `Album_Id`, `Media_Type_Id`, `Genre_Id`, `Composer`, `Milliseconds`, `Bytes`, `Unit_Price`
                FROM `Track` WHERE `Track_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$trackId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new TrackDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `Track_Id`, `Name`, `Album_Id`, `Media_Type_Id`, `Genre_Id`, `Composer`, `Milliseconds`, `Bytes`, `Unit_Price`
                FROM `Track`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new TrackDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $trackId): int
    {
        $sql = "DELETE FROM `Track` WHERE `Track_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$trackId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}