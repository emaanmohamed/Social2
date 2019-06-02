@extends ('layouts.admin')

@section('content')
    <h1>Media</h1>
    @if($photos)
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Created</th>
            </tr>
            </thead>
            <tbody>
            @foreach($photos as $photo)
                <tr>
                    <td>{{$photo->id}}</td>
                    <td><img height="50" width="50px" src="{{url(isset($photo->file) ? $photo->file : 'images/default.jpg' )}}" alt=""></td>
                    <td>{{$photo->created_at ? $photo->created_at->diffForHumans() : 'no image'}}</td>
                    <td>
                        {!! Form::open(['method'=>'DELETE', 'action'=> ['AdminMediaController@destroy', $photo->id]]) !!}
                        <div class="form-group">
                            {!! Form::submit('Delete ', ['class'=>'btn btn-danger col-sm-3 '])!!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

@stop