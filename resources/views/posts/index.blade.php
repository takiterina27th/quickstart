@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-header">Dashboard</div> -->

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                    @auth
                    <a href="{{ route('posts.create') }}">
                      <button type="submit" class="btn btn-primary">
                      投稿する
                      </button>
                    </a>
                    @endauth

                    <form method="GET" action="{{ route('posts.index') }}" class="d-flex">
                      <input class="form-control me-2" name="search" type="search" placeholder="検索する" aria-label="Search">
                      <button class="btn btn-outline-success" type="submit" style="margin-left: 12px;">Search</button>
                    </form>
                    </div>
                    </nav>
                      
                    <table class="table">
                      
                    </table>

                    

                    <div class="row row-cols-1 row-cols-md-3 g-4">
                      @foreach($posts as $post)
                      <div class="col mb-4">
                        <div class="card h-100">
                          <a href="{{ route('posts.show', ['id' => $post->id]) }}">
                          @if($post->image == null)
                            <img class="card-img-top" src="/storage/no-image.png" >
                          @else
                            <img class="card-img-top" src="{{$post->image}}" >
                          @endif
                          </a>
                          <div class="card-body">
                            <h5 class="card-title">{{ Str::limit($post->title, 20, '(…)' )}}</h5>
                            <p class="card-text">{{ Str::limit($post->content, 60, '(…)' )}}</p>
                          </div>
                          <div class="card-footer">
                            <small class="text-muted">{{ $post->user->name}}</small>
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </div>
                    
                    <!-- <div class="card-columns">
                    @foreach($posts as $post)
                    
                      <div class="card">
                        <a href="{{ route('posts.show', ['id' => $post->id]) }}">
                        @if($post->image == null)
                          <img class="card-img-top" src="/storage/no-image.png" >
                        @else
                          <img class="card-img-top" src="/storage/{{$post->image}}" >
                        @endif
                        </a>
                        <div class="card-body">
                          <h5 class="card-title">{{ $post->title }}</h5>
                          <p class="card-text">{{ Str::limit($post->content, 60, '(…)' )}}</p>
                        </div>
                        <div class="card-footer">
                          
                          <small class="text-muted">{{ $post->created_at}}</small>
                        </div>
                      </div>
                    
                    @endforeach
                    </div> -->

                    {{ $posts->appends(request()->input())->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
