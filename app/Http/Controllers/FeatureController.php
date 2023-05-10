<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Apartment;
use App\Models\Feature;
use App\Models\Language;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Utils;

class FeatureController extends Controller
{


    public function index()
    {
        return view('features.index')
            ->with([
                'languages' => Language::all(),
                'project_features' => Feature::where('type', 'project')->get(),
                'apartment_features' => Feature::where('type', 'apartment')->get(),
            ]);
    }







    public function store(Request $request)
    {
        if ($request->hasFile('icon')) {
            $name = $request->icon->getClientOriginalName();
            $path = $request->file('icon')->storeAs('icons', $name, 'public');
            $fullPath = url('') . '/storage/' . $path;
        }

        $feature = Feature::create([
            'icon' => $fullPath,
            'type' => $request->type,
        ]);

        foreach (Language::all() as $language) {
            $name = 'name_' . $language->code;
            $feature->setTranslation('name', $language->code, $request->$name);
            $feature->save();
        }

        return redirect()->back();
    }






    public function destroy(Feature $feature)
    {
        $imagePath = str_replace(url('') . '/storage/', '', $feature->icon);
        Storage::disk('public')->delete($imagePath);

        $feature->delete();

        return redirect()->back();
    }







    public function attach(Request $request)
    {
        if ($request->apartment_id) {
            $apartment = Apartment::find($request->apartment_id);
            foreach ($request->features as $featureId) {
                $feature = Feature::find($featureId);
                $apartment->features()->attach($feature);
            }
        } elseif ($request->project_id) {
            $project = Project::find($request->project_id);
            foreach ($request->features as $featureId) {
                $feature = Feature::find($featureId);
                $project->features()->attach($feature);
            }
        }
        return redirect()->back();
    }







    public function detach(Request $request)
    {
        if ($request->apartment_id) {
            $apartment = Apartment::find($request->apartment_id);
            $apartment->features()->detach($request->feature_id);
        } elseif ($request->project_id) {
            $project = Project::find($request->project_id);
            $project->features()->detach($request->feature_id);
        }
        return redirect()->back();
    }

}
