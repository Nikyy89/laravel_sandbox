@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 p-0">
        <div class="center text-white">
            <h1 class="card-header border-dark border-5 welcome">Kezdőlap</h1>
            <p class="welcome_p">
                <b>Ez egy anime fan page oldal lenne.
                    Ahol különböző animéket tudsz megnézni, csakis akkor ha regisztrálsz. :)
                </b>
            </p>
        </div>
        <div class="text-white welcome_anime">
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
</div>
@if(session()->has('success'))
    <div class="fixed bg-blue-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
        <p>{{ session('success') }}</p>
    </div>
@endif
@endsection

@push('styles')
<style>
    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    .welcome{
        background: #666666;
        text-align: center;

    }
    .anime_center{
        margin-left: 12%;
    }
    .welcome_anime{
        text-align: center;
    }
    .card_anime{
        background-color:transparent;
        border: none;
    }
    .welcome_p{
        text-align: center;
    }
</style>
@endpush
