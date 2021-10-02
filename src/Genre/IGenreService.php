<?php

declare(strict_types=1);

namespace Chinook\Genre;

interface IGenreService
{
    public function insert(GenreModel $model): int;

    public function update(GenreModel $model): int;

    public function get(int $genreId): ?GenreModel;

    public function getAll(): array;

    public function delete(int $genreId): int;

    public function createModel(array $row): ?GenreModel;
}