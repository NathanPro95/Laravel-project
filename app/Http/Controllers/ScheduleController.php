<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\schedule;
use App\models\TrackProgress;

class ScheduleController extends Controller
{
    function __construct(schedule $schedule, TrackProgress $trackProgress)
    {
        $this->model = $schedule;
        $this->trackprogress = $trackProgress;
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
        $schedule = Schedule::findOrFail($request->id);
        $result = $schedule->delete();
        if($result){
            return redirect('/manageSchedule/schedule')->with('success','Schedule deleted successfully');
        }else{
            return redirect('/manageSchedule/schedule')->with('failed','Schedule deleted failed');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/schedules/create');
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
        $schedule = new Schedule([
            'schedule_name'=> $request->get('schedule_name'),
            'contract_date'=> $request->get('contract_date'),
            'valuable'=> $request->get('valuable'),
            'number_member'=> $request->get('number_member'),
            'construction_plan'=> $request->get('construction_plan'),
            'end_date'=> $request->get('end_date'),
            'schedule_status'=> $request->get('schedule_status'),
        ]);
        if ($schedule->save()){
            $trackProgress = $this->trackprogress;
            $lastRecordSchedule = $schedule->latest('id')->first();
            $trackProgress['schedules_id'] = $lastRecordSchedule['id'];
            $trackProgress->save();
        }
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
