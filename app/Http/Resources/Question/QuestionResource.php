<?php

namespace App\Http\Resources\Question;

use App\Http\Resources\Answer\AnswerCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            'question' => $this->question,
            "answers" => new AnswerCollection($this->whenLoaded("answers"))
        ];
    }
}
