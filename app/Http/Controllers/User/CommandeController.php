<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Livraison;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Order::query()
<<<<<<< HEAD
        ->where('user_id', Auth::user()->id)
        ->where('shipped','=', 0)
        ->get();
=======
        ->with('livraisons')
        ->where('user_id', Auth::user()->id)
        //->where('shipped','=', 0)
        ->get();

>>>>>>> 7aa1ad0664662bfec27fe948e8b13b9dc19f3380
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
