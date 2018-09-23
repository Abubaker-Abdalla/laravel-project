@extends('layouts.admin')

@section('content')

    <h1><span style="color:#ddd " class="fa fa-plus-square"></span> Create User</h1>

    {!! Form::open(['action'=>'AdminUserController@store','method'=>'post','files'=>true]) !!}
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
            {!! Form::select('role_id',[''=>'Choose Options']+$roles,null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status','Status:') !!}
            {!! Form::select('is_active',[1=>'Active',0=>'Not Active'],0,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('photo_id','Photo:') !!}
            {!! Form::file('photo_id',['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password','Password:') !!}
            {!! Form::password('password',['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Create User',['class'=>'btn btn-primary'])!!}
        </div>
    {!! Form::close() !!}

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