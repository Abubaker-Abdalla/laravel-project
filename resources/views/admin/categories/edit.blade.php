@extends('layouts.admin')

@section('content')

    <h1>Edit Categories</h1>

    <div class="col-md-6">
        {!! Form::model($category,['method'=>'PATCH','action'=>['AdminCategoriesController@update',$category->id]]) !!}
        <div class="form-group">
            {!! Form::label('name','Name:') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Update Category',['class'=>'btn btn-primary col-md-4'])!!}
        </div>
        {!! Form::close() !!}
        {!! Form::open(['method'=>'DELETE','action'=>['AdminCategoriesController@destroy',$category->id]]) !!}
            <div class="form-group">
                {!! Form::submit('Delete Category',['class'=>'btn btn-danger pull-right'])!!}
            </div>
        {!! Form::close() !!}
    </div>

@stop