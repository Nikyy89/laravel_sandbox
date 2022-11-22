<form method="POST" action="{{route('hirek.favourites', ['post_id' => $post_id])}}">
    @csrf
    <div class="favourites">
        <button class="btn_up btn btn-outline-primary"
                id="favourite"
                name="favourite"
                type="submit"
                style="font-size:20px"
                @if($isFavourited > 0) disabled @endif>
            <i class="fa fa-heart" aria-hidden="true"></i>
        </button>
    </div>
</form>
