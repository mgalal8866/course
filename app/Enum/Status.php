<?php

namespace App\Enum;


enum Stauts: int
{
    case WORK = 1;
    case FINISHED = 2;
    case EXPIRE = 3;
    public function isEXPIRE(): bool
    {
        return $this === static::EXPIRE;
    }
    public function isWORK(): bool
    {
        return $this === static::WORK;
    }
    public function isFINISHED(): bool
    {
        return $this === static::FINISHED;
    }
    public static function toarray(): array
    {
        return [
            [
                'id'=>static::EXPIRE,
                'name'=> 'EXPIRE'
            ],
            [
                'id'=>static::WORK,
                'name'=> 'WORK'
            ],
            [
                'id'=>static::FINISHED,
                'name'=> 'FINISHED'
            ]
        ];
    }
}
