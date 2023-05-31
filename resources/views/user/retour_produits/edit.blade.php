@extends('layouts.user')
@section('title', 'Modifier retour produit')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Modifier retour produit</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('adresses') }}">Retour produit</a></li>
                            <li class="breadcrumb-item active">Modifier retour produit</li>
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
                                <form action="{{ route('post_update_retour_produits', $retour_produit->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label>Code produit</label>
                                        <input type="text" class="form-control" value="{{ $retour_porduit->code_produit }}" maxlength="10" name="code_produit" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Etat produit</label>
                                        <select class="form-control" name="etat_produit" required>
                                            <option value="Comme neuf" {{ $retour_produit->etat_produit == "Comme neuf" ? 'selected' : '' }}>Comme neuf</option>
                                            <option value="En mauvaise etat" {{ $retour_produit->etat_produit == "En mauvaise etat" ? 'selected' : '' }}>En mauvaise etat</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Mettre à jour</button>
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
