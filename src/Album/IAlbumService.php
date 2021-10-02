<?php

declare(strict_types=1);

namespace Chinook\Album;

interface IAlbumService
{
    public function insert(AlbumModel $model): int;

    public function update(AlbumModel $model): int;

    public function get(int $albumId): ?AlbumModel;

    public function getAll(): array;

    public function delete(int $albumId): int;

    public function createModel(array $row): ?AlbumModel;
}