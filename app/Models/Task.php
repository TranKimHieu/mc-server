<?php


namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'code',
        'description',
        'assignee_id',
        'start_date',
        'end_date',
        'progress',
        'type_id',
        'task_parent_id',
        'project_id'
    ];

    protected $appends = ['text', 'parent'];

    public function getTextAttribute()
    {
        return $this->title;
    }

    public function getStartDateAttribute()
    {
        return Carbon::parse($this->attributes['start_date'])->format('Y-m-d');
    }

    public function getEndDateAttribute()
    {
        return Carbon::parse($this->attributes['end_date'])->format('Y-m-d');
    }

    public function getParentAttribute()
    {
        return $this->task_parent_id;
    }

    public function assigneeObj()
    {
        return $this->hasOne(User::class, 'id', 'assignee_id');
    }
}
