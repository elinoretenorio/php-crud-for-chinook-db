<?php

declare(strict_types=1);

namespace Chinook\Genre;

class GenreService implements IGenreService
{
    private IGenreRepository $repository;

    public function __construct(IGenreRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(GenreModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(GenreModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $genreId): ?GenreModel
    {
        $dto = $this->repository->get($genreId);
        if ($dto === null) {
            return null;
        }

        return new GenreModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var GenreDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new GenreModel($dto);
        }

        return $result;
    }

    public function delete(int $genreId): int
    {
        return $this->repository->delete($genreId);
    }

    public function createModel(array $row): ?GenreModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new GenreDto($row);

        return new GenreModel($dto);
    }
}