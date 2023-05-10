<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Language;
use App\Models\Project;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function projects_index()
    {
        return ProjectResource::collection(Project::all());
    }



    public function projects_show($lang, Project $project)
    {
        return new ProjectResource($project);
    }



    public function locales()
    {
        return Language::all();
    }
}
