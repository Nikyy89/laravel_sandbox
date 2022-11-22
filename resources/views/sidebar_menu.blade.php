<div id="sidebar" class="border-5 border-dark">
    <header>
        <a href="{{ route('home') }}">Anime Home Page</a>
    </header>
    <ul class="nav">
        <li>
            <a href="{{ route('anime_lists') }}">
                <i class="fa fa-list"></i> Anime Lista
            </a>
        </li>
        <li>
            <a href="{{ route('hirek') }}">
                <i class="fa fa-newspaper-o"></i>Hírek
            </a>
        </li>
        <li>
            <a href="{{ route('kedvencek') }}">
                <i class="fa fa-heart"></i>Kedvencek
            </a>
        </li>
        <li>
            <a href="{{ route('nem_kedvencek') }}">
                <i class="fa fa-heartbeat"></i>Nem Kedvencek
            </a>
        </li>
        <li>
            <a href="{{ route('logs') }}">
                <i class="fa fa-file"></i>Logok
            </a>
        </li>
        <li>
            <a href="{{ route('statistics') }}">
                <i class="fa fa-bar-chart"></i>Statisztika
            </a>
        </li>
        <li>
            <a href="">
                <i class="fa fa-film"></i>Mit nézzek?
            </a>
        </li>

        <li>
            <a href="">
                <i class="fa fa-video-camera"></i>Netflix
            </a>
        </li>

        @if(auth()->user()->roles('admin'))
        <li>
            <a href="{{ route('admin.hirek.index') }}">
                <i class="fa fa-address-book"></i>Összes hírek
            </a>
        </li>
        <li>
            <a href="{{ route('admin.hirek.show') }}">
                <i class="fa fa-plus"></i>Új hír készítése
            </a>
        </li>
        @endif

        @auth
            <li>
            <a href="{{route('profilom')}}">
                <i class="fa fa-user"></i>Profilom
            </a>
            </li>
            <li style="width: 100%">
                <a href="javascript:document.getElementById('logout_form').submit()">
                    <br>
                    <form id="logout_form" method="POST" action="{{ route('logout') }}">
                        <i class="fa fa-sign-out"></i>Logout
                        @csrf
                    </form>
                </a>
            </li>
        @else
            <li>
                <a href="{{ route('login') }}">
                    <i class="fa fa-sign-in"></i>Login
                </a>
            </li>
            <li>
                <a href="{{ route('register') }}">
                    <i class="fa fa-registered"></i>Register
                </a>
            </li>
        @endauth
    </ul>
</div>
