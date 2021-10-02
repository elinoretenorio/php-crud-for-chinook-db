<?php

declare(strict_types=1);

namespace Chinook\Artist;

class ArtistDto 
{
    public int $artistId;
    public string $name;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->artistId = (int) ($row["Artist_Id"] ?? 0);
        $this->name = $row["Name"] ?? "";
    }
}