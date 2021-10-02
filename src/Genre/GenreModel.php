<?php

declare(strict_types=1);

namespace Chinook\Genre;

use JsonSerializable;

class GenreModel implements JsonSerializable
{
    private int $genreId;
    private string $name;

    public function __construct(GenreDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->genreId = $dto->genreId;
        $this->name = $dto->name;
    }

    public function getGenreId(): int
    {
        return $this->genreId;
    }

    public function setGenreId(int $genreId): void
    {
        $this->genreId = $genreId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function toDto(): GenreDto
    {
        $dto = new GenreDto();
        $dto->genreId = (int) ($this->genreId ?? 0);
        $dto->name = $this->name ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "Genre_Id" => $this->genreId,
            "Name" => $this->name,
        ];
    }
}