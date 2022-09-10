<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mcq_quize extends Model
{
    use HasFactory;
    protected $table = "mcq_quizes";
    protected $fillable =[
        'chapters_id','name','status',
    ];
}
