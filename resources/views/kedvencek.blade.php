@extends('layouts.app')

@section('content')

<div class="row text-white">
    <div class="col-md-12 p-0">
        <h1 class="card-header border-dark border-5 kedvenc">Kedvencek</h1>
    </div>
</div>

@foreach($kedvencek as $kedvenc)
    <div class="row ps-4 pe-4">
        <div id="kedvenc_div" class="col-md-12 text-justify darker mt-4">
            <div class="kedvencek_div">
                <h5 class="text-white">{{$kedvenc->posts->title}}</h5>
                <p>{{$kedvenc->posts->content}}</p>
                <p>
                    <b>
                        Akinek a kedvence:
                        <u>{{$kedvenc->user->name}}</u>
                    </b>
                </p>
            </div>
            <div class="col-md-1 float-right">
                <button class="btn_up btn btn-outline-primary btn-Delete" data-id="{{$kedvenc->id}}">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
@endforeach

<div id="deleteModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Törlés</h5>
                <button type="button" class="close_modal close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Biztos benne, hogy törli ezt a tételt?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="close_modal btn btn-secondary" data-dismiss="modal">Mégse</button>
                <button type="button" class="btn btn-primary">Törlés</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .kedvenc{
        background: #666666;
        text-align: center;
    }
    .kedvencek_div{
        width: 80%;
        text-align: left;
    }
    .darker{
        border: 1px solid #ecb21f;
        background-color: black;
        float: right;
        border-radius: 5px;
        padding-left: 40px;
        padding-right: 30px;
        padding-top: 10px;
        padding-bottom: 10px;
    }
</style>
@endpush

@push('scripts')
<script>
    $(function(){
        // Delete a record
        $('#kedvenc_div').on('click', 'button.btn-Delete', function (e) {
            window.delete_row_id = $(e.currentTarget).data('id');
            $('#deleteModal').show();
        });

        $('#deleteModal').on('click', 'button.close_modal', function (e) {
            $('#deleteModal').hide();
        });

        $('#deleteModal').on('click', 'button.btn-primary', function (e) {
            axios.delete('/kedvencek/' + window.delete_row_id + '/delete')
                .then(function(response) {
                    if (response.data.success) {
                        toastr.success('Sikeresen töröltük a hírt.', 'Törlés');
                    } else {
                        toastr.error('Nincs jogosultsága a törléshez!', 'Törlés');
                    }

                    setTimeout(function() {
                        window.location.reload(true);
                    }, 2000);
                })
                .catch((response) => toastr.error(response.data.message, 'Hiba!'));

            $('#deleteModal').hide();
        });
    });
</script>
@endpush
