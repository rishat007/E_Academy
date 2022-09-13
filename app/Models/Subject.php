<?php

namespace App\Models;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\BindsOnUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory;
    use Userstamps;
    use GeneratesUuid;
    use BindsOnUuid;
    use SoftDeletes;


    protected $table = "subjects";

    protected $fillable = [
        "student_class_id",
        "name",
        "status",
    ];
    protected $casts = [
        'uuid' => EfficientUuid::class,
    ];

    /**
     * Get the StudentClass that owns the Subject
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function studentClass(): BelongsTo
    {
        return $this->belongsTo(StudentClass::class);
    }
    /**
     * Get all of the chapters for the Subject
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class, 'subjects_id');
    }
}
