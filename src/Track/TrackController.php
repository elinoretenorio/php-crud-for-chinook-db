<?php

declare(strict_types=1);

namespace Chinook\Track;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class TrackController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private ITrackService $service;

    public function __construct(ITrackService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var TrackModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $trackId = (int) ($args["Track_Id"] ?? 0);
        if ($trackId <= 0) {
            return new JsonResponse(["result" => $trackId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var TrackModel $model */
        $model = $this->service->createModel($data);
        $model->setTrackId($trackId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $trackId = (int) ($args["Track_Id"] ?? 0);
        if ($trackId <= 0) {
            return new JsonResponse(["result" => $trackId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var TrackModel $model */
        $model = $this->service->get($trackId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var TrackModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $trackId = (int) ($args["Track_Id"] ?? 0);
        if ($trackId <= 0) {
            return new JsonResponse(["result" => $trackId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($trackId);

        return new JsonResponse(["result" => $result]);
    }
}