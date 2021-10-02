<?php

declare(strict_types=1);

namespace Chinook\Mediatype;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class MediatypeController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IMediatypeService $service;

    public function __construct(IMediatypeService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var MediatypeModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $mediaTypeId = (int) ($args["Media_Type_Id"] ?? 0);
        if ($mediaTypeId <= 0) {
            return new JsonResponse(["result" => $mediaTypeId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var MediatypeModel $model */
        $model = $this->service->createModel($data);
        $model->setMediaTypeId($mediaTypeId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $mediaTypeId = (int) ($args["Media_Type_Id"] ?? 0);
        if ($mediaTypeId <= 0) {
            return new JsonResponse(["result" => $mediaTypeId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var MediatypeModel $model */
        $model = $this->service->get($mediaTypeId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var MediatypeModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $mediaTypeId = (int) ($args["Media_Type_Id"] ?? 0);
        if ($mediaTypeId <= 0) {
            return new JsonResponse(["result" => $mediaTypeId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($mediaTypeId);

        return new JsonResponse(["result" => $result]);
    }
}