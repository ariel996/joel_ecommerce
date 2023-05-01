<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Adresse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdresseController extends Controller
{
    public function index()
    {
        $adresses = Adresse::query()->where('user_id', Auth::user()->id)->get();
        return view('user.adresses.index', compact('adresses'));
    }

    public function create()
    {
        return view('user.adresses.create');
    }

    public function store(Request $request)
    {
        Adresse::query()->create([
            'rue' => $request->input('rue'),
            'code' => $request->input('code'),
            'ville' => $request->input('ville'),
            'pays' => $request->input('pays'),
            'user_id' => Auth::user()->id,
        ]);
        return back();
    }

    public function edit($id)
    {
        $adresse = Adresse::query()->findOrFail($id);
        return view('user.adresses.edit', compact('adresse'));
    }

    public function update(Request $request, $id)
    {
        $adresse = Adresse::query()->findOrFail($id);
        $adresse->rue = $request->input('rue');
        $adresse->code = $request->input('code');
        $adresse->ville = $request->input('ville');
        $adresse->pays = $request->input('pays');
        $adresse->save();
        return back();
    }

    public function destroy($id)
    {
        Adresse::query()->findOrFail($id)->delete();
        return back();
    }
}
