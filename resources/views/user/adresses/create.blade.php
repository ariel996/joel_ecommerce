@extends('layouts.user')
@section('title', 'Ajouter adresse')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Ajouter adresse</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('adresses') }}">Adresses</a></li>
                            <li class="breadcrumb-item active">Ajouter adresse</li>
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
                                    <a href="{{ route('adresses') }}" class="btn btn-primary">Retour</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <form action="{{ route('stock-adresse') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Destinataire</label>
                                        <input type="text" class="form-control" name="rue" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Code postal</label>
                                        <input type="text" class="form-control" name="code" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Ville</label>
                                        <input type="text" class="form-control" name="ville" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Pays</label>
                                        <input type="text" class="form-control" name="pays" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Envoyer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
