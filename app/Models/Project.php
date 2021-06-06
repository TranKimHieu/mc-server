<?php


namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $appends = ['captain_info', 'remaining'];

    public function captain()
    {
        return $this->belongsTo(User::class, 'captain_id');
    }

    public function getCaptainInfoAttribute()
    {
        return $this->captain()->firstOrFail();
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->toDateString();
    }

    public function getRemainingAttribute()
    {
        return Carbon::parse($this->end_date)->diffInDays(Carbon::now());
    }
}
