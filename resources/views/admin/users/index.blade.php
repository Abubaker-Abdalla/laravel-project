@extends('layouts.admin')

@section('content')

    @if(Session::has('message'))

        <p id = 'message' class="alert alert-success"> {{Session('message')}} </p>
        @section('footer')
            <script>
                $('#message').fadeOut(3000);
            </script>
        @endsection

    @endif

    @if(count($users)>0)
        <h1><span style="color:#ddd" class="fa fa-users"></span> Users</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Control</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td><img class="" height="30" src="/images/{{$user->photo ? $user->photo->file_name :'avatar5.png'}}"></td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role->name}}</td>
                    <td>{{$user->is_active==1?'Active':'Not Active'}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>{{$user->updated_at->diffForHumans()}}</td>
                    <td><a href="{{url('admin/users/'.$user->id.'/edit')}}" class="btn btn-primary fa fa-edit"> Edit</a> </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if(count($users)==0)
        <h1 class="text-center alert alert-info">Not Found User</h1>
    @endif
@endsection