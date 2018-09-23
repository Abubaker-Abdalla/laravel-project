@extends('layouts.admin')

@section('content')

    @if(Session::has('message'))

        <h2 id = 'message' class="alert alert-success"> {{Session('message')}} </h2>
    @section('footer')
        <script>
            $('#message').fadeOut(3000);
        </script>
    @endsection

    @endif

    @if(count($posts)>0)
        <h1><span style="color:#ddd" class="fa fa-file-photo-o"></span> Posts</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Owner</th>
                <th>Category</th>
                <th>Title</th>
                <th>Content</th>
                <th>Photo</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Control</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->category?$post->category->name:'UnCategorized'}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->content}}</td>
                    <td><img class="" height="30" src="/images/{{$post->photo ? $post->photo->file_name :'avatar5.png'}}"></td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>
                    <td><a href="{{url('admin/posts/'.$post->id.'/edit')}}" class="btn btn-primary fa fa-edit"> Edit</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    @if(count($posts)==0)
        <h2 class="text-center alert alert-info">Not Found Post</h2>
    @endif
@stop