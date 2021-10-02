<?php

declare(strict_types=1);

namespace Chinook\Genre;

class GenreDto 
{
    public int $genreId;
    public string $name;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->genreId = (int) ($row["Genre_Id"] ?? 0);
        $this->name = $row["Name"] ?? "";
    }
}