<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $fillable = [
      'url', 'task_id'
    ];
    protected $appends = ['thumbnail'];

    public function getThumbnailAttribute()
    {
        return $this->url;
    }
}
