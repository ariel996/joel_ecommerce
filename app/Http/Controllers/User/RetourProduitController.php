<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\RetourProduit;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class RetourProduitController extends Controller
{

    public function accepter($id)
    {
        RetourProduit::query()->where('id', $id)->update([
            'accepted' => 1
        ]);
        return back();
    }

    public function index()
    {
        $retour_produits = RetourProduit::query()->get();
        return view('user.retour_produits.index', compact('retour_produits'));
    }

    public function create()
    {
        return view('user.retour_produits.create');
    }

    public function store(Request $request)
    {
        RetourProduit::query()->create([
            'code_produit' => $request->input('code_produit'),
            'etat_produit' => $request->input('etat_produit'),
            'accepted' => 0
        ]);
        Toastr::success('message', 'Votre requête a été prise en compte. Vous serez notifier d\'ici peu.');
        return back();
    }

    public function edit($id)
    {
        $retour_produit = RetourProduit::query()->findOrFail($id);
        return view('user.retour_produits.edit', compact('retour_produit'));
    }

    public function update(Request $request, $id)
    {
        RetourProduit::query()->where('id', $id)->update([
            'code_produit' => $request->input('code_produit'),
            'etat_produit' => $request->input('etat_produit'),
        ]);
        Toastr::success('message', 'Vous avez mis à jour votre requête avec succès.');
        return back();
    }

    public function destroy($id)
    {
        RetourProduit::query()->findOrFail($id)->delete();
        Toastr::success('message', 'Suppression avec succès');
        return back();
    }
}
