<form method="POST" action="{{route('hirek.dislike', ['post_id' => $post_id])}}">
    @csrf
    <div class="dislikes">
        <button class="btn_down"
                id="dislike"
                name="dislike"
                type="submit"
                @if($isDisliked > 0) disabled @endif>
            {{$dislikesCount}} &nbsp |
            <i class="fa fa-thumbs-down" aria-hidden="true"></i>
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
