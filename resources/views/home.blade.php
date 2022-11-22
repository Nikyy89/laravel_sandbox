@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 p-0">
        <div class="center text-white">
            <h1 class="card-header border-dark border-5 home">Kezdőlap</h1>
            <p class="home_p">
                <b>Ez egy anime fan page oldal lenne.
                    Ahol különböző animéket tudsz megnézni, csakis akkor ha regisztrálsz. :)
                </b>
                <br>
                @auth
                    <span class="text-xs font-bold uppercase text-white">
                        Üdvözöllek, {{ auth()->user()->name }}
                    </span>
                    <a href="{{route('profilom')}}">
                        <img class="image_home rounded-circle image_align" src="{{asset('/public/users/'. auth()->user()->image_path)}}">
                    </a>
                @endauth
            </p>
        </div>

        <div class="text-white home_anime">
            <b>
                Ajánlott Animék
            </b>
        </div>
        <div class="row row-cols-3 anime_center">
            @foreach($anime_array as $anime)
                <div class="card card_anime">
                    <div class="card-body">
                        <img width="140px" height="200px" class="rounded-3" src="/img/{{ $anime['img'] }}">
                        <a href="{{  $anime['url'] }}" class="btn btn-dark">Go To Anime :)</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @if(session()->has('success'))
        <div class="fixed bg-blue-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
            <p>{{ session('success') }}</p>
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .home {
        background: #666666;
        text-align: center;
    }
    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    .home_p{
        text-align: center;
    }
    .home_anime{
        text-align: center;
    }
    .card_anime{
        background-color:transparent;
        border: none;
    }
    .image_home{
        width: 60px;
        height: 60px;
    }
    .image_align{
        margin-left: 47%;
    }
    .anime_center{
        margin-left: 12%;
    }
</style>
@endpush
