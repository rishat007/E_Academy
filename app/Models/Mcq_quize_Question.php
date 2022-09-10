<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mcq_quize_Question extends Model
{
    use HasFactory;
    protected $table = "mcq_quizes_questions";
    protected $fillable =[
        'mcq_quizes_id','mcq_quizes_chapters_id','mcq_quizes_chapters_subjects_id','mcq_q_c_s_classes_id','name','status',
    ];
}
