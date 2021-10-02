<?php

declare(strict_types=1);

namespace Chinook\Tests\Artist;

use PHPUnit\Framework\TestCase;
use Chinook\Artist\{ ArtistDto, ArtistModel };

class ArtistModelTest extends TestCase
{
    private array $input;
    private ArtistDto $dto;
    private ArtistModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "Artist_Id" => 9192,
            "Name" => "but",
        ];
        $this->dto = new ArtistDto($this->input);
        $this->model = new ArtistModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new ArtistModel(null);

        $this->assertInstanceOf(ArtistModel::class, $model);
    }

    public function testGetArtistId(): void
    {
        $this->assertEquals($this->dto->artistId, $this->model->getArtistId());
    }

    public function testSetArtistId(): void
    {
        $expected = 166;
        $model = $this->model;
        $model->setArtistId($expected);

        $this->assertEquals($expected, $model->getArtistId());
    }

    public function testGetName(): void
    {
        $this->assertEquals($this->dto->name, $this->model->getName());
    }

    public function testSetName(): void
    {
        $expected = "operation";
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