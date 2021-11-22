<?php

namespace App\Core\Services\UserAnswer;

use App\Models\GroupQuestion;
use Illuminate\Support\Collection;

interface UserAnswerServiceInterface
{
    public function mapQuestionRequest(array $questionsWithAnswer) : array ;

    public function createCollectionAnswersForGroup(GroupQuestion $groupQuestion, array $questionsWithAnswer): void ;
}
