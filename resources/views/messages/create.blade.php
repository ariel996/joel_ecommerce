@extends('layouts.user')
@section('title', 'Ecrire message')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ecrire message</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('messages') }}">Messages</a></li>
                        <li class="breadcrumb-item active">Ecrire message</li>
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
                                <a href="{{ route('messages') }}" class="btn btn-primary">Retour</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <form action="{{ route('poster_message') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Destinataire</label>
                                    <select class="form-control select2" name=destinataire_id style="width: 100%;">
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Objet</label>
                                    <input type="text" class="form-control" name="objet" required>
                                </div>

                                <div class="form-group">
                                    <label>Contenue</label>
                                    <textarea type="text" class="form-control" name="contenue" required></textarea>
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
