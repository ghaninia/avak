<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{

    protected $fillable = [
        "group_question_id" ,
        "question_id" ,
        "answer_id" ,
    ];

    protected $hidden = [];


    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function groupQuestion()
    {
        return $this->belongsTo(GroupQuestion::class);
    }
}
