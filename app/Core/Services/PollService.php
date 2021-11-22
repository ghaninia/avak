<?php

namespace App\Core\Services;

use App\Models\Question;
use Illuminate\Support\Collection;

class PollService
{
    const LIMIT = 5;

    public function getRandomQuestions(): Collection
    {
        $questions = Question::query()
            ->with("answers")
            ->inRandomorder()
            ->take(
                SELF::LIMIT
            )
            ->get();

        return $questions;
    }
}
