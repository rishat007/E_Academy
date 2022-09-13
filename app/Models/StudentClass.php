<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentClass extends Model
{
    use HasFactory;

    protected $table = "student_classes";

    protected $fillable =[
        'name','status',
    ];

    /**
     * Get all of the subjects for the StudentClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class);
    }
}
