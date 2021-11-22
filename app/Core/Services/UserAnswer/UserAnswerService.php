<?php

namespace App\Core\Services\UserAnswer;

use App\Models\GroupQuestion;

class UserAnswerService implements UserAnswerServiceInterface
{
    public function mapQuestionRequest(array $questionsWithAnswer) : array 
    {
        return
            collect($questionsWithAnswer)->map(function ($answer, $question) {
                return [
                    "answer_id" => $answer,
                    "question_id" => $question
                ];
            })->toArray();
    }

    public function createCollectionAnswersForGroup(GroupQuestion $groupQuestion, array $questionsWithAnswer): void
    {
        $groupQuestion->userAnswers()->createMany(
            $this->mapQuestionRequest($questionsWithAnswer)
        );
    }
}
