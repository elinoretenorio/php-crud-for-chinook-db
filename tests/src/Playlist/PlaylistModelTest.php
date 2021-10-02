<?php

declare(strict_types=1);

namespace Chinook\Tests\Playlist;

use PHPUnit\Framework\TestCase;
use Chinook\Playlist\{ PlaylistDto, PlaylistModel };

class PlaylistModelTest extends TestCase
{
    private array $input;
    private PlaylistDto $dto;
    private PlaylistModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "Playlist_Id" => 1200,
            "Name" => "at",
        ];
        $this->dto = new PlaylistDto($this->input);
        $this->model = new PlaylistModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new PlaylistModel(null);

        $this->assertInstanceOf(PlaylistModel::class, $model);
    }

    public function testGetPlaylistId(): void
    {
        $this->assertEquals($this->dto->playlistId, $this->model->getPlaylistId());
    }

    public function testSetPlaylistId(): void
    {
        $expected = 4471;
        $model = $this->model;
        $model->setPlaylistId($expected);

        $this->assertEquals($expected, $model->getPlaylistId());
    }

    public function testGetName(): void
    {
        $this->assertEquals($this->dto->name, $this->model->getName());
    }

    public function testSetName(): void
    {
        $expected = "light";
        $model = $this->model;
        $model->setName($expected);

        $this->assertEquals($expected, $model->getName());
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