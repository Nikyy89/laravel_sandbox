<form method="POST" action="{{route('hirek.unfavourites', ['post_id' => $post_id])}}">
    @csrf
    <div class="unfavourites">
        <button class="btn_up btn btn-outline-primary"
                id="unfavourite"
                name="unfavourite"
                type="submit"
                style="font-size:20px"
                @if($isUnfavourited > 0) disabled @endif>
            <i class="fa fa-heartbeat" aria-hidden="true"></i>
        </button>
    </div>
</form>

@push('script')
<script>
    var button = document.getElementById("btn");
    button.addEventListener("click", onClick);

    function onClick() {
        console.log("Clicked");
        button.disabled = true;
    }
</script>
@endpush
