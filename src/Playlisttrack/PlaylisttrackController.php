<?php

declare(strict_types=1);

namespace Chinook\Playlisttrack;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class PlaylisttrackController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IPlaylisttrackService $service;

    public function __construct(IPlaylisttrackService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var PlaylisttrackModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $playlistTrackId = (int) ($args["Playlist_Track_Id"] ?? 0);
        if ($playlistTrackId <= 0) {
            return new JsonResponse(["result" => $playlistTrackId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var PlaylisttrackModel $model */
        $model = $this->service->createModel($data);
        $model->setPlaylistTrackId($playlistTrackId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $playlistTrackId = (int) ($args["Playlist_Track_Id"] ?? 0);
        if ($playlistTrackId <= 0) {
            return new JsonResponse(["result" => $playlistTrackId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var PlaylisttrackModel $model */
        $model = $this->service->get($playlistTrackId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var PlaylisttrackModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $playlistTrackId = (int) ($args["Playlist_Track_Id"] ?? 0);
        if ($playlistTrackId <= 0) {
            return new JsonResponse(["result" => $playlistTrackId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($playlistTrackId);

        return new JsonResponse(["result" => $result]);
    }
}