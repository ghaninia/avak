<?php

namespace App\Http\Controllers\Api;

use App\Core\Services\PollService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Question\QuestionCollection;

class PollController extends Controller
{
    protected $poolService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->poolService = new PollService;
    }

    public function index()
    {
        return new QuestionCollection(
            $this->poolService->getRandomQuestions()
        );
    }
}
