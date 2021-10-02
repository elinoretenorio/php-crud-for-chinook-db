<?php

declare(strict_types=1);

namespace Chinook\Mediatype;

use Chinook\Database\IDatabase;
use Chinook\Database\DatabaseException;

class MediatypeRepository implements IMediatypeRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(MediatypeDto $dto): int
    {
        $sql = "INSERT INTO `MediaType` (`Name`)
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

    public function update(MediatypeDto $dto): int
    {
        $sql = "UPDATE `MediaType` SET `Name` = ?
                WHERE `Media_Type_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->name,
                $dto->mediaTypeId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $mediaTypeId): ?MediatypeDto
    {
        $sql = "SELECT `Media_Type_Id`, `Name`
                FROM `MediaType` WHERE `Media_Type_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$mediaTypeId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new MediatypeDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `Media_Type_Id`, `Name`
                FROM `MediaType`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new MediatypeDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $mediaTypeId): int
    {
        $sql = "DELETE FROM `MediaType` WHERE `Media_Type_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$mediaTypeId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}