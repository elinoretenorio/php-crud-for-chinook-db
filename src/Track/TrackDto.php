<?php

declare(strict_types=1);

namespace Chinook\Track;

class TrackDto 
{
    public int $trackId;
    public string $name;
    public int $albumId;
    public int $mediaTypeId;
    public int $genreId;
    public string $composer;
    public int $milliseconds;
    public int $bytes;
    public float $unitPrice;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->trackId = (int) ($row["Track_Id"] ?? 0);
        $this->name = $row["Name"] ?? "";
        $this->albumId = (int) ($row["Album_Id"] ?? 0);
        $this->mediaTypeId = (int) ($row["Media_Type_Id"] ?? 0);
        $this->genreId = (int) ($row["Genre_Id"] ?? 0);
        $this->composer = $row["Composer"] ?? "";
        $this->milliseconds = (int) ($row["Milliseconds"] ?? 0);
        $this->bytes = (int) ($row["Bytes"] ?? 0);
        $this->unitPrice = (float) ($row["Unit_Price"] ?? 0);
    }
}