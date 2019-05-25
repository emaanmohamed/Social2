<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostsCreateRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();
       return view('admin.posts.index', compact('posts'));
    }
    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();
        return view('admin.posts.create', compact('categories'));
    }
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::pluck('name', 'id');
        return view('admin.posts.edit' , compact('post', 'categories'));
    }
    public function show($id)
    {

    }
    public function store(PostsCreateRequest $request)
    {
        $input = $request->all();
        $user = Auth::user();
      //  dd($request->file('title'));
        if($file = $request->file('photo_id')){
        //    dd($file);
         // dd($request->file('photo_id'));
            $name = time() . $file->getClientOriginalName();
        //    dd($name);
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }
        $user->posts()->create($input);
        return redirect('/admin/posts');

    }
    public function update($id)
    {

    }
}
