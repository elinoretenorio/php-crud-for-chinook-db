<?php

declare(strict_types=1);

namespace Chinook\Mediatype;

class MediatypeService implements IMediatypeService
{
    private IMediatypeRepository $repository;

    public function __construct(IMediatypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(MediatypeModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(MediatypeModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $mediaTypeId): ?MediatypeModel
    {
        $dto = $this->repository->get($mediaTypeId);
        if ($dto === null) {
            return null;
        }

        return new MediatypeModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var MediatypeDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new MediatypeModel($dto);
        }

        return $result;
    }

    public function delete(int $mediaTypeId): int
    {
        return $this->repository->delete($mediaTypeId);
    }

    public function createModel(array $row): ?MediatypeModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new MediatypeDto($row);

        return new MediatypeModel($dto);
    }
}