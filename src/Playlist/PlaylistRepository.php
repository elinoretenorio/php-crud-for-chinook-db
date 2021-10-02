<?php

declare(strict_types=1);

namespace Chinook\Playlist;

use Chinook\Database\IDatabase;
use Chinook\Database\DatabaseException;

class PlaylistRepository implements IPlaylistRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(PlaylistDto $dto): int
    {
        $sql = "INSERT INTO `Playlist` (`Name`)
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

    public function update(PlaylistDto $dto): int
    {
        $sql = "UPDATE `Playlist` SET `Name` = ?
                WHERE `Playlist_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->name,
                $dto->playlistId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $playlistId): ?PlaylistDto
    {
        $sql = "SELECT `Playlist_Id`, `Name`
                FROM `Playlist` WHERE `Playlist_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$playlistId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new PlaylistDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `Playlist_Id`, `Name`
                FROM `Playlist`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new PlaylistDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $playlistId): int
    {
        $sql = "DELETE FROM `Playlist` WHERE `Playlist_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$playlistId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}