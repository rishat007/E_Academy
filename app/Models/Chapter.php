<?php

namespace App\Models;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\BindsOnUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Chapter extends Model
{
    use HasFactory;
    use HasFactory;
    use Userstamps;
    use GeneratesUuid;
    use BindsOnUuid;
    use SoftDeletes;

    protected $table = "chapters";
    protected $fillable =[
      'subjects_id','name','status',
    ];
    protected $casts = [
        'uuid' => EfficientUuid::class,
    ];

    /**
     * Get tchapter that owns the Chapter
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

}
