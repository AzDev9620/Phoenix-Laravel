<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Feature;
use App\Models\Image;
use App\Models\Language;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{

    public function index()
    {
        return view('apartments.index')
            ->with([
                'apartments' => Apartment::latest()->paginate(20),
            ]);
    }





    public function show(Apartment $apartment)
    {
        $apartment_features = [];
        if ($apartment->features) {
            foreach ($apartment->features as $feature) {
                array_push($apartment_features, $feature->id);
            }
        }

        return view('apartments.show')
            ->with([
                'languages' => Language::all(),
                'apartment' => $apartment,
                'features' => Feature::where('type', 'apartment')->whereNotIn('id', $apartment_features)->get(),
            ]);
    }






    public function create(Project $project)
    {
        return view('apartments.create')
            ->with([
                'languages' => Language::all(),
                'features' => Feature::where('type', 'apartment')->get(),
                'projects' => Project::all(),
                'project' => $project,
            ]);
    }





    public function store(Request $request)
    {
        $apartment = Apartment::create([
            'project_id' => $request->project_id,
            'rooms_number' => $request->rooms_number,
        ]);

        $this->saveApartment($apartment, $request);

        if ($request->features) {
            foreach ($request->features as $feature) {
                $relatedFeature = Feature::find($feature);
                $apartment->features()->attach($relatedFeature);
            }
        }

        if ($request->has('images')) {
            foreach ($request->images as $image) {
                $name = $image->getClientOriginalName();
                $path = $image->storeAs('images', $name, 'public');

                $apartment->images()->create([
                    'name' => $name,
                    'path' => url('') . '/storage/' . $path
                ]);
            }
        }

        return redirect()->route('projects.show', ['project' => Project::find($request->project_id)->id]);
    }





    public function edit(Apartment $apartment)
    {
        return view('apartments.edit')
            ->with([
                'languages' => Language::all(),
                'apartment' => $apartment,
            ]);
    }






    public function update(Request $request, Apartment $apartment)
    {
        $name = $this->saveApartment($apartment, $request);

        return redirect()->route('apartments.show', ['apartment' => $apartment->id]);
    }






    public function destroy(Apartment $apartment)
    {
        $apartment->delete();
        return redirect()->route('apartments.index');
    }





    public function saveApartment($apartment, Request $request): string
    {
        foreach (Language::all() as $language) {
            $name = 'name_' . $language->code;
            $title = 'title_' . $language->code;
            $about = 'about_' . $language->code;

            $apartment->setTranslation('name', $language->code, $request->$name);
            $apartment->setTranslation('title', $language->code, $request->$title);
            $apartment->setTranslation('about', $language->code, $request->$about);

            $apartment->save();
        }
        return $name;
    }

}
