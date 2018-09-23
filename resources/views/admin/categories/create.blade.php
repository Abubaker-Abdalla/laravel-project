@extends('layouts.admin')

@section('content')

    <h1>Create Categories</h1>

    <div class="col-md-6">
        {!! Form::open(['method'=>'post','action'=>'AdminCategoriesController@store']) !!}
        <div class="form-group">
            {!! Form::label('name','Name:') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Create Category',['class'=>'btn btn-primary'])!!}
        </div>
        {!! Form::close() !!}
    </div>

@stop