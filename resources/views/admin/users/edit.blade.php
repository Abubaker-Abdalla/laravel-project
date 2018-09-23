@extends('layouts.admin')

@section('content')

    <h1><span style="color:#ddd " class="fa fa-edit"></span> Edit User</h1>
    <div class="row">
        <div class="col-md-2">
            <img id="image" {{--style="height: 150px"--}} class="img-responsive img-thumbnail" src="/images/{{$user->photo?$user->photo->file_name:'avatar5.png'}}">
        </div>
        <div class="col-md-9">
        @if(Session::has('error'))

            <p id = 'message' class="alert alert-danger"> {{Session('error')}} </p>
        @section('footer')
            <script>
                $('#message').fadeOut(3000);
            </script>
        @endsection

        @endif
        {!! Form::model($user,['action'=>['AdminUserController@update',$user->id],'method'=>'PATCH','files'=>true]) !!}
        <div class="form-group">
            {!! Form::label('name','Name:') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email','Email:') !!}
            {!! Form::email('email',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('role_id','Role:') !!}
            {!! Form::select('role_id',$roles,null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status','Status:') !!}
            {!! Form::select('is_active',[1=>'Active',0=>'Not Active'],null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('photo_id','Photo:') !!}
            {!! Form::file('photo_id',['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('old_password','Old Password:') !!}
            {!! Form::password('old_password',['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password','New Password:') !!}
            {!! Form::password('password',['class'=>'form-control']) !!}
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::submit('Update User',['class'=>'btn btn-primary'])!!}
            </div>
        </div>
        {!! Form::close() !!}

        {!! Form::open(['method'=>'DELETE','action'=>['AdminUserController@destroy',$user->id]]) !!}
            <div class="form-group">
                {!! Form::submit('Delete User',['class'=>'btn btn-danger pull-right'])!!}
            </div>
        {!! Form::close() !!}
        </div>
    </div>


    {{--@if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($erros as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif--}}
@stop

@section('footer')
    <script>
        $('#photo_id').change(function () {
            var x=$('#photo_id')[0].files[0];
            image(x);
        });
        function image(input) {
            var reader = new FileReader();
            reader.onloadend = function(e){
                $('#image').attr('src', e.target.result);
            };
            reader.readAsDataURL(input);
        }
    </script>
@endsection