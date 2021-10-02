<?php

declare(strict_types=1);

namespace Chinook\Artist;

use JsonSerializable;

class ArtistModel implements JsonSerializable
{
    private int $artistId;
    private string $name;

    public function __construct(ArtistDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->artistId = $dto->artistId;
        $this->name = $dto->name;
    }

    public function getArtistId(): int
    {
        return $this->artistId;
    }

    public function setArtistId(int $artistId): void
    {
        $this->artistId = $artistId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function toDto(): ArtistDto
    {
        $dto = new ArtistDto();
        $dto->artistId = (int) ($this->artistId ?? 0);
        $dto->name = $this->name ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "Artist_Id" => $this->artistId,
            "Name" => $this->name,
        ];
    }
}