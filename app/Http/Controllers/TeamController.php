<?php


namespace App\Http\Controllers;


use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{

    public function getTeamInProject($projectId)
    {
        $data = Team::query()->where('project_id', $projectId)->get();
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $payload = $request->only(
            [
                'name',
                'category_id',
                'description',
                'project_id'
            ]
        );
        $team = Team::query()->create($payload);

        return response()->json($team, 200);
    }

}
