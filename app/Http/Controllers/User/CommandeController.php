<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Order::query()
        ->where('user_id', Auth::user()->id)
        ->where('shipped','=', 0)
        ->get();
        return view('user.commandes.index', compact('commandes'));
    }

    public function show($commande_id)
    {
        $order = Order::query()->findOrFail($commande_id);
        return view('user.commandes.show', compact('order'));
    }

    public function destroy($commande_id)
    {
        Order::query()->findOrFail($commande_id)->delete();
        return back();
    }
}
