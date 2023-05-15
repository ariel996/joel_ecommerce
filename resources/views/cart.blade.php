@extends('layouts.app')
@section('title', 'Cart')
@section('content')

<!-- start page content -->
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            @if (Cart::instance('default')->count() > 0)
            <h3 class="lead mt-4">{{ Cart::instance('default')->count() }} articles dans le panier</h3>
            <table class="table table-responsive">
                <tbody>
                    @foreach (Cart::instance('default')->content() as $item)
                        <tr>
                            <td>
                                <a href="{{ route('shop.show', $item->model->slug) }}">
                                    <img src="{{ asset('storage/'.$item->model->image) }}" height="100px" width="100px">
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('shop.show', $item->model->slug) }}" class="text-decoration-none">
                                    <h3 class="lead light-text">{{ $item->model->name }}</h3>
                                    <p class="light-text">{{ $item->model->details }}</p>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('cart.destroy', [$item->rowId, 'default']) }}" method="POST" id="delete-item">
                                    @csrf()
                                    @method('DELETE')
                                </form>
                                <form action="{{ route('cart.save-later', $item->rowId) }}" method="POST" id="save-later">
                                    @csrf()
                                </form>
                                <button class="cart-option btn btn-danger btn-sm custom-border" onclick="
                                    document.getElementById('delete-item').submit();">
                                    supprimer
                                </button>
                                <button class="cart-option btn btn-success btn-sm custom-border" onclick="
                                document.getElementById('save-later').submit();">
                                    Enregistrer pour plus tard
                                </button>
                            </td>
                            <!-- <td class="">
                                <select class='quantity' data-id='{{ $item->rowId }}' data-productQuantity='{{ $item->model->quantity }}'>
                                    @for ($i = 1; $i < 10; $i++)
                                        <option class="option" value="{{ $i }}" {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </td> -->
                            <td>{{ $item->subtotal }}€</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <div class="summary">
                <div class="row">
                    <div class="col-md-8">
                        <p class="light-text">
                        Nous vous remercions d'avoir choisi notre site Galerie d'art africain pour vos achats en ligne. Avant de finaliser votre commande, veuillez suivre les étapes ci-dessous pour passer à la caisse:

                        </p>
                    </div>
                    <div class="col-md-3 offset-md-1">
                        <!-- <p class="text-right light-text">Subtotal &nbsp; &nbsp;${{ Cart::subtotal() }}</p> -->
                        <p class="text-right light-text">Tax(21%) &nbsp; &nbsp; ${{ Cart::tax() }}</p>
                        <p class="text-right">Total &nbsp; &nbsp; ${{ Cart::total()}}</p>
                    </div>
                </div>
            </div>
            <div class="cart-actions">
                <a class="btn custom-border-n" href="{{ route('shop.index') }}">Poursuivre les achats</a>
                <a class="float-right btn btn-success custom-border-n" href="{{ route('checkout.index') }}">
                Passer à la caisse
                </a>
            </div>
            @else
            <div class="alert alert-info">
                <h4 class="lead">Aucun article dans le panier <a class="btn custom-border-n" href="{{ route('shop.index') }}">Continue shopping</a></h4>
            </div>
            @endif
            <hr>
            @if (Cart::instance('saveForLater')->count() > 0)
                <h3 class="lead">{{ Cart::instance('saveForLater')->count() }} article  sauvegardé pour plus tard</h3>
                <table class="table table-responsive">
                    <tbody>
                        @foreach (Cart::instance('saveForLater')->content() as $item)
                            <tr>
                                <td>
                                    <a href="{{ route('shop.show', $item->model->slug) }}">
                                        <img src="{{ asset('storage/'.$item->model->image) }}" height="100px" width="100px"></td>
                                    </a>
                                <td>
                                    <a href="{{ route('shop.show', $item->model->slug) }}" class="text-decoration-none">
                                        <h3 class="lead light-text">{{ $item->model->name }}</h3>
                                        <p class="light-text">{{ $item->model->details }}</p>
                                    </a>
                                </td>
                                <td>
                                    <button class="cart-option btn btn-danger btn-sm custom-border" onclick="
                                        document.getElementById('delete-form').submit();">
                                        supprimer
                                    </button>
                                    <button class="cart-option btn btn-success btn-sm custom-border" onclick="
                                    document.getElementById('add-form').submit();">
                                        Ajouter au panier
                                    </button>
                                </td>
                                <td>{{ $item->model->price }} €</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <form action="{{ route('cart.destroy', [$item->rowId, 'saveForLater']) }}" method="POST" id="delete-form">
                        @csrf()
                        @method('DELETE')
                    </form>
                    <form action="{{ route('cart.add-to-cart', $item->rowId) }}" method="POST" id="add-form">
                        @csrf()
                    </form>

                </table>
            @else
                <div class="alert alert-primary" style="margin:2em">
                    <li>Pas d'articles enregistrés pour plus tard</li>
                </div>
            @endif
        </div>
    </div>
</div>
@include('partials.might-like')
<!-- end page content -->

@endsection

@section('scripts')

<script type="text/javascript">

$(document).ready(function () {
    $('.quantity').on('change', function() {
        const id = this.getAttribute('data-id')
        console.log(id)
        const productQuantity = this.getAttribute('data-productQuantity')
        axios.patch('/cart/' + id, {quantity: this.value, productQuantity: productQuantity})
            .then(response => {
                console.log(response)
                window.location.href = '{{ route('cart.index') }}'
            }).catch(error => {
                window.location.href = '{{ route('cart.index') }}'
            })
    });
});

</script>

@endsection
