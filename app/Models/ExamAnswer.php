<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAnswer extends Model
{
    use HasFactory;

    protected $fillable =[
        'exam_id',
        'question_id',
        'correct_answer',
        'given_answer',
        'score',
    ];

    public function scopeCorrect($query)
    {
        return $query->where('score', 1);
    }
}
