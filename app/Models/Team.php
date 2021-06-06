<?php


namespace App\Models;


use App\Enums\TeamCategories;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $appends = ['category', 'total_member', 'leader'];

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'project_id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_team');
    }

    public function getCategoryAttribute()
    {
        switch ($this->attributes['category_id']) {
            case TeamCategories::MANAGER:
                return 'Manager';
            case TeamCategories::CONTRACT:
                return 'Contract';
            case TeamCategories::EVERYDAY:
                return 'Everyday';
        }
    }

    public function getTotalMemberAttribute()
    {
        return $this->users()->count();
    }

    public function getLeaderAttribute()
    {
       $user = $this->users()->wherePivot('is_leader', '=', 1)->get();
       if($user->isNotEmpty()){
           return implode($user->pluck('name')->toArray(), ', ');
       }else{
           return '';
       }
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->toDateString();
    }

}
