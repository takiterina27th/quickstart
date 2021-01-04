<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Http\Requests\StorePost;
use App\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $posts = DB::table('posts');
        $search = $request->input('search');

        // 検索フォーム
        // $query = DB::table('posts');
        $query = Post::query();

        if($search !== null){
            $search_split = mb_convert_kana($search,'s');
            $search_split2 = preg_split('/[\s]+/', $search_split,-1,PREG_SPLIT_NO_EMPTY);
            foreach($search_split2 as $value){
                $query->where('title','like','%'.$value.'%');
            }
        }

        $query->select('id', 'title', 'content', 'image', 'user_id', 'created_at');
        $query->orderBy('created_at', 'desc')->get();
        $posts = $query->paginate(12);

        $user = Auth::user();

        return view('posts.index', compact('posts', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {   
        $originalImg = $request->image;
        if ($originalImg->isValid()) {
            $filePath = $originalImg->store('public');
            $image = str_replace('public/', '', $filePath);
        } else {
            $image = "";
        }

        $post = new Post;

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->image = $image;
        $post->user_id = Auth::user()->id;

        $post->save();

        return redirect('/');

        // dd();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        // $user_name = Auth::user()->name;

        return view('posts.show',
        compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::find($id);

        $user_name = Auth::user()->name;

        return view('posts.edit', compact('post', 'user_name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $post = Post::find($id);
        // $post = new Post;

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = Auth::user()->id;

        $post->save();

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);
        $post->delete();

        return redirect('/');
    }
}
