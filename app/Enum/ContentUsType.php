<?php

namespace App\Enum;


enum ContentUsType: int
{
    case Success = 1;
    case Pending = 2;

    public function getLabelText(): string
    {
        return match ($this) {
            self::Pending   => 'Pending',
            self::Success   => 'Success',

        };
    }
    public function getLabelColor(): string
    {
        return match ($this) {
            self::Success    => 'bg-success',
            self::Pending    => 'bg-warning',

        };
    }
    public function getLabelHtml(): string
    {
        return sprintf('<span class="badge badge-glow %s">%s</span>', $this->getLabelColor(), $this->getLabelText());
    }
}
