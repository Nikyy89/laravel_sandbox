<div class="col-md-12">
    <form method="POST" action="{{route('hirek.comment', ['posts_id' => $posts_id])}}"
          class="border border-dark rounded-3 new_comment_container comment_show" id="new_comment_{{$posts_id}}">

        @csrf
        <header class="flex items-center rounded-3">
            <img src="http://i.pravatar.cc/60?u" class="rounded-circle comment_img">
            <h2 class="ml-4 text-white">Szólj hozzá!</h2>
        </header>
        <br>
        <textarea name="comment" class="w-full text-sm focus:outline-none focus:ring rounded-3" style="background: azure" rows="5"
                  placeholder="Mi jár a fejedben? :)">
        </textarea>
        <div class="flex justify-end pt-6 border-gray-200">
            <button type="submit"
                    class="bg-blue-500 text-white uppercase text-xs py-2 px-10 rounded-2 hover:bg-blue-700">
                POST
            </button>
        </div>
    </form>
</div>

@push('styles')
<style>
    .new_comment_container {
        display: none;
        background-color: #262626;
    }
    .comment_img{
        width: 40px;
        height: 40px;
    }
    .comment_show{
        margin-right: -500px;
        padding: 20px;
    }
</style>
@endpush
