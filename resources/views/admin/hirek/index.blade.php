@extends('layouts.app')

@section('content')
<div class="row text-white">
    <div class="col-md-12 p-0">
        <h1 class="card-header border-dark border-5 admin">Saját hírek</h1>
    </div>
</div>
<br>
<table id="admin_posts_table" class="table table-dark darker px-3 py-2">
    <tbody class="rounded-3">
        @foreach ($posts as $post)
            <tr>
                <td>
                    <div class="text-sm font-medium text-white">
                        {{ $post->title }}
                    </div>
                </td>

                <td>
                    <a href="/admin/hirek/index/{{ $post->id }}"
                       class="text-blue-500 hover:text-blue-600">
                        <button class="btn btn-sm text-primary btn-Edit" title="Edit">
                        <i class="fa fa-pencil"></i>
                        </button>
                    </a>
                </td>

                <td>
                    <button class="btn btn-sm text-danger btn-Delete" data-id="{{ $post->id }}" data-toggle="modal"
                            data-target="#deleteModal" title="Törlés">
                    <i class="fa fa-trash"></i>
                    </button>
                </td>

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
            </tr>
        @endforeach
    </tbody>
</table>
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
    .admin{
        background: #666666;
        text-align: center;
    }
</style>
@endpush

@push('scripts')
    <script>
        $(function(){
            // Delete a record
            $('#admin_posts_table').on('click', 'button.btn-Delete', function (e) {
                window.delete_row_id = $(e.currentTarget).data('id');
                $('#deleteModal').show();
            });

            $('#deleteModal').on('click', 'button.close_modal', function (e) {
                $('#deleteModal').hide();
            });

            $('#deleteModal').on('click', 'button.btn-primary', function (e) {
                console.log(window.delete_row_id);
                axios.delete('/admin/hirek/' + window.delete_row_id + '/delete')
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
