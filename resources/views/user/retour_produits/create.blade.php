@extends('layouts.user')
@section('title', 'Ajouter produit')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Ajouter produit</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('adresses') }}">Retour produit</a></li>
                            <li class="breadcrumb-item active">Ajouter produit</li>
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
                                    <a href="{{ route('retour_produits') }}" class="btn btn-primary">Retour</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <form action="{{ route('post_create_retour_produits') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Code produit</label>
                                        <input type="text" class="form-control" name="code_produit" maxlength="10" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Etat produit</label>
                                        <select class="form-control" name="etat_produit" required>
                                            <option value="Comme neuf">Comme neuf</option>
                                            <option value="En mauvaise etat">En mauvaise etat</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Envoyer</button>
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
