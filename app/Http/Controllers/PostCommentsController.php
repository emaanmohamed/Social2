<?php

namespace App\Http\Controllers;

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
            'photo'    => $user->photo->file,
            'body'    => $request->body
        ];
        Comment::create($request->all());
        $request->session()->flash('comment_message', 'your message has been submitted and is waiting moderation');
        return redirect()->back();
    }
}
