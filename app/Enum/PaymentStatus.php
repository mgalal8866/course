<?php

namespace App\Enum;


enum PaymentStatus: int
{
    case Success = 1;
    case Pending = 2;
    case EXPIRE = 3;
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
            self::Pending  => 'Pending',
            self::Success  => 'Success',
            self::EXPIRE   => 'Expire',
        };
    }
    public function getLabelColor(): string
    {
        return match ($this) {
            self::Success => 'badge-light-success',
            self::Pending => 'badge-light-warning',
            self::EXPIRE  => 'badge-light-danger',
        };
    }
    public function getLabelHtml(): string
    {
        return sprintf('<span class="badge rounded-pill text-white %s">%s</span>', $this->getLabelColor(), $this->getLabelText());
    }
    public static function toarray(): array
    {
        return [
            [
                'id' => static::Success,
                'name' => 'Success'
            ],

            [
                'id' => static::Pending,
                'name' => 'Pending'
            ]
        ];
    }
}
