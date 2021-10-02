<?php

declare(strict_types=1);

namespace Chinook\Tests\Playlisttrack;

use PHPUnit\Framework\TestCase;
use Chinook\Playlisttrack\{ PlaylisttrackDto, PlaylisttrackModel };

class PlaylisttrackModelTest extends TestCase
{
    private array $input;
    private PlaylisttrackDto $dto;
    private PlaylisttrackModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "Playlist_Track_Id" => 8197,
            "Playlist_Id" => 1742,
            "Track_Id" => 1452,
        ];
        $this->dto = new PlaylisttrackDto($this->input);
        $this->model = new PlaylisttrackModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new PlaylisttrackModel(null);

        $this->assertInstanceOf(PlaylisttrackModel::class, $model);
    }

    public function testGetPlaylistTrackId(): void
    {
        $this->assertEquals($this->dto->playlistTrackId, $this->model->getPlaylistTrackId());
    }

    public function testSetPlaylistTrackId(): void
    {
        $expected = 2043;
        $model = $this->model;
        $model->setPlaylistTrackId($expected);

        $this->assertEquals($expected, $model->getPlaylistTrackId());
    }

    public function testGetPlaylistId(): void
    {
        $this->assertEquals($this->dto->playlistId, $this->model->getPlaylistId());
    }

    public function testSetPlaylistId(): void
    {
        $expected = 3452;
        $model = $this->model;
        $model->setPlaylistId($expected);

        $this->assertEquals($expected, $model->getPlaylistId());
    }

    public function testGetTrackId(): void
    {
        $this->assertEquals($this->dto->trackId, $this->model->getTrackId());
    }

    public function testSetTrackId(): void
    {
        $expected = 2802;
        $model = $this->model;
        $model->setTrackId($expected);

        $this->assertEquals($expected, $model->getTrackId());
    }

    public function testToDto(): void
    {
        $this->assertEquals($this->dto, $this->model->toDto());
    }

    public function testJsonSerialize(): void
    {
        $this->assertEquals($this->input, $this->model->jsonSerialize());
    }
}