<?php

namespace App\Core\Services\Poll;

use Illuminate\Http\Request;

interface PollServiceInterface
{
    public function getRandomQuestions();
    public function pollRequestValidations(Request $request);
    public function saveNewPollRequest(Request $request);
}
