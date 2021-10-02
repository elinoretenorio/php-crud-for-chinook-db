<?php

declare(strict_types=1);

namespace Chinook\Playlisttrack;

class PlaylisttrackService implements IPlaylisttrackService
{
    private IPlaylisttrackRepository $repository;

    public function __construct(IPlaylisttrackRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(PlaylisttrackModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(PlaylisttrackModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $playlistTrackId): ?PlaylisttrackModel
    {
        $dto = $this->repository->get($playlistTrackId);
        if ($dto === null) {
            return null;
        }

        return new PlaylisttrackModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var PlaylisttrackDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new PlaylisttrackModel($dto);
        }

        return $result;
    }

    public function delete(int $playlistTrackId): int
    {
        return $this->repository->delete($playlistTrackId);
    }

    public function createModel(array $row): ?PlaylisttrackModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new PlaylisttrackDto($row);

        return new PlaylisttrackModel($dto);
    }
}