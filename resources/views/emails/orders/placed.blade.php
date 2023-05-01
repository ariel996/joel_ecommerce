@component('mail::message')
votre commande a été énvoyer avec success!

<h3>commande: </h3>
<li>email : {{ $order->billing_email }}</li>
<li>nom : {{ $order->billing_name }}</li>
<li>Total : {{ $order->billing_total }} €</li>
<h4>produits: </h4>
@foreach ($order->products as $product)
    {{ $product->name }} : {{ $product->pivot->quantity }}
@endforeach

@component('mail::button', ['url' => config('app.url')])
page d'acceuil
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
