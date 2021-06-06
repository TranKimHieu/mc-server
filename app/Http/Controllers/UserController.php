<?php


namespace App\Http\Controllers;


use App\Enums\Roles;
use App\Jobs\ProcessSendMail;
use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getAll()
    {
        $data = User::all();
        return response()->json($data, 200);
    }

    public function getAllInProject($projectId)
    {
        $data = User::query()->whereHas('teams', function ($query) use ($projectId){
            $query->where('project_id', $projectId);
        })->get()->toArray();

        return response()->json($data, 200);
    }

    public function storeUser(Request $request)
    {
        $payload = $request->only([
            'name',
            'email',
            'address',
            'phone',
            'role_id',
            'team_id'
        ]);
        $payload['password'] = Hash::make(uniqid("vcms_"));
        User::query()->create($payload);
        $isTeamLead = 0;
        if($payload['role_id'] === Roles::TEAM_LEADER) {
            $isTeamLead = 1;
        }
        $user = User::query()->where(['email' => $payload['email']])->first()->teams()->attach($payload['team_id'], ['is_leader' => $isTeamLead]);
        ProcessSendMail::dispatch($user);
        return response()->json($payload, 200);
    }
}
