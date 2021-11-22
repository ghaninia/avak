<?php

namespace App\Core\Services\GroupQuestion;

use App\Models\User;
use App\Models\GroupQuestion;

class GroupQuestionService implements GroupQuestionServiceInterface
{
    public function createNewGroup(User $user): GroupQuestion
    {
        return
            GroupQuestion::create([
                "user_id" => $user->id
            ]);
    }
}
