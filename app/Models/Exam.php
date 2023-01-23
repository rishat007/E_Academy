<?php

namespace App\Models;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\BindsOnUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Cast;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Builder;

class Exam extends Model
{
    use HasFactory;
    Use GeneratesUuid;
    Use BindsOnUuid;

    const EXAM_TYPE_MCQ_QUIZ=1;
    const EXAM_TYPE_MCQ_QUIZ_FEE=10;
    const EXAM_TYPE_MODELTEST=2;
    const EXAM_TYPE_MODELTEST_FEE=20;

    protected $fillable =[
        'exam_type_id','student_id','chapters_id'
    ];

    protected $casts = [
       'uuid' => EfficientUuid::class,
    ];

    public function examAnswer()
    {
        return $this->hasMany(ExamAnswer::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapters_id');
    }

}
