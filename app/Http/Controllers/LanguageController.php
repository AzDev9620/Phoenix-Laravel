<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{


    public function index()
    {
        return view('languages')
            ->with([
                'languages' => Language::all(),
            ]);
    }





    public function store(Request $request)
    {
        Language::create([
            'code' => $request->code,
            'name' => $request->name,
        ]);

        return redirect()->back();
    }





    public function destroy(Language $language)
    {
        $language->delete();

        return redirect()->back();
    }
}
