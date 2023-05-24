@extends('layouts.user')
@section('title', 'Voire message')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Voire message</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('messages') }}">Messages</a></li>
                            <li class="breadcrumb-item active">Voire message</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="float-right">
                                    <a href="{{ route('commandes') }}" class="btn btn-primary">Retour</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <h3>commande: </h3>
                                <li>Référence : {{ $order->ref_id }}</li>
                                <li>email : {{ $order->billing_email }}</li>
                                <li>nom : {{ $order->billing_name }}</li>
                                <li>Total : {{ $order->billing_total }} €</li>
                                <h4>produits: </h4>
                                @foreach ($order->products as $product)
                                    {{ $product->name }} : {{ $product->pivot->quantity }}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
