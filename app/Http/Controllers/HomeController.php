<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Contact;
use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function main()
    {
        return view('main')->with([
            'projects_count' => count(Project::all()),
            'apartments_count' => count(Apartment::all()),
            'contacts_count' => count(Contact::where('read_at', null)->get()),
        ]);
    }




    public function language($locale)
    {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
