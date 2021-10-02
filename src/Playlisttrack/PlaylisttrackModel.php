<?php

declare(strict_types=1);

namespace Chinook\Playlisttrack;

use JsonSerializable;

class PlaylisttrackModel implements JsonSerializable
{
    private int $playlistTrackId;
    private int $playlistId;
    private int $trackId;

    public function __construct(PlaylisttrackDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->playlistTrackId = $dto->playlistTrackId;
        $this->playlistId = $dto->playlistId;
        $this->trackId = $dto->trackId;
    }

    public function getPlaylistTrackId(): int
    {
        return $this->playlistTrackId;
    }

    public function setPlaylistTrackId(int $playlistTrackId): void
    {
        $this->playlistTrackId = $playlistTrackId;
    }

    public function getPlaylistId(): int
    {
        return $this->playlistId;
    }

    public function setPlaylistId(int $playlistId): void
    {
        $this->playlistId = $playlistId;
    }

    public function getTrackId(): int
    {
        return $this->trackId;
    }

    public function setTrackId(int $trackId): void
    {
        $this->trackId = $trackId;
    }

    public function toDto(): PlaylisttrackDto
    {
        $dto = new PlaylisttrackDto();
        $dto->playlistTrackId = (int) ($this->playlistTrackId ?? 0);
        $dto->playlistId = (int) ($this->playlistId ?? 0);
        $dto->trackId = (int) ($this->trackId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "Playlist_Track_Id" => $this->playlistTrackId,
            "Playlist_Id" => $this->playlistId,
            "Track_Id" => $this->trackId,
        ];
    }
}