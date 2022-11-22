@extends('layouts.app')
@section('content')

<div class="row text-white">
    <div class="col-md-12 p-0">
        <h1 class="card-header border-dark border-5 logs_show">Adatbázisban naplózott művletek</h1>
    </div>
</div>

<div class="col-md-12 rounded-xl darker mt-4">
    <div class="card">
        <div class="card-body card_body_logs">
            <div class="form-group mt-3">
                <label for="user_id">User_id</label>
                <input type="text" class="form-control input-background" disabled value="{{ isset($logs->user) ? $logs->user->name : 'Guest' }}">
            </div>
            <div class="form-group mt-3">
                <label for="controller">Controller</label>
                <input type="text" class="form-control input-background" disabled value="{{ $logs->controller }}">
            </div>
            <div class="form-group mt-3">
                <label for="method">Method</label>
                <input type="text" class="form-control input-background" disabled value="{{ old('method', $logs->method) }}">
            </div>
            <div class="form-group mt-3">
                <label for="url">Url</label>
                <input type="text" class="form-control input-background" disabled value="{{ $logs->url }}">
            </div>
            <div class="form-group mt-3">
                <label for="user_agent">User agent</label>
                <input type="text" class="form-control input-background" disabled value="{{ $logs->user_agent }}">
            </div>
            <div class="form-group mt-3">
                <label for="ip_address">IP cím</label>
                <input type="text" class="form-control input-background" disabled value="{{ $logs->ip_address }}">
            </div>
            <br>
            <a href="{{ route('logs') }}" class="btn btn-primary float-end">Bezárás</a>

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .logs_show{
        background: #666666;
        text-align: center;
    }
    .darker{
        border: 1px solid #ecb21f;
        background-color: black;
        float: right;
        border-radius: 5px;
        padding-left: 40px;
        padding-right: 30px;
        padding-top: 10px;
    }
    .input-background{
        background: #CECEDF;
    }
    .card_body_logs{
        background: black;
        color:white;
        border: 1px solid #ecb21f;
    }
</style>
@endpush
