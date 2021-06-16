<?php


namespace App\Http\Controllers;


use App\Http\Requests\StoreTaskRequest;
use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getAll($projectId)
    {
        $data = Task::query()->with('assigneeObj')->where('project_id', $projectId)->get();
        return response()->json($data, 200);
    }

    public function getParents($projectId)
    {
        $data = Task::query()->whereNull('task_parent_id')->where('project_id', $projectId)->get();
        return response()->json($data, 200);
    }

    public function getChildren($parentId)
    {
        $data = Task::query()->where(['task_parent_id' => $parentId])->get();
        return response()->json($data, 200);
    }

    public function store(StoreTaskRequest $request)
    {
        $payload = $request->only([
            'title',
            'description',
            'assignee_id',
            'start_date',
            'end_date',
            'progress',
            'type_id',
            'task_parent_id',
            'project_id']);
        $project = Project::query()->findOrFail($payload['project_id']);
        $payload['start_date'] = Carbon::parse($payload['start_date']);
        $payload['end_date'] = Carbon::parse($payload['end_date']);
        $datas = [];
        if (is_array($payload['assignee_id'])) {
            foreach ($payload['assignee_id'] as $id ) {
                $payload['code'] = uniqid($project->code);
                $data = Task::query()->create(array_merge($payload, ['assignee_id' => $id]));
                $task = Task::query()->find($data->id);
                array_push($datas, $task);
            }
        }
        return response()->json($datas, 200);
    }

    public function update(Request $request, $id)
    {
        $payload = $request->only([
            'title',
            'description',
            'assignee_id',
            'start_date',
            'end_date',
            'progress',
            'type_id',
            'task_parent_id']);
        $payload['start_date'] = Carbon::parse($payload['start_date']);
        $payload['end_date'] = Carbon::parse($payload['end_date']);

        $data = Task::query()->findOrFail($id)->update($payload);
        return response()->json($data, 200);
    }
}
