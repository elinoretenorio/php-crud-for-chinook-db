<?php

declare(strict_types=1);

namespace Chinook\Mediatype;

class MediatypeDto 
{
    public int $mediaTypeId;
    public string $name;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->mediaTypeId = (int) ($row["Media_Type_Id"] ?? 0);
        $this->name = $row["Name"] ?? "";
    }
}