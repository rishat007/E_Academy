<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{
    use HasFactory;
    protected $table = "modules";
    protected $fillable=[

        "name","status",
    ];
    /**
     * Get all of the permission for the Module
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permission(): HasMany
    {
        return $this->hasMany(Permission::class);
    }

    public function scopeIsActive(Builder $query){
        return $query->where('status', 1);
    }
}
