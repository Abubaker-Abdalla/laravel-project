@extends('layouts.admin')

@section('content')

    <h1>Edit Posts</h1>

    {!! Form::model($post,['method'=>'PATCH','action'=>['AdminPostController@update',$post->id],'files'=>true]) !!}
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
    <div class="form-group col-md-6 col-xs-6">
        {!! Form::submit('Update Post',['class'=>'btn btn-primary'])!!}
    </div>
    {!! Form::close() !!}

    {!! Form::open(['method'=>'DELETE','action'=>['AdminPostController@destroy',$post->id]]) !!}
    <div class="form-group col-md-6 col-xs-6">
        {!! Form::submit('Delete Post',['class'=>'btn btn-danger pull-right'])!!}
    </div>
    {!! Form::close() !!}
@stop