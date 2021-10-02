<?php

declare(strict_types=1);

namespace Chinook\Playlisttrack;

interface IPlaylisttrackRepository
{
    public function insert(PlaylisttrackDto $dto): int;

    public function update(PlaylisttrackDto $dto): int;

    public function get(int $playlistTrackId): ?PlaylisttrackDto;

    public function getAll(): array;

    public function delete(int $playlistTrackId): int;
}