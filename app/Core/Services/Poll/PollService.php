<?php

namespace App\Core\Services\Poll;

use Exception;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Core\Services\User\UserServiceInterface;
use App\Core\Services\UserAnswer\UserAnswerServiceInterface;
use App\Core\Services\GroupQuestion\GroupQuestionServiceInterface;

class PollService implements PollServiceInterface
{
    const LIMIT = 5;

    public function __construct(
        public UserServiceInterface $userService,
        public GroupQuestionServiceInterface $groupQuestionService,
        public UserAnswerServiceInterface $userAnswerService
    ) {
    }

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

    public function pollRequestValidations(Request $request)
    {

        $request->merge([
            "questions_list" => array_keys(
                $request->questions ?? []
            ),
            "answers_list" => array_values(
                $request->questions ?? []
            )
        ]);

        return [
            $request, [
                'fullname' => ['required'],
                'mobile' => ['required'],

                "answers_list" => ["required", "array"],
                "answers_list.*" => ["required", "exists:answers,id"],

                "questions_list" => ["required", "array"],
                "questions_list.*" => ["required", "exists:questions,id"],
            ], [
                "fullname.required" => "نام و نام خانوادگی اجباری است !",
                "mobile.required" => "موبایل اجباری است !",
                "answers_list.required" => "لیست جواب ها اجباری است ",
                "answers_list.array" => "لیست جواب ها باید شامل آرایه باشد ",
                "questions_list.required" => "لیست سوالات اجباری است ",
                "questions_list.array" => "لیست سوالات باید شامل آرایه باشد ",
            ]
        ];
    }


    public function saveNewPollRequest(Request $request)
    {
        try {
            $user = $this->userService->createNewUser([
                "fullname" => $request->input("fullname"),
                "mobile" => $request->input("mobile"),
            ]);
            
            $group = $this->groupQuestionService->createNewGroup($user);

            $this->userAnswerService->createCollectionAnswersForGroup(
                $group,
                $request->input('questions')
            );
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
