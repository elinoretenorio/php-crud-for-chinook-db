<?php

declare(strict_types=1);

namespace Chinook\Album;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class AlbumController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IAlbumService $service;

    public function __construct(IAlbumService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var AlbumModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $albumId = (int) ($args["Album_Id"] ?? 0);
        if ($albumId <= 0) {
            return new JsonResponse(["result" => $albumId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var AlbumModel $model */
        $model = $this->service->createModel($data);
        $model->setAlbumId($albumId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $albumId = (int) ($args["Album_Id"] ?? 0);
        if ($albumId <= 0) {
            return new JsonResponse(["result" => $albumId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var AlbumModel $model */
        $model = $this->service->get($albumId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var AlbumModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $albumId = (int) ($args["Album_Id"] ?? 0);
        if ($albumId <= 0) {
            return new JsonResponse(["result" => $albumId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($albumId);

        return new JsonResponse(["result" => $result]);
    }
}