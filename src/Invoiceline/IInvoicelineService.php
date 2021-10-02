<?php

declare(strict_types=1);

namespace Chinook\Invoiceline;

interface IInvoicelineService
{
    public function insert(InvoicelineModel $model): int;

    public function update(InvoicelineModel $model): int;

    public function get(int $invoiceLineId): ?InvoicelineModel;

    public function getAll(): array;

    public function delete(int $invoiceLineId): int;

    public function createModel(array $row): ?InvoicelineModel;
}