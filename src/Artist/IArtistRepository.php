<?php

declare(strict_types=1);

namespace Chinook\Artist;

interface IArtistRepository
{
    public function insert(ArtistDto $dto): int;

    public function update(ArtistDto $dto): int;

    public function get(int $artistId): ?ArtistDto;

    public function getAll(): array;

    public function delete(int $artistId): int;
}