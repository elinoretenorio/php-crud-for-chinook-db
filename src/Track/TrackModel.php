<?php

declare(strict_types=1);

namespace Chinook\Track;

use JsonSerializable;

class TrackModel implements JsonSerializable
{
    private int $trackId;
    private string $name;
    private int $albumId;
    private int $mediaTypeId;
    private int $genreId;
    private string $composer;
    private int $milliseconds;
    private int $bytes;
    private float $unitPrice;

    public function __construct(TrackDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->trackId = $dto->trackId;
        $this->name = $dto->name;
        $this->albumId = $dto->albumId;
        $this->mediaTypeId = $dto->mediaTypeId;
        $this->genreId = $dto->genreId;
        $this->composer = $dto->composer;
        $this->milliseconds = $dto->milliseconds;
        $this->bytes = $dto->bytes;
        $this->unitPrice = $dto->unitPrice;
    }

    public function getTrackId(): int
    {
        return $this->trackId;
    }

    public function setTrackId(int $trackId): void
    {
        $this->trackId = $trackId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAlbumId(): int
    {
        return $this->albumId;
    }

    public function setAlbumId(int $albumId): void
    {
        $this->albumId = $albumId;
    }

    public function getMediaTypeId(): int
    {
        return $this->mediaTypeId;
    }

    public function setMediaTypeId(int $mediaTypeId): void
    {
        $this->mediaTypeId = $mediaTypeId;
    }

    public function getGenreId(): int
    {
        return $this->genreId;
    }

    public function setGenreId(int $genreId): void
    {
        $this->genreId = $genreId;
    }

    public function getComposer(): string
    {
        return $this->composer;
    }

    public function setComposer(string $composer): void
    {
        $this->composer = $composer;
    }

    public function getMilliseconds(): int
    {
        return $this->milliseconds;
    }

    public function setMilliseconds(int $milliseconds): void
    {
        $this->milliseconds = $milliseconds;
    }

    public function getBytes(): int
    {
        return $this->bytes;
    }

    public function setBytes(int $bytes): void
    {
        $this->bytes = $bytes;
    }

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(float $unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }

    public function toDto(): TrackDto
    {
        $dto = new TrackDto();
        $dto->trackId = (int) ($this->trackId ?? 0);
        $dto->name = $this->name ?? "";
        $dto->albumId = (int) ($this->albumId ?? 0);
        $dto->mediaTypeId = (int) ($this->mediaTypeId ?? 0);
        $dto->genreId = (int) ($this->genreId ?? 0);
        $dto->composer = $this->composer ?? "";
        $dto->milliseconds = (int) ($this->milliseconds ?? 0);
        $dto->bytes = (int) ($this->bytes ?? 0);
        $dto->unitPrice = (float) ($this->unitPrice ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "Track_Id" => $this->trackId,
            "Name" => $this->name,
            "Album_Id" => $this->albumId,
            "Media_Type_Id" => $this->mediaTypeId,
            "Genre_Id" => $this->genreId,
            "Composer" => $this->composer,
            "Milliseconds" => $this->milliseconds,
            "Bytes" => $this->bytes,
            "Unit_Price" => $this->unitPrice,
        ];
    }
}