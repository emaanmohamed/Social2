<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class PostCommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('admin.comments.index' , compact('comments'));
    }
    public function store( Request $request)
    {
        $user = Auth::user();
        $data = [
            'post_id' => $request->post_id,
            'author'  => $user->name,
            'email'   => $user->email,
            'photo'   => $user->photo->file,
            'body'    => $request->body
        ];
        Comment::create($data);
        $request->session()->flash('comment_message', 'your message has been submitted and is waiting moderation');
        return redirect()->back();
    }
    public function show($id)
    {
        $post = Post::FindOrFail($id);
        $comments = $post->comments;
        return view('admin.comments.show', compact('comments'));
    }
    public function update(Request $request, $id)
    {
        Comment::findOrFail($id)->update($request->all());
        return redirect('/admin/comments');
    }
    public function destroy($id)
    {
        Comment::findOrFail($id)->delete();
        return redirect()->back();
    }
}
