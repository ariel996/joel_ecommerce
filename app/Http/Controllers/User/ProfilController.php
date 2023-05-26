<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function profile()
    {
        return view('user.profile.index');
    }

    public function change_password()
    {
        return view('user.profile.change_password');
    }

    public function post_change_password(Request $request)
    {
        $password = $request->input('password');
        $cpassword = $request->input('cpassword');
        if ($password == $cpassword) {
            $user = User::query()->findOrFail(Auth::user()->id);
            $user->password = Hash::make($password);
            $user->save();
            Toastr::success('message', 'Mot de passe modifié avec succès !!!');

        } else {
            return back();
        }
        return redirect()->route('profile');
    }

    public function change_profile()
    {
        return view('user.profile.profile');
    }

    public function post_change_profile(Request $request)
    {
        $user = User::query()->where('id', '=',Auth::user()->id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ]);
        Toastr::success('message', 'Profil mis à jour avec succès !!!');
        return redirect()->route('profile');
    }
}
