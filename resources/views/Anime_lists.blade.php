@extends('layouts.app')

@section('content')

<div class="row text-white">
    <div class="col-md-12 p-0">
        <h1 class="card-header border-dark border-5 anime_lista">Anime Lista A-Z</h1>
    </div>
</div>
<br>
<!-- Search begin-->
<div class="col-md-12">
    <div class="position-relative flex-column align-items-center search px-3 py-2">
        <form method="GET" action="{{route('anime_lists')}}">
            <input type="text"
                   name="search"
                   placeholder="Search"
                   class="rounded-3 text-sm-center"
                   value="{{ request('search') }}">
        </form>
    </div>
</div>
<!-- search end -->

<div class="row alpha-search">
    @foreach(range('A','Z') as $anime_alphabetical)
    <div class="col as-item rounded-3">
        <a href="{{ route('anime_lists', ['src' => $anime_alphabetical ]) }}">{{ $anime_alphabetical }}</a>
    </div>
    @endforeach
</div>

<div class="row row-cols-sm-3 row_col">
    @foreach($anime_lists as $anime_list)
        <div class="card anime_lista_card">
            <div class="card-body">
                <img class="rounded-3 anime_lista_kep" src="{{ $anime_list['image_path'] }}">
                <a href="{{  $anime_list['anime_url'] }}" class="btn btn-dark">{{ $anime_list['anime_name'] }}</a>
            </div>
        </div>
    @endforeach
</div>
@endsection

@push('styles')
<style>
    .alpha-search {
        clear: both;
        margin-left: auto !important;
        margin-right: auto !important;
        padding: 10px;
        max-width: 800px;
    }

    .search{
        text-align: center;
    }

    .as-item a {
        text-decoration: none;
    }

    .as-item {
        max-width: 30px !important;
        background-color: #ffffff;
        padding: 5px;
        border: solid 1px #b0b0b0;
        border-right: none;
    }
    .anime_lista{
        background: #666666;
        text-align: center;
    }
    .anime_lista_kep{
        width: 140px;
        height: 200px;
    }
    .row_col{
        margin-left: 10%;
    }
    .anime_lista_card{
        width: 18rem;
        background-color:transparent;
        border: none;
    }
</style>
@endpush
