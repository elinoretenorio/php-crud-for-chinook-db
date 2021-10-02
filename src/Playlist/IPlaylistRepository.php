<?php

declare(strict_types=1);

namespace Chinook\Playlist;

interface IPlaylistRepository
{
    public function insert(PlaylistDto $dto): int;

    public function update(PlaylistDto $dto): int;

    public function get(int $playlistId): ?PlaylistDto;

    public function getAll(): array;

    public function delete(int $playlistId): int;
}