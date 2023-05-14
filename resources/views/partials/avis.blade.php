<div class="suggestions">
    <div class="container" style="padding-top: 3em">
        <h3 class="lead" style="margin-bottom: 2em">Donnez votre avis</h3>
        <!-- start products row -->
        <div class="row">
            <ul class="list-group">
                @foreach ($avis as $av)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $av->commentaire }} <i>{{ $av->created_date->diffForHumans() }}</i>
                    </li>
                @endforeach
            </ul>
        </div>
        @auth
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('post_avis') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" name="commentaire" required  cols="3" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Envoyer mon commentaire</button>
                    </div>
                </form>
            </div>
        </div>
        @endauth
        <!-- end products row -->
    </div>
</div>
<!--  end suggestions -->
