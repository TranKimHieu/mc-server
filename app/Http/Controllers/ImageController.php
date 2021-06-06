<?php


namespace App\Http\Controllers;


use App\Http\Requests\StoreTaskRequest;
use App\Models\Images;
use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function getByTask($taskId)
    {
        $data = Images::query()->where(['task_id' => $taskId])->get();
        return response()->json($data, 200);
    }

}
