<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Order;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $commande_count = Order::query()->where('user_id', Auth::user()->id)->count();
        $message_count = Message::query()->where('destinataire_id', Auth::user()->id)->count();
        Toastr::success('message', 'Tableau de bord!!!');

        return view('home', compact('commande_count', 'message_count'));
    }
}
