@extends('layouts.admin')

@section('content')

    @if(Session::has('message'))

        <h2 id = 'message' class="alert alert-success"> {{Session('message')}} <span class="fa fa-smile-o"></span> </h2>
    @section('footer')
        <script>
            $('#message').fadeOut(3000);
        </script>
    @endsection

    @endif

    <h1>Categories</h1>

    @if(count($categories)>0)

        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Control</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->created_at?$category->created_at->diffForHumans():'no date'}}</td>
                    <td>{{$category->updated_at?$category->created_at->diffForHumans():'no date'}}</td>
                    <td><a href="{{url('admin/categories/'.$category->id.'/edit')}}" class="btn btn-primary fa fa-edit"> Edit</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
    @if(count($categories)==0)
        <h2 class="text-center alert alert-info">Not Found Category</h2>
    @endif

@stop