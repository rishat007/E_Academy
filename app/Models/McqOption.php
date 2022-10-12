<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class McqOption extends Model
{
    use HasFactory;

    protected $fillable =[
      'mcq_question_id','order','option',
    ];


    /**
    * Get tchapter that owns the Chapter
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function mcq_question(): BelongsTo
    {
    return $this->belongsTo(McqQuestion::class);
    }
}



