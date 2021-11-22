<?php

namespace App\Http\Resources\Answer;

use App\Http\Resources\Question\QuestionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            'answer' => $this->answer,
            "question" => new QuestionResource($this->whenLoaded("question"))
        ];
    }
}
