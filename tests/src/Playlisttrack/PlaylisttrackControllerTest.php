<?php

declare(strict_types=1);

namespace Chinook\Tests\Playlisttrack;

use PHPUnit\Framework\TestCase;
use Chinook\Playlisttrack\{ PlaylisttrackDto, PlaylisttrackModel, PlaylisttrackController };

class PlaylisttrackControllerTest extends TestCase
{
    private array $input;
    private PlaylisttrackDto $dto;
    private PlaylisttrackModel $model;
    private $service;
    private $request;
    private $stream;
    private PlaylisttrackController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "Playlist_Track_Id" => 2142,
            "Playlist_Id" => 9379,
            "Track_Id" => 785,
        ];
        $this->dto = new PlaylisttrackDto($this->input);
        $this->model = new PlaylisttrackModel($this->dto);
        $this->service = $this->createMock("Chinook\Playlisttrack\IPlaylisttrackService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new PlaylisttrackController(
            $this->service
        );

        $this->stream->method("getContents")
            ->willReturn("[]");

        $this->request->method("getBody")
            ->willReturn($this->stream);

        $this->request->method("getParsedBody")
            ->willReturn($this->input);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
        unset($this->service);
        unset($this->request);
        unset($this->stream);
        unset($this->controller);
    }

    public function testInsert_ReturnsResponse(): void
    {
        $id = 9351;
        $expected = ["result" => $id];
        $args = [];

        $this->service->expects($this->once())
            ->method("createModel")
            ->with($this->request->getParsedBody())
            ->willReturn($this->model);
        $this->service->expects($this->once())
            ->method("insert")
            ->with($this->model)
            ->willReturn($id);

        $actual = $this->controller->insert($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["Playlist_Track_Id" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 59;
        $expected = ["result" => $id];
        $args = ["Playlist_Track_Id" => 760];

        $this->service->expects($this->once())
            ->method("createModel")
            ->with($this->request->getParsedBody())
            ->willReturn($this->model);
        $this->service->expects($this->once())
            ->method("update")
            ->with($this->model)
            ->willReturn($id);

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["Playlist_Track_Id" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["Playlist_Track_Id" => 7586];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["Playlist_Track_Id"])
            ->willReturn($this->model);

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGetAll_ReturnsResponse(): void
    {
        $expected = ["result" => [$this->model->jsonSerialize()]];
        $args = [];

        $this->service->expects($this->once())
            ->method("getAll")
            ->willReturn([$this->model]);

        $actual = $this->controller->getAll($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["Playlist_Track_Id" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 8686;
        $expected = ["result" => $id];
        $args = ["Playlist_Track_Id" => 8059];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["Playlist_Track_Id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}