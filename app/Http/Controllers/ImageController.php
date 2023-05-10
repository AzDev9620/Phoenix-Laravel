<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Image;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{



    public function delete(Request $request)
    {
        $project = Project::find($request->project_id);

        if ($request->image_type == 'main_image') {
            $imagePath = str_replace(url('') . '/storage/', '', $project->main_image);
            $project->main_image = '';
            $project->save();
        } elseif ($request->image_type == 'second_image') {
            $imagePath = str_replace(url('') . '/storage/', '', $project->second_image);
            $project->second_image = '';
            $project->save();
        }

        Storage::disk('public')->delete($imagePath);

        return redirect()->back();
    }








    public function upload(Request $request)
    {
        if ($request->project_id) {
            $project = Project::find($request->project_id);

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

        } elseif ($request->apartment_id) {
            $apartment = Apartment::find($request->apartment_id);
            foreach ($request->images as $image) {
                $name = $image->getClientOriginalName();
                $path = $image->storeAs('images', $name, 'public');

                $apartment->images()->create([
                    'name' => $name,
                    'path' => url('') . '/storage/' . $path
                ]);
            }
        }

        return redirect()->back();
    }







    public function destroy(Image $image)
    {
        $imagePath = str_replace(url('') . '/storage/', '', $image->path);
        Storage::disk('public')->delete($imagePath);
        $image->delete();

        return redirect()->back();
    }
}
