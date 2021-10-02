<?php

declare(strict_types=1);

namespace Chinook\Invoice;

class InvoiceService implements IInvoiceService
{
    private IInvoiceRepository $repository;

    public function __construct(IInvoiceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(InvoiceModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(InvoiceModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $invoiceId): ?InvoiceModel
    {
        $dto = $this->repository->get($invoiceId);
        if ($dto === null) {
            return null;
        }

        return new InvoiceModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var InvoiceDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new InvoiceModel($dto);
        }

        return $result;
    }

    public function delete(int $invoiceId): int
    {
        return $this->repository->delete($invoiceId);
    }

    public function createModel(array $row): ?InvoiceModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new InvoiceDto($row);

        return new InvoiceModel($dto);
    }
}