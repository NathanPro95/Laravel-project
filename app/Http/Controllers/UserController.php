<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    function __construct(user $user)
    {
        $this->model = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->model->all();
        return view('admin/users/user', compact('users'));
    }
    public function delete(Request $request)
    {
        $user = User::findOrFail($request->id);
        $result = $user->delete();
        if($result){
            return redirect('/manageSchedule/user')->with('success','User deleted successfully');
        }else{
            return redirect('/manageSchedule/user')->with('failed','User deleted failed');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/users/create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'role_id'=>'required'
        ]);
        $user = new User([
            'name'=> $request->get('name'),
            'email'=> $request->get('email'),
            'password'=> $request->get('password'),
            'role_id'=> $request->get('role_id'),
        ]);
        $user->save();
        return redirect('/manageSchedule/user')->with('success','User saved successfully');
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
        $user = $this->model->find($id);
        return view('admin/users/create', compact('user'));
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
        $user = $this->model->find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->role_id = $request->get('role_id');
        $user->update();
        return redirect('/manageSchedule/user')->with('success','User saved successfully');

    }
}
