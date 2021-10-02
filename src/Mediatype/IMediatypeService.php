<?php

declare(strict_types=1);

namespace Chinook\Mediatype;

interface IMediatypeService
{
    public function insert(MediatypeModel $model): int;

    public function update(MediatypeModel $model): int;

    public function get(int $mediaTypeId): ?MediatypeModel;

    public function getAll(): array;

    public function delete(int $mediaTypeId): int;

    public function createModel(array $row): ?MediatypeModel;
}