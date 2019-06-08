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
        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }
        $user->posts()->create($input);
        return redirect('/admin/posts');

    }
    public function update(Request $request, $id)
    {
        $input = $request->all();
        if($file = $request->file('photo_id'))
        {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name );
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }
        $arr = array_except($input, ['_method', '_token']);
        $arr['category_id'] = (int) $arr['category_id'];
        Auth::user()->posts()->whereId($id)->first()->update($arr);
        return redirect('/admin/posts');
    }
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if(isset($post->photo->file)) {
            unlink(public_path() . $post->photo->file);
        }
        $post->delete();
        return redirect('/admin/posts');
    }
    public function post($id)
    {
       $post = Post::findOrFail($id);
       return view('post', compact('post'));
    }
}
