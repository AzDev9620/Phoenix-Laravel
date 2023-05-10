<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function profile()
    {
        return view('profile')
            ->with([
                'user' => Auth::user(),
            ]);
    }






    public function update(Request $request)
    {
        User::find(1)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back();
    }







    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $userPassword = $user->password;

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|same:confirm_password|min:9',
            'confirm_password' => 'required',
        ]);

        if (!Hash::check($request->current_password, $userPassword)) {
            return back()->withErrors(['current_password' => 'password not match']);
        }

        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->back()->with('success', 'password successfully updated');
    }
}
