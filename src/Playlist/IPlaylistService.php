<?php

declare(strict_types=1);

namespace Chinook\Playlist;

interface IPlaylistService
{
    public function insert(PlaylistModel $model): int;

    public function update(PlaylistModel $model): int;

    public function get(int $playlistId): ?PlaylistModel;

    public function getAll(): array;

    public function delete(int $playlistId): int;

    public function createModel(array $row): ?PlaylistModel;
}