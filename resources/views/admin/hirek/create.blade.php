@extends('layouts.app')

@section('content')

<div class="row text-white">
    <div class="col-md-12 p-0">
        <h1 class="card-header border-dark border-5 admin_new_post">Új hír készítése</h1>
    </div>
</div>
<br>
<div class="create_border p-6 rounded-xl mx-auto text-white bg-black">
    <form method="POST" action="{{ route('admin.hirek.create') }}">
        @csrf
        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700  text-white" for="title">
                Cím
            </label>
            <input class="border border-gray-400 p-2 w-full input_background text-black"
                   type="text"
                   name="title"
                   id="title"
                   value="{{old('title')}}"
                   required
                   autocomplete="title"
                   autofocus
            >
            @error('title')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700 text-white" for="title">
                Tartalom
            </label>
            <textarea class="border border-gray-400 p-2 w-full input_background text-black"
                   type="text"
                   name="content"
                   id="content"
                   value="{{old('content')}}"
                   required
                   autocomplete="content"
                   autofocus
            >
            </textarea>
            @error('content')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600">
            Mentés
        </button>

        <button type="submit" class="bg-blue-500 uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600">
            <a href="{{ route('admin.hirek.index') }}" class="text-white">Vissza</a>
        </button>
    </form>
</div>
@endsection

<style>
    .create_border {
        border: 1px solid #ecb21f;
    }
    .admin_new_post{
        background: #666666 !important;
        text-align: center;
    }
    .input_background{
        background: #CECEDF;
    }
</style>
