<?php

declare(strict_types=1);

namespace Chinook\Track;

interface ITrackRepository
{
    public function insert(TrackDto $dto): int;

    public function update(TrackDto $dto): int;

    public function get(int $trackId): ?TrackDto;

    public function getAll(): array;

    public function delete(int $trackId): int;
}