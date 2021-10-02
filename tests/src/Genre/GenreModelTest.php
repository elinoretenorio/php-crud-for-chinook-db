<?php

declare(strict_types=1);

namespace Chinook\Tests\Genre;

use PHPUnit\Framework\TestCase;
use Chinook\Genre\{ GenreDto, GenreModel };

class GenreModelTest extends TestCase
{
    private array $input;
    private GenreDto $dto;
    private GenreModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "Genre_Id" => 6452,
            "Name" => "cup",
        ];
        $this->dto = new GenreDto($this->input);
        $this->model = new GenreModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new GenreModel(null);

        $this->assertInstanceOf(GenreModel::class, $model);
    }

    public function testGetGenreId(): void
    {
        $this->assertEquals($this->dto->genreId, $this->model->getGenreId());
    }

    public function testSetGenreId(): void
    {
        $expected = 2726;
        $model = $this->model;
        $model->setGenreId($expected);

        $this->assertEquals($expected, $model->getGenreId());
    }

    public function testGetName(): void
    {
        $this->assertEquals($this->dto->name, $this->model->getName());
    }

    public function testSetName(): void
    {
        $expected = "method";
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