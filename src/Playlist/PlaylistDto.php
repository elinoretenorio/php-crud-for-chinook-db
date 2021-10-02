<?php

declare(strict_types=1);

namespace Chinook\Playlist;

class PlaylistDto 
{
    public int $playlistId;
    public string $name;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->playlistId = (int) ($row["Playlist_Id"] ?? 0);
        $this->name = $row["Name"] ?? "";
    }
}