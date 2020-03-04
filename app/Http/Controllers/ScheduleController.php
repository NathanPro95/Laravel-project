<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\schedule;

class ScheduleController extends Controller
{
    function __construct(schedule $schedule)
    {
        $this->model = $schedule;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = $this->model->all();
        return view('admin/schedules/schedule', compact('schedules'));
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
        return view('admin/schedules/create');
        // $scheduleDB = $this->model;
        // $scheduleDB->schedule_name = $request->schedule_name;
        // $scheduleDB->schedule_status = $request->schedule_status;
        // if($scheduleDB->save()){
        //     return redirect('quanly/schedule');
        // }
        # code...
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
        $schedule = $this->model->find($id);
        return view('admin/schedules/create', compact('schedule'));
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
