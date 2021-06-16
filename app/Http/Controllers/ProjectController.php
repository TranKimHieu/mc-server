<?php


namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function myProject()
    {
        return response()->json(Auth::user()->myProject);
    }

}
