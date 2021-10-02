<?php

declare(strict_types=1);

namespace Chinook\Invoiceline;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class InvoicelineController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IInvoicelineService $service;

    public function __construct(IInvoicelineService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var InvoicelineModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $invoiceLineId = (int) ($args["Invoice_Line_Id"] ?? 0);
        if ($invoiceLineId <= 0) {
            return new JsonResponse(["result" => $invoiceLineId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var InvoicelineModel $model */
        $model = $this->service->createModel($data);
        $model->setInvoiceLineId($invoiceLineId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $invoiceLineId = (int) ($args["Invoice_Line_Id"] ?? 0);
        if ($invoiceLineId <= 0) {
            return new JsonResponse(["result" => $invoiceLineId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var InvoicelineModel $model */
        $model = $this->service->get($invoiceLineId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var InvoicelineModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $invoiceLineId = (int) ($args["Invoice_Line_Id"] ?? 0);
        if ($invoiceLineId <= 0) {
            return new JsonResponse(["result" => $invoiceLineId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($invoiceLineId);

        return new JsonResponse(["result" => $result]);
    }
}