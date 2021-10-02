<?php

declare(strict_types=1);

namespace Chinook\Playlisttrack;

class PlaylisttrackDto 
{
    public int $playlistTrackId;
    public int $playlistId;
    public int $trackId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->playlistTrackId = (int) ($row["Playlist_Track_Id"] ?? 0);
        $this->playlistId = (int) ($row["Playlist_Id"] ?? 0);
        $this->trackId = (int) ($row["Track_Id"] ?? 0);
    }
}