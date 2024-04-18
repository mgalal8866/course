<?php

namespace App\Enum;


enum PaymentType: int
{
    case Online = 2;
    case Offline = 1;
    // public function isEXPIRE(): bool
    // {
    //     return $this === static::EXPIRE;
    // }
    // public function isSuccess(): bool
    // {
    //     return $this === static::Success;
    // }
    // public function isPending(): bool
    // {
    //     return $this === static::Pending;
    // }
    public function getLabelText(): string
    {
        return match ($this) {
            self::Online  => 'Online',
            self::Offline  => 'Offline',
        };
    }
    public function getLabelColor(): string
    {
        return match ($this) {
            self::Online => 'bg-success',
            self::Offline => 'bg-danger',
        };
    }
    public function getLabelHtml(): string
    {
        return sprintf('<span class="badge badge-glow %s">%s</span>', $this->getLabelColor(), $this->getLabelText());
    }

}
