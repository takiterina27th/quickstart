@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="alert alert-primary" role="alert">
                      <span>タイトル：</span>
                      {{ $post->title}}
                    </div>
                    <div class="mb-3">
                      @if($post->image == null)
                        <img src="/storage/no-image.png" class="img-responsive d-block mx-auto" style="max-width: 100%; height: auto; width /***/:auto;">
                      @else
                        <img src="/storage/{{$post->image}}" class="img-responsive d-block mx-auto" style="max-width: 100%; height: auto; width /***/:auto;">
                      @endif
                    </div>
                    
                    <div class="border-bottom pb-2">{{ $post->content}}</div>
                    <div class="border-bottom pt-2 pb-2">
                    
                    <span class="ml-3">投稿日：：</span>{{ $post->created_at}}
                    </div>
               
                    
{{-- ログインしていたら表示する  @authだけでもできるが一応二重に --}} 

                    @auth
                        @if( ( $post->user_id ) === ( Auth::user()->id ) )
                          <div class="d-flex">
                            <a href="{{ route('posts.edit', ['id' => $post->id])}}">
                              <br>
                              <input class="btn btn-primary" type="submit" value="変更する">
                            </a>
                            <div class="ml-3">
                              <form method="POST" action="{{ route('posts.destroy', ['id' => $post->id])}}" id="delete_{{ $post->id}}">
                                @csrf
                                <br>
                                <a href="#" class="btn btn-danger" data-id="{{ $post->id }}" onclick="deletePost(this); ">削除する</a>
                              </form>
                            </div>
                          </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function deletePost(e) {
  'use strict';
  if (confirm('本当に削除してもいいですか？')) {
    document.getElementById('delete_' + e.dataset.id). submit();
  }
}
</script>

@endsection
