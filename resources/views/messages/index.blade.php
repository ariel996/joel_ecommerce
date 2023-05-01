@extends('layouts.user')
@section('title', 'Messages')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Messages</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                            <li class="breadcrumb-item active">Messages</li>
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
                                <h3 class="card-title">Messages reçus</h3>
                                <div class="float-right">
                                    <a href="{{ route('ecrire_message') }}" class="btn btn-primary">Ecrire</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Expediteur</th>
                                        <th>Contenu</th>
                                        <th>Objet</th>
                                        <th>Date</th>
                                        <th>Statut</th>
                                        <th style="width: 40px">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($received_messages as $key => $mms)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $mms->expediteur->name }}</td>
                                            <td>{{ $mms->contenue }}</td>
                                            <td>{{ $mms->objet }}</td>
                                            <td>{{ $mms->date }}</td>
                                            <td>
                                                @if($mms->status == 0)
                                                    <span class="badge bg-warning">
                                                Non lu
                                            </span>
                                                @else
                                                    <span class="badge bg-success">
                                                Lu
                                            </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('reply_message', $mms->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                    {{ __('Répondre') }}
                                                </a>

                                                <a href="{{ route('voire_message', $mms->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                    {{ __('Voir') }}
                                                </a>
                                                <a href="" class="btn btn-danger" onclick="event.preventDefault();
                                document.getElementById('del-commande-{{ $mms->id }}').submit();">Supprimer</a>
                                                <form id="del-commande-{{$mms->id}}" style="display:none;" action="{{ route('delete-message', $mms->id) }}" method="post">
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
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Messages envoyés</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Destinataire</th>
                                        <th>Contenu</th>
                                        <th>Objet</th>
                                        <th>Date</th>
                                        <th>Statut</th>
                                        <th style="width: 40px">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sent_messages as $key => $message)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $message->expediteur->name }}</td>
                                            <td>{{ $message->contenue }}</td>
                                            <td>{{ $message->objet }}</td>
                                            <td>{{ $message->date }}</td>
                                            <td>
                                                @if($message->status == 0)
                                                    <span class="badge bg-warning">
                                                Non lu
                                            </span>
                                                @else
                                                    <span class="badge bg-success">
                                                Lu
                                            </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('voire_message', $message->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                    {{ __('Voir') }}
                                                </a>
                                                <a href="" class="btn btn-danger" onclick="event.preventDefault();
                                document.getElementById('del-message-{{ $message->id }}').submit();">Supprimer</a>
                                                <form id="del-message-{{$message->id}}" style="display:none;" action="{{ route('delete-message', $message->id) }}" method="post">
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
