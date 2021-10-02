<?php

declare(strict_types=1);

namespace Chinook\Album;

interface IAlbumRepository
{
    public function insert(AlbumDto $dto): int;

    public function update(AlbumDto $dto): int;

    public function get(int $albumId): ?AlbumDto;

    public function getAll(): array;

    public function delete(int $albumId): int;
}