<?php

namespace App\Enum;


enum LessonStatu: int
{
    case QUIZ = 0;
    case TUTORIAL= 1;
    case STREAM = 2;
    case Mo7aky = 3;
    public function isQuiz(): bool
    {
        return $this === static::QUIZ;
    }
    public function isTUTORIAL(): bool
    {
        return $this === static::TUTORIAL;
    }
    public function isSTREAM(): bool
    {
        return $this === static::STREAM;
    }
    public function isMo7aky(): bool
    {
        return $this === static::Mo7aky;
    }
    public static function toarray(): array
    {
        return [
            [
                'id'=>static::QUIZ,
                'name'=> 'Quiz'
            ],
            [
                'id'=>static::STREAM,
                'name'=> 'Stream'
            ],
            [
                'id'=>static::TUTORIAL,
                'name'=> 'Tutorial'
            ],
            [
                'id'=>static::Mo7aky,
                'name'=> 'Mo7aky'
            ]
        ];
    }
}
