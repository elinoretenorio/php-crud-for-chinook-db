<?php

declare(strict_types=1);

namespace Chinook\Playlist;

class PlaylistService implements IPlaylistService
{
    private IPlaylistRepository $repository;

    public function __construct(IPlaylistRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(PlaylistModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(PlaylistModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $playlistId): ?PlaylistModel
    {
        $dto = $this->repository->get($playlistId);
        if ($dto === null) {
            return null;
        }

        return new PlaylistModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var PlaylistDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new PlaylistModel($dto);
        }

        return $result;
    }

    public function delete(int $playlistId): int
    {
        return $this->repository->delete($playlistId);
    }

    public function createModel(array $row): ?PlaylistModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new PlaylistDto($row);

        return new PlaylistModel($dto);
    }
}