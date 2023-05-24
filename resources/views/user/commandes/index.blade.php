@extends('layouts.user')
@section('title', 'Commandes')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Commandes</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                            <li class="breadcrumb-item active">Commandes</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Commandes</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Client</th>
                                        <th>Référence</th>
                                        <th>Adresse</th>
                                        <th>Total</th>
                                        <th>Etat</th>
                                        <th style="width: 40px">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($commandes as $key => $commande)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $commande->billing_email }}</td>
                                        <td>{{ $commande->ref_id }}</td>
                                        <td>{{ $commande->billing_address }}</td>
                                        <td>{{ $commande->billing_total }}€</td>
                                        <td>
                                            @if($commande->shipped == 0)
                                            <span class="badge bg-warning">
                                                En attente
                                            </span>
                                            @else
                                            <span class="badge bg-success">
                                                Livré
                                            </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('voir_commande', $commande->id) }}" class="btn btn-warning">
                                                Voir
                                            </a>
                                            <a href="" class="btn btn-danger" onclick="event.preventDefault();
                                document.getElementById('del-commande-{{ $commande->id }}').submit();">Supprimer</a>
                                            <form id="del-commande-{{$commande->id}}" style="display:none;" action="{{ route('supprimer_commande', $commande->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
@endsection
