<?php

namespace App\Models;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\BindsOnUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class McqQuestion extends Model
{
    use HasFactory;
    use HasFactory;
    use Userstamps;
    use GeneratesUuid;
    use BindsOnUuid;
    use SoftDeletes;

    protected $table = "mcq_questions";
    protected $fillable =[
      'chapters_id','question','answer','set',
    ];
    protected $casts = [
        'uuid' => EfficientUuid::class,
    ];

    /**
     * Get tchapter that owns the Chapter
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class,"chapters_id");
    }

    /**
     * Get all of the options for the McqQuestion
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options(): HasMany
    {
        return $this->hasMany(McqOption::class);
    }

}
