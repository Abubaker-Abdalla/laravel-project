<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::pluck('name','id')->all();
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //
        $input = $request->all();

        if ($file = $request->file('photo_id'))
        {
            $name = time().$file->getClientOriginalName();

            $file->move('images',$name);

            $photo = Photo::create(['file_name'=>$name]);

             $input['photo_id']=$photo->id;
        }


        $input['password'] = sha1($request->password);

        User::create($input);

        Session::flash('message','The User has been Created Successfully');

        return redirect('/admin/users');
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
        $user=User::findOrFail($id);
        $roles=Role::pluck('name','id')->all();
        return view('admin.users.edit',compact('user','roles'));
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
        $user = User::findOrFail($id);

        $input = $request->all();
        $input = $request->except('old_password','password');
        $input['photo_id'] = $user->photo_id;

        if($request->old_password && $request->password)
        {
            $old_password_encrypt = sha1($request->old_password);
            if($old_password_encrypt == $user->password)
            {
                $input['password'] = sha1($request->password);
            }
            else
            {
                Session::flash('error','Incorrect Old password');
                return redirect('admin/users/'.$id.'/edit');
            }
        }

        if($file = $request->file('photo_id'))
        {
            $name = time().$file->getClientOriginalName();

            $file->move('images',$name);

            $photo = Photo::create(['file_name'=>$name]);

            $input['photo_id']=$photo->id;
        }

        $user->update($input);

        Session::flash('message','The User has been Updated Successfully');

        return redirect('admin/users');

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
        $user = User::findOrFail($id);
        $photo = Photo::findOrFail($id);

        unlink('images/'.$user->photo->file_name);

        $user->delete();
        $photo->delete();

        Session::flash('message','The User has been Deleted Successfully');

        return redirect('/admin/users');
    }
}
