<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FloorController extends Controller
{



    public function store(Request $request)
    {
        $name = $request->plan->getClientOriginalName();
        $path = $request->file('plan')->storeAs('plans', $name, 'public');

        Floor::create([
            'plan' => url('') . '/storage/' . $path,
            'apartment_id' => $request->apartment_id,
            'number' => $request->number,
        ]);

        return redirect()->back();
    }






    public function destroy(Floor $floor)
    {
        $imagePath = str_replace(url('') . '/storage/', '', $floor->plan);
        Storage::disk('public')->delete($imagePath);

        $floor->delete();

        return redirect()->back();
    }

}
