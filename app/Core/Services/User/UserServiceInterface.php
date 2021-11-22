<?php

namespace App\Core\Services\User;

use App\Models\User;

interface UserServiceInterface
{
    public function createNewUser(array $data): User ;
}
