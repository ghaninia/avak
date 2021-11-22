<?php

namespace App\Core\Services\GroupQuestion;

use App\Models\User;

interface GroupQuestionServiceInterface
{
    public function createNewGroup(User $user);
}
