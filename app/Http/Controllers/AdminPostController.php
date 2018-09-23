<?php

namespace App\Http\Controllers;

use App\category;
use App\Photo;
use App\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = post::all();

        return view('admin.posts.index',compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category = category::pluck('name','id')->all();
        return view('admin.posts.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->all();

        $user = Auth::user();

        if($file = $request->file('photo_id'))
        {
            $name = time(). $file->getClientOriginalName();

            $file->move('images',$name);

            $photo = Photo::create(['file_name'=>$name]);

            $input['photo_id'] = $photo->id;
        }

        $user->posts()->create($input);

        Session::flash('message','The Post Created Successfully');

        return redirect('admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post=post::findOrFail($id);
        $category=category::pluck('name','id')->all();
        return view('admin.posts.edit',compact('post','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $input = $request->all();

        if($file = $request->file('photo_id'))
        {
            $name = time().$file->getClientOriginalName();

            $file->move('images',$name);

            $photo = Photo::create(['file_name'=>$name]);

            $input['photo_id']=$photo->id;
        }

        Auth::user()->posts()->whereId($id)->first()->update($input);

        Session::flash('message','The Post Updated Successfully');

        return redirect('admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = post::findOrFail($id);

        if($post->photo)
        {
            unlink('images/'.$post->photo->file_name);
        }

        $post->delete();

        Session::flash('message','Post deleted Successfully');

        return redirect('admin/posts');
    }
}
