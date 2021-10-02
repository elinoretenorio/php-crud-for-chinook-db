<?php

declare(strict_types=1);

namespace Chinook\Invoiceline;

class InvoicelineService implements IInvoicelineService
{
    private IInvoicelineRepository $repository;

    public function __construct(IInvoicelineRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(InvoicelineModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(InvoicelineModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $invoiceLineId): ?InvoicelineModel
    {
        $dto = $this->repository->get($invoiceLineId);
        if ($dto === null) {
            return null;
        }

        return new InvoicelineModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var InvoicelineDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new InvoicelineModel($dto);
        }

        return $result;
    }

    public function delete(int $invoiceLineId): int
    {
        return $this->repository->delete($invoiceLineId);
    }

    public function createModel(array $row): ?InvoicelineModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new InvoicelineDto($row);

        return new InvoicelineModel($dto);
    }
}