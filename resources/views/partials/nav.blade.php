<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            GALERIE D'ARTS AFRICAINS
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ request()->route()->getName() == 'shop.index' ? 'active': '' }}">
                    <a class="nav-link" href="{{ route('shop.index') }}">Boutique</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->route()->getName() == 'cart.index' ? 'active': '' }}" href="{{ route('cart.index') }}">
                        panier
                        @if (Cart::instance('default')->count() > 0)
                            <span class="badge badge-primary">
                    {{ Cart::instance('default')->count() }}
                </span>
                        @endif
                    </a>
                </li>
            </ul>
            <div>
                <input id="search" name="recherche" style="width:400px; margin:0;" id="search" class="form-control custom-border" placeholder="Search" aria-label="Search">
            </div>
        </div>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('connexion') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('creer un compte') }}</a>
            </li>
            @endif
            @else
            @if (auth()->user()->can('browse_admin'))
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/admin') }}">administration</a>
            </li>

            @endif

            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('home') }}">
                        {{ __('Tableau de bord') }}
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                        {{ __('Deconnexion') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>
    </div>
    </div>
</nav>
<div id="cont">
    <ul style="height:4em">

    </ul>
</div>
<script>
    var searcher = $('#search')
    searcher.on('keypress', function(e) {
        if (e.which == 13) {
            if (searcher.val().length > 2) {
                location.href = '/shop/search/' + searcher.val();
            } else {
                alert('Minimun query length is 3');
            }
        }
    });

</script>
