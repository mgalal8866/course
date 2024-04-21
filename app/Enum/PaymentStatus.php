<?php

namespace App\Enum;


enum PaymentStatus: int
{
    case Success = 1;
    case Pending = 2;
    case Field = 3;
    case Delivered = 4;
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
            self::Pending   => 'Pending',
            self::Success   => 'Success',
            self::Field     => 'Field',
            self::Delivered => 'delivered',
        };
    }
    public function getLabelColor(): string
    {
        return match ($this) {
            self::Success    => 'bg-success',
            self::Pending    => 'bg-warning',
            self::Field      => 'bg-danger',
            self::Delivered  => 'bg-success',
        };
    }
    public function getLabelHtml(): string
    {
        return sprintf('<span class="badge badge-glow %s">%s</span>', $this->getLabelColor(), $this->getLabelText());
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
