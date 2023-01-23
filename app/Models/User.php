<?php

namespace App\Models;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\BindsOnUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Propaganistas\LaravelPhone\Casts\RawPhoneNumberCast;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use GeneratesUuid;
    use BindsOnUuid;
    use HasRoles;

    const USER_TYPE_SUPER_ADMIN = 1;
    const USER_TYPE_TEACHER = 2;
    const USER_TYPE_STUDENT = 3;

    const USER_ROLE_ADMIN = 'Admin';
    const USER_ROLE_TEACHER = 'Teacher';
    const USER_ROLE_STUDENT = 'Student';
    const USER_ROLE_FREE_STUDENT = "Free Student";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone_no',
        'password',
        'user_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'phone_no_verified_at' => 'datetime',
        'phone_no' => RawPhoneNumberCast::class.':BD',
        'uuid' => EfficientUuid::class,
    ];

    public function my_card(){
        return $this->hasMany(UserCardInfo::class);
    }

    //User Type Tacher Secio
    
    public function assignClass()
    {
        return $this->hasMany(TeacherClassSubject::class, 'teacher_id');
    } 
}
