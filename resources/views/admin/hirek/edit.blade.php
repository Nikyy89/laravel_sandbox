@extends('layouts.app')

@section('content')
<div class="row text-white">
    <div class="col-md-12 p-0">
        <h1 class="card-header admin_szerkesztes border-dark border-5">Hírek szerkesztése</h1>
    </div>
</div>
<br>
<div class="darker text-white">
    <form method="POST" action="{{ route('admin.hirek.edit', ['post' => $post->id]) }}">
            @csrf
            @method('PUT')
        <div class="border border-gray-200 p-6 rounded-xl mx-auto text-white">
            <h1 class="text-lg font-bold mb-4">Hírek szerkesztése:  {{ $post -> title }}</h1>

            <div class="mb-6">
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700  text-white" for="title">
                    Cím
                </label>
                <input class="border border-gray-400 p-2 w-full text-black rounded-3 input_background"
                       type="text"
                       name="title"
                       id="title"
                       value="{{$post -> title}}"
                       required
                >
                @error('title')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700 text-white" for="title">
                    Tartalom
                </label>
                <textarea class="border border-gray-400 p-2 w-full text-black rounded-3 input_background"
                       name="content"
                       id="content"
                       value="{{$post -> content}}"
                       required>
                    {{$post -> content}}
                </textarea>
                @error('content')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white uppercase font-semibold text-xs py-2
            px-10 rounded-2xl hover:bg-blue-600">
                Update
            </button>

            <button type="submit" class="bg-blue-500 uppercase font-semibold text-xs py-2
            px-10 rounded-2xl hover:bg-blue-600">
                <a href="{{ route('admin.hirek.index') }}" class="text-white">Vissza</a>
            </button>
        </div>
    </form>
</div>
@endsection
<style>
    .darker{
        border: 1px solid #ecb21f;
        background-color: black;
        border-radius: 5px;
        padding-left: 40px;
        padding-right: 30px;
        padding-top: 10px;
    }
    .admin_szerkesztes{
        background: #666666;
        text-align: center;
    }
    .admin_textarea{
        resize: none;
        overflow-y: hidden;
    }
</style>
