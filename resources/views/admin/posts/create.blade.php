@extends('layouts.admin')

@section('content')

    <h1>Create Posts</h1>

    {!! Form::open(['method'=>'post','action'=>'AdminPostController@store','files'=>true]) !!}
        <div class="form-group">
            {!! Form::label('title','Title:') !!}
            {!! Form::text('title',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('category_id','Category:') !!}
            {!! Form::select('category_id',[''=>'Options']+$category,null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('photo_id','Photo:') !!}
            {!! Form::file('photo_id',null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('content','Description:') !!}
            {!! Form::textarea('content',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Create Post',['class'=>'btn btn-primary'])!!}
        </div>
    {!! Form::close() !!}
@stop