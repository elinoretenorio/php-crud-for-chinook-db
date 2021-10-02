<?php

declare(strict_types=1);

namespace Chinook\Album;

use JsonSerializable;

class AlbumModel implements JsonSerializable
{
    private int $albumId;
    private string $title;
    private int $artistId;

    public function __construct(AlbumDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->albumId = $dto->albumId;
        $this->title = $dto->title;
        $this->artistId = $dto->artistId;
    }

    public function getAlbumId(): int
    {
        return $this->albumId;
    }

    public function setAlbumId(int $albumId): void
    {
        $this->albumId = $albumId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getArtistId(): int
    {
        return $this->artistId;
    }

    public function setArtistId(int $artistId): void
    {
        $this->artistId = $artistId;
    }

    public function toDto(): AlbumDto
    {
        $dto = new AlbumDto();
        $dto->albumId = (int) ($this->albumId ?? 0);
        $dto->title = $this->title ?? "";
        $dto->artistId = (int) ($this->artistId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "Album_Id" => $this->albumId,
            "Title" => $this->title,
            "Artist_Id" => $this->artistId,
        ];
    }
}