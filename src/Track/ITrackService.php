<?php

declare(strict_types=1);

namespace Chinook\Track;

interface ITrackService
{
    public function insert(TrackModel $model): int;

    public function update(TrackModel $model): int;

    public function get(int $trackId): ?TrackModel;

    public function getAll(): array;

    public function delete(int $trackId): int;

    public function createModel(array $row): ?TrackModel;
}