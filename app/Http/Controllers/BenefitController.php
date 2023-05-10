<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BenefitController extends Controller
{



    public function store(Request $request)
    {
        $name = $request->icon->getClientOriginalName();
        $path = $request->file('icon')->storeAs('icons', $name, 'public');

        $benefit = Benefit::create([
            'project_id' => $request->project_id,
            'icon' => url('') . '/storage/' . $path,
        ]);

        foreach (Language::all() as $language) {
            $name = 'name_' . $language->code;
            $number = 'number_' . $language->code;

            $benefit->setTranslation('name', $language->code, $request->$name);
            $benefit->setTranslation('number', $language->code, $request->$number);
            $benefit->save();
        }

        return redirect()->back();
    }






    public function update(Request $request, Benefit $benefit)
    {
        foreach (Language::all() as $language) {
            $name = 'name_' . $language->code;
            $number = 'number_' . $language->code;

            $benefit->setTranslation('name', $language->code, $request->$name);
            $benefit->setTranslation('number', $language->code, $request->$number);
            $benefit->save();
        }

        if ($request->hasFile('icon')) {
            $iconPath = str_replace(url('') . '/storage/', '', $benefit->icon);
            Storage::disk('public')->delete($iconPath);

            $name = $request->icon->getClientOriginalName();
            $path = $request->file('icon')->storeAs('icons', $name, 'public');

            $benefit->icon = url('') . '/storage/' . $path;
            $benefit->save();
        }

        return redirect()->back();
    }







    public function destroy(Benefit $benefit)
    {
        $imagePath = str_replace(url('') . '/storage/', '', $benefit->icon);
        Storage::disk('public')->delete($imagePath);
        $benefit->delete();

        return redirect()->back();
    }
}
