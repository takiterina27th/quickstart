@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                      <ul>
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                    @endif
               
                    <form method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
                    @csrf
                      <label for="title">タイトル</label>
                      <br>
                      <input type="text" name="title" id="title">
                      <br>
                      <label for="content">内容</label>
                      <br>
                      <textarea name="content" id="content" cols="50" rows="5"></textarea>
                      <br>
                      <input type="file" name="image">
                      <br>
                      <input class="btn btn-info" type="submit" value="登録する">
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
