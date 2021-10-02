<?php

declare(strict_types=1);

namespace Chinook\Invoiceline;

interface IInvoicelineRepository
{
    public function insert(InvoicelineDto $dto): int;

    public function update(InvoicelineDto $dto): int;

    public function get(int $invoiceLineId): ?InvoicelineDto;

    public function getAll(): array;

    public function delete(int $invoiceLineId): int;
}