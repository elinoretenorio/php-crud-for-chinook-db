<?php

declare(strict_types=1);

namespace Chinook\Tests\Mediatype;

use PHPUnit\Framework\TestCase;
use Chinook\Mediatype\{ MediatypeDto, MediatypeModel };

class MediatypeModelTest extends TestCase
{
    private array $input;
    private MediatypeDto $dto;
    private MediatypeModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "Media_Type_Id" => 1420,
            "Name" => "beyond",
        ];
        $this->dto = new MediatypeDto($this->input);
        $this->model = new MediatypeModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new MediatypeModel(null);

        $this->assertInstanceOf(MediatypeModel::class, $model);
    }

    public function testGetMediaTypeId(): void
    {
        $this->assertEquals($this->dto->mediaTypeId, $this->model->getMediaTypeId());
    }

    public function testSetMediaTypeId(): void
    {
        $expected = 2442;
        $model = $this->model;
        $model->setMediaTypeId($expected);

        $this->assertEquals($expected, $model->getMediaTypeId());
    }

    public function testGetName(): void
    {
        $this->assertEquals($this->dto->name, $this->model->getName());
    }

    public function testSetName(): void
    {
        $expected = "allow";
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