@extends('layouts.blog-post')

@section('content')
    <h1>{{$post->title}}</h1>
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>
    <hr>
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>
    <hr>
    {{--{{dump("Social2/public" . $post->photo->file)}}--}}
    <img class="img-responsive" src="{{$post->photo->file}}" alt="">
    <hr>
    <p class="lead">{{$post->body}}</p>
    <hr>
    @if(Session::has('comment_message'))
        <p class="bg-danger">{{session('comment_message')}}</p>
    @endif
    @if(Auth::check())
        <div class="well">
            <h4>Leave a Comment:</h4>
            {!! Form::open(['method'=>'POST', 'action' => 'PostCommentsController@store']  ) !!}
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <div class="form-group">
                {!! Form::label('body', 'Body:') !!}
                {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3])!!}
            </div>
            <div class="form-group">
                {!! Form::submit('Submit comment', ['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    @endif
    <hr>

    <!-- Posted Comments -->
<<<<<<< HEAD
@if(count($comments) > 0)
    @foreach($comments as $comment)
    <!-- Comment -->
    <div class="media">
        <a class="pull-left" href="#">
            {{--{{dump($comment->photo)}}--}}
            <img class="media-object" height="64" width="64px" src="{{Auth::user()->gravatar ? Auth::user()->gravatar : "https://via.placeholder.com/100"}}" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{$comment->author}}
                <small>{{$comment->created_at->diffForHumans()}}</small>
            </h4>
           <p>{{$comment->body}}</p>
            <!-- Nested Comment -->
=======
    @if(count($comments) > 0)
        @foreach($comments as $comment)
            <!-- Comment -->
>>>>>>> 722d3bddb65f03333221936c18d6b504cffed361
            <div class="media">
                <a class="pull-left" href="#">
                    {{--{{dump($comment->photo)}}--}}
                    <img class="media-object" height="64" width="64px"
                         src="{{$comment->photo ? $comment->photo : "https://via.placeholder.com/100"}}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->author}}
                        <small>{{$comment->created_at->diffForHumans()}}</small>
                    </h4>
                    <p>{{$comment->body}}</p>
                @if(count($comment->replies) > 0)
                    @foreach($comment->replies as $reply)
                        @if($reply->is_active == 1)
                        <!-- Nested Comment -->
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img height="65" width="65" class="media-object" src="{{$reply->photo}}" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">{{$reply->author}}
                                        <small>{{$reply->created_at->diffForHumans()}}</small>
                                    </h4>
                                   {{$reply->body}}
                            </div>
                                <div class="comment-reply-container">
                                    <button class="toggle-reply btn btn-primary pull-right">Reply</button>
                                    <div class="comment-reply col-sm-6" style="display: none" >
                            {!! Form::open(['method'=>'POST', 'action' => 'CommentRepliesController@createReply']) !!}
                            <input type="hidden" name="comment_id" value="{{$comment->id}}">
                            <div class="form-group">
                                {!! Form::label('body', 'Body:') !!}
                                {!! Form::textarea('body', null, ['class'=>'form-control', 'rows' => '1'])!!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
                            </div>
                            {!! Form::close() !!}
                                    </div>
                                </div>
                        <!-- End Nested Comment -->
                        </div>
                            @else
                            <h1 class="text-center">No Replies</h1>
                        @endif
                        @endforeach
                    @endif

                </div>
            </div>
        @endforeach
    @endif
    <!-- Comment -->
    {{--<div class="media">--}}
    {{--<a class="pull-left" href="#">--}}
    {{--<img class="media-object" src="http://placehold.it/64x64" alt="">--}}
    {{--</a>--}}
    {{--<div class="media-body">--}}
    {{--<h4 class="media-heading">Start Bootstrap--}}
    {{--<small>August 25, 2014 at 9:30 PM</small>--}}
    {{--</h4>--}}
    {{--Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.--}}

    {{--</div>--}}
    {{--</div>--}}
@stop
    @section('scripts')
        <script>
            $(".comment-reply-container .toggle-reply").click(function () {
                $(this).next().slideToggle("slow");
            });

        </script>
        @stop
