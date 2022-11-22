@extends('layouts.app')

@section('content')
    <div class="row text-white hirek_cime">
        <div class="col-md-12 p-0">
            <h1 class="text-white card-header border-dark border-5 hirek">Hírek</h1>
        </div>
    </div>

    <!-- Search begin-->
    <div class="col-md-12 hirek_search">
        <div class="position-relative flex-column align-items-center search px-3 py-2">
            <form method="GET" action="{{route('hirek')}}">
                <input type="text"
                       name="search"
                       placeholder="Search"
                       class="rounded-3 text-sm-center"
                       value="{{ request('search') }}">
            </form>
        </div>
    </div>
    <!-- search end-->

    <div class="col-md-12">
        @foreach($hirek as $hir)
            <div class="row text-justify darker mt-4">
                <div>
                    <h5 style="color:white"> {{ $hir->title }} </h5>
                    <p>{{ $hir->content }}</p>
                    <p><b>Created by: <u>{{ $hir->user->name }}</u></b>
                    </p>
                </div>
                <br>
                <div class="col-md-1">
                    <button class="btn btn-block btn-primary new_comment_btn hirek_comment_btn" id="new_comment_btn_{{$hir->id}}">
                        <i class="fa fa-comment" aria-hidden="true"></i>
                    </button>
                    <br>

                    <div class="row">
                        @include('new_comment', ['posts_id' => $hir->id])
                    </div>
                </div>

                <div class="col-md-1">
                    @include('favourite', ['post_id' => $hir->id, 'isFavourited' => $hir->favourites()->where('user_id', Auth::user()->id)->count()])
                </div>

                <div class="col-md-1">
                    @include('unfavourite', ['post_id' => $hir->id, 'isUnfavourited' => $hir->unfavourites()->where('user_id', Auth::user()->id)->count()])
                </div>

                <div class="col-md-2 rounded-3
                {{$hir->likes()->where('user_id', Auth::user()->id)->count() > 0 ? 'text-blue-500' : 'text-gray-500'}}">
                    @include('like', ['post_id' => $hir->id, 'likesCount' => $hir->likes()->count(),
                             'isLiked' => $hir->likes()->where('user_id', Auth::user()->id)->count()])
                </div>

                <div class="col-md-2 hirek_dislike rounded-3
                {{$hir->dislikes()->where('user_id', Auth::user()->id)->count() > 0 ? 'text-red-500' : 'text-gray-500'}}">
                    @include('dislike', ['post_id' => $hir->id, 'dislikesCount' => $hir->dislikes()->count(),
                             'isDisliked' => $hir->dislikes()->where('user_id', Auth::user()->id)->count()])
                </div>
                php
                <div id="fb-root" class="col-md-1 rounded-3" style="margin-right: -150px;"></div>

                <div class="fb-like col-md-1 rounded-3 text-white" data-href="https://developers.facebook.com/docs/plugins/"
                     data-width="" data-layout="standard" data-action="like" data-size="large" data-share="true">
                </div>

                <div class="col-md-12">
                    @foreach($hir->comments as $comment)
                        <div class="comment mt-4 text-justify new_comment pt-1">
                            <img src="http://i.pravatar.cc/60?u={{$comment->user_id}}" alt="" width="60" height="60" class="rounded-xl">
                            <p>{{ $comment->comment }}</p>
                            <p> Posted: <time>{{ Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</time>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-md-10 text-danger">
            <ul class="pagination">
                <li class="page-item">
                    {{ $hirek->links() }}
                </li>
            </ul>
        </div>
    </div>

@endsection

@push('styles')
<style>
    .new_comment{
        width: 80%;
        text-align: left;
    }

    .hirek_dislike {
        margin-left: -6%;
    }

    .hirek_cime{
        text-align: center;
    }

    .hirek_search{
        margin-left: 38%;
    }

    .hirek_comment_btn{
        width: 7%;
        text-align: left;
    }

    .hirek{
        background: #666666;
    }

    .favourite_hirek{
        float: right;
        margin-right: 530px;
    }

    .darker{
        border: 1px solid #ecb21f;
        background-color: black;
        float: right;
        border-radius: 5px;
        padding-left: 40px;
        padding-right: 30px;
        padding-top: 10px;
        margin-left: 2%;
        margin-right: 2%;
    }

    .comment{
        border: 1px solid rgba(16, 46, 46, 1);
        background-color: rgba(16, 46, 46, 0.973);
        float: left;
        border-radius: 5px;
        padding-left: 40px;
        padding-right: 30px;
        padding-top: 10px;

    }
    .comment h4,.comment span,.darker h4,.darker span{
        display: inline;
    }

    .comment p,.comment span,.darker p,.darker span{
        color: rgb(184, 183, 183);
    }

    .new_comment_btn {
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        font-size: 20px;
        color: #818181;
        display: block;
        border: none;
        background: none;
        width:100%;
        text-align: left;
        cursor: pointer;
        outline: none;
    }

    /* On mouse-over */
    .new_comment_btn:hover {
        color: #f1f1f1;
    }

    .fa {
        font-size: 15px;
        cursor: pointer;
        user-select: none;
    }

    .fa:hover {
        color: darkblue;
    }
</style>
@endpush

<script>
    window.onload = () => {
        let new_comment_btn = document.getElementsByClassName('new_comment_btn');
        var j;
            for (j = 0; j < new_comment_btn.length; j++) {
                new_comment_btn[j].addEventListener("click", function(e) {
                    let form_id = e.target.parentNode.id.substring(16);
                    let form_1 = document.getElementById('new_comment_' + form_id)
                    if(form_1.style.display === "block"){
                        form_1.style.display = "none";
                    }
                    else {
                        form_1.style.display = "block";
                    }
                });
            }
    }
</script>

