<?php

namespace App\Enum;


enum Quiz: int
{
    case QUIZ = 1;
    case LEVEL = 2;
    public function isQuiz(): bool
    {
        return $this === static::QUIZ;
    }
    public function isLevel(): bool
    {
        return $this === static::LEVEL;
    }
    public static function toarray(): array
    {
        return [
            [
                'id'=>static::QUIZ,
                'name'=> 'Quiz'
            ],
            [
                'id'=>static::LEVEL,
                'name'=> 'Level'
            ]
        ];
    }
}
