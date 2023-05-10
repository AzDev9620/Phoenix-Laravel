<?php

namespace App\Http\Controllers;

use App\Models\Aspect;
use App\Models\Language;
use Illuminate\Http\Request;

class AspectController extends Controller
{


    public function store(Request $request)
    {
        $aspect = Aspect::create([
            'project_id' => $request->project_id,
        ]);

        foreach (Language::all() as $language) {
            $name = 'name_' . $language->code;
            $aspect->setTranslation('name', $language->code, $request->$name);
            $aspect->save();
        }

        return redirect()->back();
    }






    public function update(Request $request, Aspect $aspect)
    {
        foreach (Language::all() as $language) {
            $name = 'name_' . $language->code;
            $aspect->setTranslation('name', $language->code, $request->$name);
            $aspect->save();
        }

        return redirect()->back();
    }






    public function destroy(Aspect $aspect)
    {
        $aspect->delete();
        return redirect()->back();
    }
}
