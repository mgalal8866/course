<?php

namespace App\Enum;


enum TypeBook: int
{
    case OFFLINE = 1;
    case ONLINE = 2;
    public function isOffline(): bool
    {
        return $this === static::OFFLINE;
    }
    public function isOnline(): bool
    {
        return $this === static::ONLINE;
    }
    public static function toarray(): array
    {
        return [
            [
                'id'=>static::OFFLINE,
                'name'=> 'Offline'
            ],
            [
                'id'=>static::ONLINE,
                'name'=> 'ONLINE'
            ]
        ];
    }
}
