<?php


namespace App\Http\Controllers;


use App\Http\Requests\StoreTaskRequest;
use App\Models\Images;
use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function getByTask($taskId)
    {
        $data = Images::query()->where(['task_id' => $taskId])->get();
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $file = $request->file;
        $file->move('upload', $file->getClientOriginalName());
//        $url = $request->file('file')->storeAs('image', $path, 'local');
//        Storage::put($path, $request->file('file'));
        $path = 'http://localhost:8000/' . 'upload/' . $file->getClientOriginalName();
        $image = Images::query()->create(['url' => $path, 'task_id' => $request->taskId]);
        return response()->json($image);
    }


}
