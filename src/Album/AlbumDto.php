<?php

declare(strict_types=1);

namespace Chinook\Album;

class AlbumDto 
{
    public int $albumId;
    public string $title;
    public int $artistId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->albumId = (int) ($row["Album_Id"] ?? 0);
        $this->title = $row["Title"] ?? "";
        $this->artistId = (int) ($row["Artist_Id"] ?? 0);
    }
}