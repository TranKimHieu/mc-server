<?php

namespace App\Models;

use App\Enums\Roles;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $appends = ['role_name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
        {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function myProject()
    {
        return $this->hasMany(Project::class, 'captain_id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'user_team')->withPivot('is_leader');
    }

    public function getRoleNameAttribute()
    {
        switch ($this->role_id){
            case Roles::MANAGER:
                return 'Manager';
            case Roles::EMPLOYEE:
                return 'Employee';
            case Roles::TEAM_LEADER:
                return 'Team leader';
        }
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->toDateString();
    }

}
