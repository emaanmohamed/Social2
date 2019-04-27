@extends ('layouts.admin')

@section('content')


    <h1>users</h1>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Id</th>
            {{--<th>Photo</th>--}}
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
        </thead>
        <tbody>

    @if($users)

        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                {{--<td><img height="50" src="{{url(isset($user->photo->file) ? $user->photo->file : 'images/default.jpg')}}" alt=""></td>--}}
                <td><a href="">{{$user->name}}</a></td>
                <td>{{$user->email}}</td>
                <td>{{isset($user->role) && ! is_null($user->role) ? $user->role->name : 'not defined yet'}}</td>
                <td>{{$user->is_active == 1 ? 'Active' : 'Not Active'}}</td>
                <td>{{$user->created_at->diffForHumans()}}</td>
                <td>{{$user->updated_at->diffForHumans()}}</td>
            </tr>
            @endforeach
    @endif

        </tbody>
    </table>

@stop