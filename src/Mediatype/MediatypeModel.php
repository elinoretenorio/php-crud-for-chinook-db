<?php

declare(strict_types=1);

namespace Chinook\Mediatype;

use JsonSerializable;

class MediatypeModel implements JsonSerializable
{
    private int $mediaTypeId;
    private string $name;

    public function __construct(MediatypeDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->mediaTypeId = $dto->mediaTypeId;
        $this->name = $dto->name;
    }

    public function getMediaTypeId(): int
    {
        return $this->mediaTypeId;
    }

    public function setMediaTypeId(int $mediaTypeId): void
    {
        $this->mediaTypeId = $mediaTypeId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function toDto(): MediatypeDto
    {
        $dto = new MediatypeDto();
        $dto->mediaTypeId = (int) ($this->mediaTypeId ?? 0);
        $dto->name = $this->name ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "Media_Type_Id" => $this->mediaTypeId,
            "Name" => $this->name,
        ];
    }
}