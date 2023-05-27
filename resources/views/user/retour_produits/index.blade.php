@extends('layouts.user')
@section('title', 'Retour produit')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Retour produit</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                            <li class="breadcrumb-item active">Retour produit</li>
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
                                <h3 class="card-title">Retour produit</h3>
                                <div class="float-right">
                                    <a href="{{ route('create_retour_produits') }}" class="btn btn-primary">Ajouter produit</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Reference commande</th>
                                        <th>Etat produit</th>
                                        <th>Etat requête</th>
                                        <th style="width: 40px">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($retour_produits as $key => $retour_produit)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $retour_produit->reference_commande }}</td>
                                            <td>{{ $retour_produit->etat_produit }}</td>
                                            <td>
                                                @if ($retour_produit->accepted == 0)
                                                    <span class="badge badge-warning">En cours de traitement</span>
                                                @elseif ($retour_produit->accepted == 2)
                                                    <span class="badge badge-danger">Refusée</span>
                                                @else
                                                    <span class="badge badge-success">Acceptée</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('edit_retour_produits', $retour_produit->id) }}" class="btn btn-info">Modifier</a>
                                                <a href="" class="btn btn-danger" onclick="event.preventDefault();
                                document.getElementById('del-commande-{{ $retour_produit->id }}').submit();">Supprimer</a>
                                                <form id="del-commande-{{ $retour_produit->id }}" style="display:none;" action="{{ route('delete_retour_produit', $retour_produit->id) }}" method="post">
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
