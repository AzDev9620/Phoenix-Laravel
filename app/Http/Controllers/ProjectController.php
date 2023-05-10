<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Image;
use App\Models\Language;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{



    public function index()
    {
        return view('projects.index')
            ->with([
                'projects' => Project::all()
            ]);
    }






    public function show(Project $project)
    {
        $project_features = [];
        if ($project->features) {
            foreach ($project->features as $feature) {
                array_push($project_features, $feature->id);
            }
        }
        return view('projects.show')
            ->with([
                'languages' => Language::all(),
                'project' => $project,
                'features' => Feature::where('type', 'project')->whereNotIn('id', $project_features)->get(),
            ]);
    }







    public function create()
    {
        return view('projects.create')
            ->with([
                'languages' => Language::all(),
                'features' => Feature::where('type', 'project')->get(),
            ]);
    }






    public function store(Request $request)
    {
        $project = Project::create();
        foreach (Language::all() as $language) {
            $name = 'name_' . $language->code;
            $sub_name = 'sub_name_' . $language->code;
            $about = 'about_' . $language->code;

            $project->setTranslation('name', $language->code, $request->$name);
            $project->setTranslation('sub_name', $language->code, $request->$sub_name);
            $project->setTranslation('about', $language->code, $request->$about);
            $project->save();

            $file = 'file_' . $language->code;
            if ($request->hasFile($file)) {
                $name = $request->$file->getClientOriginalName();
                $path = $request->file($file)->storeAs('files', $name, 'public');
                $project->setTranslation('file', $language->code, url('') . '/storage/' . $path);
                $project->save();
            }
        }

        if ($request->features) {
            foreach ($request->features as $feature) {
                $relatedFeature = Feature::find($feature);
                $project->features()->attach($relatedFeature);
            }
        }

        if ($request->hasFile('main_image')) {
            $name = $request->main_image->getClientOriginalName();
            $path = $request->file('main_image')->storeAs('main-images', $name, 'public');
            $project->main_image = url('') . '/storage/' . $path;
            $project->save();
        }

        if ($request->hasFile('second_image')) {
            $name = $request->second_image->getClientOriginalName();
            $path = $request->file('second_image')->storeAs('second-images', $name, 'public');
            $project->second_image = url('') . '/storage/' . $path;
            $project->save();
        }

        if ($request->has('images')) {
            foreach ($request->images as $image) {
                $name = $image->getClientOriginalName();
                $path = $image->storeAs('images', $name, 'public');

                $project->images()->create([
                    'name' => $name,
                    'path' => url('') . '/storage/' . $path
                ]);
            }
        }

        return redirect()->route('projects.index');
    }







    public function edit(Project $project)
    {
        return view('projects.edit')
            ->with([
                'languages' => Language::all(),
                'project' => $project,
            ]);
    }







    public function update(Request $request, Project $project)
    {
        foreach (Language::all() as $language) {
            $name = 'name_' . $language->code;
            $sub_name = 'sub_name_' . $language->code;
            $about = 'about_' . $language->code;

            $project->setTranslation('name', $language->code, $request->$name);
            $project->setTranslation('sub_name', $language->code, $request->$sub_name);
            $project->setTranslation('about', $language->code, $request->$about);
            $project->save();

            $file = 'file_' . $language->code;
            if ($request->hasFile($file)) {
                $filePath = str_replace(url('') . '/storage/', '', $project->file);
                Storage::disk('public')->delete($filePath);

                $name = $request->$file->getClientOriginalName();
                $path = $request->file($file)->storeAs('files', $name, 'public');
                $project->setTranslation('file', $language->code, url('') . '/storage/' . $path);
                $project->save();
            }
        }

        return redirect()->route('projects.show', ['project' => $project->id]);
    }







    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index');
    }

}
