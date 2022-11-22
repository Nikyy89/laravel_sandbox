@extends('layouts.app')

@section('content')

<div class="row text-white">
    <div class="col-md-12 p-0">
        <h1 class="card-header border-dark border-5 profilom">Profilom</h1>
    </div>
</div>

<div class="col-md-12 rounded-xl darker mt-4 text-white">
    <div class="card card_body">
        <div class="card-body">
            <form action="{{ route('profilom.update') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" value="{{$user->name}}" class="form-control input-background">
                </div>

                <div class="form-group mb-3">
                    <label for="">Email</label>
                    <input type="text" name="email" value="{{$user->email}}" class="form-control input-background">
                </div>

                <div class="form-group mb-3">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control input-background">
                </div>

                <div class="form-group mb-3">
                    <label for="">Username</label>
                    <input type="text" name="username" value="{{$user->username}}" class="form-control input-background">
                </div>

                <div class="form-group">
                    <label>Gender : </label>
                    <label for="male">Male</label>
                    <input type="radio" name="gender" value="male" {{isset($user->gender) && ($user->gender== 'male') ? "checked" : ""}}>
                    <label for="female">Female</label>
                    <input type="radio" name="gender" value="female" {{isset($user->gender) && ($user->gender== 'female') ? "checked" : ""}}>
                </div>

                <div class="form-group mb-3">
                    <label for="">Birthdate</label>
                    <input type="date" name="birth_date" value="{{date('Y-m-d', strtotime($user->birth_date))}}" class="form-control input-background">
                </div>

                <div class="form-group mb-3">
                    <label for="">Phone</label>
                    <input type="text" name="phone" value="{{$user->phone}}" class="form-control input-background">
                </div>

                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary">Profilom Mentés</button>
                    <button type="submit" class="btn btn-danger float-end">
                        <a class="text-white" href="{{ route('home') }}">Vissza</a>
                    </button>
                </div>
            </form>
        </div>

        <form method="POST" action="{{route('profilom.image')}}" enctype="multipart/form-data">
            <div class="col-md-12 px-lg-5">
                <div class="card rounded-xl profilom_kep">
                    <div class="card-header text-center font-weight-bold">
                        <h2>Kép feltöltés</h2>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label>Please Select Image</label>
                            <input type="file" id="image" name="image" class="@error('image') is-invalid @enderror form-control">
                            @error('image')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                            <img src="{{asset('/storage/users/'. auth()->user()->image_path)}}" alt="" width="60" height="60" class="rounded-full">
                        </div>
                        <div class="col-md-1 float-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

@endsection

@push('styles')
<style>
    .darker{
        border: 1px solid #ecb21f;
        background-color: black;
        float: right;
        border-radius: 5px;
        padding-left: 40px;
        padding-right: 30px;
        padding-top: 10px;
    }
    .profilom{
        background: #666666;
        text-align: center;
    }
    .profilom_kep{
        background: black;
        color:white;
        border: 1px solid #ecb21f;
    }
    .input-background{
        background: #CECEDF;
    }
    .card_body{
        background: #313131;
    }
</style>
@endpush
