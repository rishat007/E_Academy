<?php

namespace App\Models;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\BindsOnUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizExam extends Model
{
    use HasFactory;
    use GeneratesUuid;
    use BindsOnUuid;

    protected $fillable=[
        "name",
        "student_id",
        "chapters_id"
    ];

    protected $casts = [
        'uuid' =>EfficientUuid::class,
    ];
}
