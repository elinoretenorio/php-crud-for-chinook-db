<?php

declare(strict_types=1);

namespace Chinook\Playlisttrack;

interface IPlaylisttrackService
{
    public function insert(PlaylisttrackModel $model): int;

    public function update(PlaylisttrackModel $model): int;

    public function get(int $playlistTrackId): ?PlaylisttrackModel;

    public function getAll(): array;

    public function delete(int $playlistTrackId): int;

    public function createModel(array $row): ?PlaylisttrackModel;
}