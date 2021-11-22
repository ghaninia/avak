<?php

namespace App\Core\Services\User;

use App\Models\User;

class UserService implements UserServiceInterface
{
    public function createNewUser(array $data): User
    {
        return
            User::create([
                "fullname" => $data["fullname"], 
                "mobile" => $data["mobile"], 
            ]);
    }
}
