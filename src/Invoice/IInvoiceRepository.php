<?php

declare(strict_types=1);

namespace Chinook\Invoice;

interface IInvoiceRepository
{
    public function insert(InvoiceDto $dto): int;

    public function update(InvoiceDto $dto): int;

    public function get(int $invoiceId): ?InvoiceDto;

    public function getAll(): array;

    public function delete(int $invoiceId): int;
}