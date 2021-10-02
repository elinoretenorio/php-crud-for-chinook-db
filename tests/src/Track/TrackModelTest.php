<?php

declare(strict_types=1);

namespace Chinook\Tests\Track;

use PHPUnit\Framework\TestCase;
use Chinook\Track\{ TrackDto, TrackModel };

class TrackModelTest extends TestCase
{
    private array $input;
    private TrackDto $dto;
    private TrackModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "Track_Id" => 4425,
            "Name" => "former",
            "Album_Id" => 1667,
            "Media_Type_Id" => 9369,
            "Genre_Id" => 3846,
            "Composer" => "game",
            "Milliseconds" => 4744,
            "Bytes" => 3055,
            "Unit_Price" => 722.49,
        ];
        $this->dto = new TrackDto($this->input);
        $this->model = new TrackModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new TrackModel(null);

        $this->assertInstanceOf(TrackModel::class, $model);
    }

    public function testGetTrackId(): void
    {
        $this->assertEquals($this->dto->trackId, $this->model->getTrackId());
    }

    public function testSetTrackId(): void
    {
        $expected = 231;
        $model = $this->model;
        $model->setTrackId($expected);

        $this->assertEquals($expected, $model->getTrackId());
    }

    public function testGetName(): void
    {
        $this->assertEquals($this->dto->name, $this->model->getName());
    }

    public function testSetName(): void
    {
        $expected = "popular";
        $model = $this->model;
        $model->setName($expected);

        $this->assertEquals($expected, $model->getName());
    }

    public function testGetAlbumId(): void
    {
        $this->assertEquals($this->dto->albumId, $this->model->getAlbumId());
    }

    public function testSetAlbumId(): void
    {
        $expected = 5436;
        $model = $this->model;
        $model->setAlbumId($expected);

        $this->assertEquals($expected, $model->getAlbumId());
    }

    public function testGetMediaTypeId(): void
    {
        $this->assertEquals($this->dto->mediaTypeId, $this->model->getMediaTypeId());
    }

    public function testSetMediaTypeId(): void
    {
        $expected = 1794;
        $model = $this->model;
        $model->setMediaTypeId($expected);

        $this->assertEquals($expected, $model->getMediaTypeId());
    }

    public function testGetGenreId(): void
    {
        $this->assertEquals($this->dto->genreId, $this->model->getGenreId());
    }

    public function testSetGenreId(): void
    {
        $expected = 7296;
        $model = $this->model;
        $model->setGenreId($expected);

        $this->assertEquals($expected, $model->getGenreId());
    }

    public function testGetComposer(): void
    {
        $this->assertEquals($this->dto->composer, $this->model->getComposer());
    }

    public function testSetComposer(): void
    {
        $expected = "crime";
        $model = $this->model;
        $model->setComposer($expected);

        $this->assertEquals($expected, $model->getComposer());
    }

    public function testGetMilliseconds(): void
    {
        $this->assertEquals($this->dto->milliseconds, $this->model->getMilliseconds());
    }

    public function testSetMilliseconds(): void
    {
        $expected = 5404;
        $model = $this->model;
        $model->setMilliseconds($expected);

        $this->assertEquals($expected, $model->getMilliseconds());
    }

    public function testGetBytes(): void
    {
        $this->assertEquals($this->dto->bytes, $this->model->getBytes());
    }

    public function testSetBytes(): void
    {
        $expected = 7707;
        $model = $this->model;
        $model->setBytes($expected);

        $this->assertEquals($expected, $model->getBytes());
    }

    public function testGetUnitPrice(): void
    {
        $this->assertEquals($this->dto->unitPrice, $this->model->getUnitPrice());
    }

    public function testSetUnitPrice(): void
    {
        $expected = 890.40;
        $model = $this->model;
        $model->setUnitPrice($expected);

        $this->assertEquals($expected, $model->getUnitPrice());
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