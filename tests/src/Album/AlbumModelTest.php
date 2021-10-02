<?php

declare(strict_types=1);

namespace Chinook\Tests\Album;

use PHPUnit\Framework\TestCase;
use Chinook\Album\{ AlbumDto, AlbumModel };

class AlbumModelTest extends TestCase
{
    private array $input;
    private AlbumDto $dto;
    private AlbumModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "Album_Id" => 8099,
            "Title" => "society",
            "Artist_Id" => 7998,
        ];
        $this->dto = new AlbumDto($this->input);
        $this->model = new AlbumModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new AlbumModel(null);

        $this->assertInstanceOf(AlbumModel::class, $model);
    }

    public function testGetAlbumId(): void
    {
        $this->assertEquals($this->dto->albumId, $this->model->getAlbumId());
    }

    public function testSetAlbumId(): void
    {
        $expected = 9217;
        $model = $this->model;
        $model->setAlbumId($expected);

        $this->assertEquals($expected, $model->getAlbumId());
    }

    public function testGetTitle(): void
    {
        $this->assertEquals($this->dto->title, $this->model->getTitle());
    }

    public function testSetTitle(): void
    {
        $expected = "the";
        $model = $this->model;
        $model->setTitle($expected);

        $this->assertEquals($expected, $model->getTitle());
    }

    public function testGetArtistId(): void
    {
        $this->assertEquals($this->dto->artistId, $this->model->getArtistId());
    }

    public function testSetArtistId(): void
    {
        $expected = 9569;
        $model = $this->model;
        $model->setArtistId($expected);

        $this->assertEquals($expected, $model->getArtistId());
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