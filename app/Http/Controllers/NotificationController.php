<?php


namespace App\Http\Controllers;


use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getAll($userId)
    {
        $data = Notification::query()->where('user_id', $userId)->get();
        return response()->json($data, 200);
    }

    public function store(Request $payload)
    {
        $noti = Notification::query()->create($payload->toArray());
        return response()->json($noti, 200);
    }

}
