<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{


    public function index()
    {
        return view('contacts.index')
            ->with([
                'contacts' => Contact::latest()->paginate(20),
            ]);
    }





    public function show(Contact $contact)
    {
        if ($contact->read_at == null) {
            $contact->read_at = Carbon::now();
            $contact->save();
        }

        return view('contacts.show')
            ->with([
                'contact' => $contact,
            ]);
    }






    public function store(Request $request)
    {
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return response($contact);
    }






    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index');
    }
}
