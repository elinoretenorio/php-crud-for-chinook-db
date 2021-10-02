<?php

declare(strict_types=1);

namespace Chinook\Track;

class TrackService implements ITrackService
{
    private ITrackRepository $repository;

    public function __construct(ITrackRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(TrackModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(TrackModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $trackId): ?TrackModel
    {
        $dto = $this->repository->get($trackId);
        if ($dto === null) {
            return null;
        }

        return new TrackModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var TrackDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new TrackModel($dto);
        }

        return $result;
    }

    public function delete(int $trackId): int
    {
        return $this->repository->delete($trackId);
    }

    public function createModel(array $row): ?TrackModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new TrackDto($row);

        return new TrackModel($dto);
    }
}