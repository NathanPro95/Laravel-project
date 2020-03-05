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
        $this->model->delete($request->id);
        # code...
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
            'schedule_name'=>'required',
            'schedule_status'=>'required'
        ]);
        $schedule = new schedule([
            'schedule_name'=> $request->get('schedule_name'),
            'contract_date'=> $request->get('contract_date'),
            'valuable'=> $request->get('valuable'),
            'number_member'=> $request->get('number_member'),
            'construction_plan'=> $request->get('construction_plan'),
            'end_date'=> $request->get('end_date'),
            'schedule_status'=> $request->get('schedule_status'),
        ]);
        $schedule->save();
        return redirect('/manageSchedule/schedule')->with('success','Schedule saved successfully');
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
        $schedule = $this->model->find($id);
        $schedule->schedule_name = $request->get('schedule_name');
        $schedule->contract_date = $request->get('contract_date');
        $schedule->valuable = $request->get('valuable');
        $schedule->number_member = $request->get('number_member');
        $schedule->construction_plan = $request->get('construction_plan');
        $schedule->end_date = $request->get('end_date');
        $schedule->schedule_status = $request->get('schedule_status');
        $schedule->update();
        return redirect('/manageSchedule/schedule')->with('success','Schedule saved successfully');

    }
}
