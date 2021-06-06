<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        "type_id",
        "content",
        "path",
        "task_id",
        "user_id",

    ];
}
