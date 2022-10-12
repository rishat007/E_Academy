<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizExam extends Model
{
    use HasFactory;

    protected $fillable=[

        "name","student_id","chapters_id"
    ];
}
