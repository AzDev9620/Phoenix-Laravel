<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Panorama;
use Illuminate\Http\Request;

class LinkController extends Controller
{


    public function store(Request $request)
    {
        $panorama = Panorama::find($request->panorama_id);

        $panorama->links()->create([
            'coordinates' => $request->coordinates,
            'to_panorama_id' => $request->to_panorama_id,
        ]);

        return redirect()->back();
    }






    public function destroy(Link $link)
    {
        $link->delete();

        return redirect()->back();
    }
}
