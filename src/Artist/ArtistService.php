<?php

declare(strict_types=1);

namespace Chinook\Artist;

class ArtistService implements IArtistService
{
    private IArtistRepository $repository;

    public function __construct(IArtistRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(ArtistModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(ArtistModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $artistId): ?ArtistModel
    {
        $dto = $this->repository->get($artistId);
        if ($dto === null) {
            return null;
        }

        return new ArtistModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var ArtistDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new ArtistModel($dto);
        }

        return $result;
    }

    public function delete(int $artistId): int
    {
        return $this->repository->delete($artistId);
    }

    public function createModel(array $row): ?ArtistModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new ArtistDto($row);

        return new ArtistModel($dto);
    }
}