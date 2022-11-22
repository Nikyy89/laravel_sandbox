<form method="POST" action="{{route('hirek.like', ['post_id' => $post_id])}}">
    @csrf
    <div class="likes">
        <button class="btn_up"
                id="like_{{$post_id}}"
                name="like"
                type="submit"
                @if($isLiked > 0) disabled @endif>
            {{$likesCount}} &nbsp |
            <i class="fa fa-thumbs-up" aria-hidden="true"></i>
        </button>
    </div>
</form>

@push('styles')
<style>
    button i{
        transition: .3s all ease;
    }
    .btn_up.clicked,.btn_up:hover i{
        color: darkblue;
    }
    .btn_down.clicked,.btn_down:hover i{
        color: darkred;
    }
    .fa-thumbs-up:before{
        display: flex;
        margin-left: 4px;
        margin-bottom: 3px;

    }
    .fa-thumbs-down:before {
        display: flex;
        margin-left: 4px;
    }
</style>
@endpush
