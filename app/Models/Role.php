<?php

namespace App\Models;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\BindsOnUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Wildside\Userstamps\Userstamps;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    use Userstamps;
    use GeneratesUuid;
    use BindsOnUuid;

    protected $fillable = ['name', 'guard_name'];

    protected $casts = [
        'uuid' => EfficientUuid::class,
    ];
}
