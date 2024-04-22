<?php

namespace App\Enum;


enum NotifiType: int
{
    case Book = 2;
    case Nothing = 0;
    case Course = 1;
    case Purchase = 3;

    public function getLabelText(): string
    {
        return match ($this) {
            self::Book   => 'Book',
            self::Nothing   => 'Nothing',
            self::Course     => 'Course',
            self::Purchase => 'Purchase',
        };
    }
    public function getLabelColor(): string
    {
        return match ($this) {
            self::Book       => 'badge-light-success',
            self::Nothing    => 'badge-light-warning',
            self::Course     => 'badge-light-danger',
            self::Purchase   => 'badge-light-info',
        };
    }
    public function getLabelHtml(): string
    { 
        return sprintf('<span class="badge badge-glow %s">%s</span>', $this->getLabelColor(), $this->getLabelText());
    }

}
