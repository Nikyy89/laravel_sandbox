@extends('layouts.app')

@section('content')

<div class="row text-white">
    <div class="col-md-12 p-0">
        <h1 class="card-header border-dark border-5 logs">Adatbázisban naplózott művletek</h1>
    </div>
</div>

<!-- Search begin-->
<div class="col-md-12 logs_search">
    <div class="position-relative flex-column align-items-center search px-3 py-2">
        <form method="GET" action="{{route('logs')}}">
            <input type="text"
                   name="search"
                   placeholder="Search"
                   class="rounded-3 text-sm-center"
                   value="{{ request('search') }}">
        </form>
    </div>
</div>
<!-- search end-->
<table id="system_log_table" class="table table-dark px-3 py-2 darker">
    <tbody class="rounded-3">
        <tr>
            <td>ID</td>
            <td>Dátum</td>
            <td>Típus</td>
            <td>Felhasználó</td>
            <td>Vezérlő</td>
            <td>Metódus</td>
            <td>Műveletek</td>
        </tr>
        @foreach($logs as $log)
        <tr>
            <td>{{$log->id}}</td>
            <td>{{$log->created_at}}</td>
            <td>{{$log->log_level}}</td>
            <td>{{$log->user->name}}</td>
            <td>{{$log->controller}}</td>
            <td>{{$log->method}}</td>
            <td>
                <button class="btn btn-light text-primary btn-Show" title="Mutasd">
                    <i class="fa fa-eye"></i>
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="row">
    <div class="col-md-10 text-danger">
        <ul class="pagination">
            <li class="page-item">
                {{ $logs->links() }}
            </li>
        </ul>
    </div>
</div>

@endsection

@push('styles')
<style>
    .logs{
        background: #666666;
        text-align: center;
    }
    .logs_search{
        margin-left: 38%;
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
    </style>
@endpush

@push('scripts')
<script>
    $(function(){
        // Show record
        $('#system_log_table').on('click', 'button.btn-Show', function (e) {
            e.preventDefault();

            let row_id = $(this).closest('tr').children('td:first').text();
            window.location.href = '/logs/' + row_id + '/show';
        });
    });
</script>
@endpush
