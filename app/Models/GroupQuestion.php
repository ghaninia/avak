<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupQuestion extends Model
{

    protected $fillable = [
        "user_id"
    ];

    protected $hidden = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class);
    }
}
