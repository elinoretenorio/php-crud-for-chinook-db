<?php

declare(strict_types=1);

namespace Chinook\Mediatype;

interface IMediatypeRepository
{
    public function insert(MediatypeDto $dto): int;

    public function update(MediatypeDto $dto): int;

    public function get(int $mediaTypeId): ?MediatypeDto;

    public function getAll(): array;

    public function delete(int $mediaTypeId): int;
}