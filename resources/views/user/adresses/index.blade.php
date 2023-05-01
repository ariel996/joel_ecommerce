@extends('layouts.user')
@section('title', 'Adresses')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Adresses</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                            <li class="breadcrumb-item active">Adresses</li>
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
                                <h3 class="card-title">Adresses</h3>
                                <div class="float-right">
                                    <a href="{{ route('ajouter-adresse') }}" class="btn btn-primary">Ajouter adresse</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Rue</th>
                                        <th>Code</th>
                                        <th>Ville</th>
                                        <th>Pays</th>
                                        <th style="width: 40px">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($adresses as $key => $adresse)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $adresse->rue }}</td>
                                            <td>{{ $adresse->code }}</td>
                                            <td>{{ $adresse->ville }}</td>
                                            <td>{{ $adresse->pays }}</td>
                                            <td>
                                                <a href="{{ route('modifier-adresse', $adresse->id) }}" class="btn btn-info">Modifier</a>
                                                <a href="" class="btn btn-danger" onclick="event.preventDefault();
                                document.getElementById('del-commande-{{ $adresse->id }}').submit();">Supprimer</a>
                                                <form id="del-commande-{{$adresse->id}}" style="display:none;" action="{{ route('delete-adresse', $adresse->id) }}" method="post">
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
