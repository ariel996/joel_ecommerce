<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;
use Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use Cartalyst\Stripe\Stripe;
use Mail;
use App\Mail\OrderPlaced;
use App\Models\Adresse;
use App\Models\Livraison;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{


    public function index()
    {
        if (Cart::instance('default')->count() > 0) {
            $subtotal = Cart::instance('default')->subtotal() ?? 0;
            $discount = session('coupon')['discount'] ?? 0;
            $newSubtotal = $subtotal - $discount > 0 ? $subtotal - $discount : 0;
            $tax = $newSubtotal * (config('cart.tax') / 100);
            $total = $tax + $newSubtotal;
            $adresses = Adresse::query()->where('user_id', '=', Auth::user()->id)->get();
            return view('checkout')->with([
                'subtotal' => $subtotal,
                'discount' => $discount,
                'newSubtotal' => $newSubtotal,
                'total' => $total,
                'tax' => $tax,
                'adresses' => $adresses
            ]);
        }
        return redirect()->route('cart.index')->withError('You have nothing in your cart , please add some products first');
    }

    public function store(CheckoutRequest $request)
    {
        if ($this->productsAreNoLongerAvailable()) {
            return back()->withError('Sorry, one of the items on your cart is no longer available');
        }
        $contents = Cart::instance('default')->content()->map(function ($item) {
            return $item->model->slug . ', ' . $item->qty;
        })->values()->toJson();

        try {
            // $stripe = Stripe::make('api_key');
            // $charge = $stripe->charges()->create([
            //     'amount' => Cart::instance('default')->total(),
            //     'currency' => 'USD',
            //     'source' => $request->stripeToken,
            //     'description' => 'Order',
            //     'receipt_email' => $request->email,
            //     'metadata' => [
            //         'contents' => $contents,
            //         'quantity' => Cart::instance('default')->count(),
            //         'discount' => session()->has('coupon') ? collect(session('coupon')->toJson) : null,
            //     ],
            // ]);

            $address = Adresse::query()->findOrFail($request->adresse_id);
            $order = Order::create([
                'user_id' => auth()->user() ? auth()->user()->id : null,
                'ref_id' => Str::random(6),
                'billing_email' => Auth::user()->email,
                'billing_name' => Auth::user()->name,
                'billing_address' => $address->rue,
                'billing_city' => $address->ville,
                'billing_province' => $address->pays,
                'billing_postalcode' => $address->code,
                'billing_phone' => $request->phone,
                'billing_name_on_card' => $request->name_on_card,
                'billing_discount' => $this->getNumbers()->get('discount'),
                'billing_discount_code' => $this->getNumbers()->get('code'),
                'billing_subtotal' => $this->getNumbers()->get('newSubtotal'),
                'billing_tax' => $this->getNumbers()->get('newTax'),
                'billing_total' => $this->getNumbers()->get('newTotal'),
                'error' => ''
            ]);

            foreach (Cart::instance('default')->content() as $item) {
                OrderProduct::create([
                    'product_id' => $item->model->id,
                    'order_id' => $order->id,
                    'quantity' => $item->qty
                ]);
            }

            // SUCCESSFUL
            $this->decreaseQuantities();
            Mail::to($order->user->email)->send(new OrderPlaced($order));
            Cart::instance('default')->destroy();
            session()->forget('coupon');
<<<<<<< HEAD
            return redirect()->route('welcome')->with('success', 'Your order is completed successfully!');
        } catch (\Exception $e) {
=======

            return redirect()->route('welcome')->with('success', 'Votre commande a été enregistrée avec succès!');
        } catch (Exception $e) {

>>>>>>> 7aa1ad0664662bfec27fe948e8b13b9dc19f3380
            $this->insertIntoOrdersTable($request, $e->getMessage());
            return back()->withError('Error ' . $e->getMessage());
        }
    }

    private function getNumbers()
    {
        $tax = config('cart.tax') / 100;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $code = session()->get('coupon')['code'] ?? null;
        $newSubtotal = Cart::instance('default')->subtotal() - $discount;
        if ($newSubtotal < 0) {
            $newSubtotal = 0;
        }
        $newTax = $newSubtotal * $tax;
        $newTotal = $newSubtotal + $newTax;
        return collect([
            'tax' => $tax,
            'discount' => $discount,
            'code' => $code,
            'newSubtotal' => $newSubtotal,
            'newTax' => $newTax,
            'newTotal' => $newTotal
        ]);
    }

    private function insertIntoOrdersTable($request, $error)
    {
        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'ref_id' => Str::random(6),
            'billing_email' => $request->email,
            'billing_name' => $request->name,
            'billing_address' => $request->address,
            'billing_city' => $request->city,
            'billing_province' => $request->province,
            'billing_postalcode' => $request->postal_code,
            'billing_phone' => $request->phone,
            'billing_name_on_card' => $request->name_on_card,
            'billing_discount' => $this->getNumbers()->get('discount'),
            'billing_discount_code' => $this->getNumbers()->get('code'),
            'billing_subtotal' => $this->getNumbers()->get('newSubtotal'),
            'billing_tax' => $this->getNumbers()->get('newTax'),
            'billing_total' => $this->getNumbers()->get('newTotal'),
            'error' => $error
        ]);

        foreach (Cart::instance('default')->content() as $item) {
            OrderProduct::create([
                'product_id' => $item->model->id,
                'order_id' => $order->id,
                'quantity' => $item->qty
            ]);
        }
        return $order;
    }

    private function decreaseQuantities()
    {
        foreach (Cart::instance('default')->content() as $item) {
            $product = Product::find($item->model->id);
            $product->update(['quantity' => $product->quantity - $item->qty]);
        }
    }

    private function productsAreNoLongerAvailable()
    {
        foreach (Cart::instance('default')->content() as $item) {
            $product = Product::find($item->model->id);
            if ($product->quantity < $item->qty) {
                return true;
            }
        }
        return false;
    }

    public function envoyer_livraison($commande_id)
    {
        $livraison = new Livraison();
        $livraison->order_id = $commande_id;
        $livraison->etat_commande = 0;
        $livraison->save();
        Order::where('id', '=',$commande_id)->update([
            'shipped' => 2
        ]);
        return back();
    }

    public function valider_livraison($livraison_id)
    {
        Livraison::query()->where('id', '=', $livraison_id)->update([
            'etat_commande' => 1
        ]);
        $livraison = Livraison::query()->findOrFail($livraison_id);
        Order::query()->where('id', '=', $livraison->order_id)->update([
            'shipped' => 1
        ]);
        return back();
    }
}
