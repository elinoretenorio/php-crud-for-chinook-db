<?php

declare(strict_types=1);

namespace Chinook\Artist;

interface IArtistService
{
    public function insert(ArtistModel $model): int;

    public function update(ArtistModel $model): int;

    public function get(int $artistId): ?ArtistModel;

    public function getAll(): array;

    public function delete(int $artistId): int;

    public function createModel(array $row): ?ArtistModel;
}