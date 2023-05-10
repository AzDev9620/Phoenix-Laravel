<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Panorama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PanoramaController extends Controller
{


    public function store(Request $request)
    {
        $apartment = Apartment::find($request->apartment_id);

        if ($request->has('photo')) {
            $name = $request->photo->getClientOriginalName();
            $path = $request->photo->storeAs('panoramas', $name, 'public');
        }

        $apartment->panoramas()->create([
            'photo' => url('') . '/storage/' . $path,
            'name' => $request->name,
        ]);

        return redirect()->back();
    }






    public function show(Panorama $panorama)
    {
        $panoramas = Panorama::where('apartment_id', $panorama->apartment->id)->where('id', '!=', $panorama->id)->get();

        foreach ($panoramas as $index => $pano) {
            foreach ($panorama->links as $link) {
                if ($pano->id == $link->to_panorama_id) {
                    unset($panoramas[$index]);
                }
            }
        }

        return view('panoramas.show')
            ->with([
                'panorama' => $panorama,
                'apartments_panoramas' => $panoramas,
            ]);
    }







    public function destroy(Panorama $panorama)
    {
        $imagePath = str_replace(url('') . '/storage/', '', $panorama->photo);
        Storage::disk('public')->delete($imagePath);

        $panorama->delete();

        return redirect()->back();
    }

}
