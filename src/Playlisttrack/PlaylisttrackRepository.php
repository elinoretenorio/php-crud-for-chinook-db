<?php

declare(strict_types=1);

namespace Chinook\Playlisttrack;

use Chinook\Database\IDatabase;
use Chinook\Database\DatabaseException;

class PlaylisttrackRepository implements IPlaylisttrackRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(PlaylisttrackDto $dto): int
    {
        $sql = "INSERT INTO `PlaylistTrack` (`Playlist_Id`, `Track_Id`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->playlistId,
                $dto->trackId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(PlaylisttrackDto $dto): int
    {
        $sql = "UPDATE `PlaylistTrack` SET `Playlist_Id` = ?, `Track_Id` = ?
                WHERE `Playlist_Track_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->playlistId,
                $dto->trackId,
                $dto->playlistTrackId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $playlistTrackId): ?PlaylisttrackDto
    {
        $sql = "SELECT `Playlist_Track_Id`, `Playlist_Id`, `Track_Id`
                FROM `PlaylistTrack` WHERE `Playlist_Track_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$playlistTrackId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new PlaylisttrackDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `Playlist_Track_Id`, `Playlist_Id`, `Track_Id`
                FROM `PlaylistTrack`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new PlaylisttrackDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $playlistTrackId): int
    {
        $sql = "DELETE FROM `PlaylistTrack` WHERE `Playlist_Track_Id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$playlistTrackId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}