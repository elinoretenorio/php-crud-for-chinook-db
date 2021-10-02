<?php

declare(strict_types=1);

namespace Chinook\Playlist;

use JsonSerializable;

class PlaylistModel implements JsonSerializable
{
    private int $playlistId;
    private string $name;

    public function __construct(PlaylistDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->playlistId = $dto->playlistId;
        $this->name = $dto->name;
    }

    public function getPlaylistId(): int
    {
        return $this->playlistId;
    }

    public function setPlaylistId(int $playlistId): void
    {
        $this->playlistId = $playlistId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function toDto(): PlaylistDto
    {
        $dto = new PlaylistDto();
        $dto->playlistId = (int) ($this->playlistId ?? 0);
        $dto->name = $this->name ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "Playlist_Id" => $this->playlistId,
            "Name" => $this->name,
        ];
    }
}