<?php

declare(strict_types=1);

namespace Chinook\Invoice;

interface IInvoiceService
{
    public function insert(InvoiceModel $model): int;

    public function update(InvoiceModel $model): int;

    public function get(int $invoiceId): ?InvoiceModel;

    public function getAll(): array;

    public function delete(int $invoiceId): int;

    public function createModel(array $row): ?InvoiceModel;
}