<?php

declare(strict_types=1);

namespace Chinook\Album;

class AlbumService implements IAlbumService
{
    private IAlbumRepository $repository;

    public function __construct(IAlbumRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(AlbumModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(AlbumModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $albumId): ?AlbumModel
    {
        $dto = $this->repository->get($albumId);
        if ($dto === null) {
            return null;
        }

        return new AlbumModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var AlbumDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new AlbumModel($dto);
        }

        return $result;
    }

    public function delete(int $albumId): int
    {
        return $this->repository->delete($albumId);
    }

    public function createModel(array $row): ?AlbumModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new AlbumDto($row);

        return new AlbumModel($dto);
    }
}