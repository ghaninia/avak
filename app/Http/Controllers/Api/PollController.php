<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Core\Services\Poll\PollServiceInterface;
use App\Http\Resources\Question\QuestionCollection;

class PollController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(public PollServiceInterface $pollService)
    {
    }

    public function index()
    {
        return new QuestionCollection(
            $this->pollService->getRandomQuestions()
        );
    }

    public function store(Request $request)
    {
        $pollValidations = $this->pollService->pollRequestValidations($request);
        $this->validate(...$pollValidations);

        $result = $this->pollService->saveNewPollRequest($request);

        return
            $result ?
            response()->json(
                ["msg" => "اطلاعات با موفقیت ثبت شده است"],
                200
            ) :
            response()->json(
                ["msg" => "خطای غیرمنتظره در زمان ثبت اطلاعات به وجود آمده است"],
                500
            );
    }
}
