<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function __construct(user $user)
    {
        $this->middleware('auth');
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
        $lstRole = Role::all();
        return view('admin/users/create',compact('lstRole'));
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
            'email'=>'required|unique:users',
            'password'=>'required|min:8',
            'role_id'=>'required',
            'avatar'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $user = new User([
            'name'=> $request->get('name'),
            'email'=> $request->get('email'),
            'avatar'=> $request->file('avatar') ? $request->file('avatar')->store('','avatars') : null,
            'password'=> Hash::make($request->get('password')),
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
        $lstRole = Role::all();
        return view('admin/users/create', compact(['user','lstRole']));
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
        if($request->file('avatar')){
            $user->avatar = $request->file('avatar')->store('','avatars');
        }
        $user->role_id = $request->get('role_id');
        $user->update();
        return redirect('/manageSchedule/user')->with('success','User saved successfully');

    }
}
