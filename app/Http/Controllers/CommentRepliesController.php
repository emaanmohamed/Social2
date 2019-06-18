<?php

namespace App\Http\Controllers;

use App\Comment;
//use Egulias\EmailValidator\Warning\Comment;
use App\CommentReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentRepliesController extends Controller
{
    public function index()
    {

    }
    public function create()
    {

    }
    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        $replies = $comment->replies;
        return view('admin.comments.replies.show', compact('replies'));
    }
    public function store(Request $request)
    {

    }
    public function createReply(Request $request)
    {
        $user = Auth::user();
        $data = [
            'comment_id' => $request->comment_id,
            'author'  => $user->name,
            'email'   => $user->email,
            'photo'   => $user->photo->file,
            'body'    => $request->body
        ];
        CommentReply::create($data);
        $request->session()->flash('reply_message', 'your message has been submitted and is waiting moderation');
        return redirect()->back();

    }
    public function update(Request $request, $id)
    {
        CommentReply::findOrFail($id)->update($request->all());
        return redirect()->back();
    }
    public function destroy($id)
    {
        CommentReply::findOrFail($id)->delete();
        return redirect()->back();
    }


}
