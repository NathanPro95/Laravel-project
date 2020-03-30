<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\models\ScheduleImport;
use App\models\TrackProgress;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelController extends Controller
{
    //
	public function import()
	{

		Excel::import(new ScheduleImport,request()->file('file'));
		$dataProgress = DB::table('track_progress')->rightJoin('schedules', 'track_progress.schedules_id', '=', 'schedules.id')->get(['schedules.id', 'schedules.schedule_name', 'track_progress.handover_gorund', 'track_progress.handover_of_subpplies', 'track_progress.construction', 'track_progress.area',  'track_progress.image_handover_ground', 'track_progress.image_handover_supplies', 'track_progress.created_at', 'track_progress.updated_at','track_progress.schedules_id'])->toArray();
		foreach ($dataProgress as $key => $valueProgress){
			if ((array)$valueProgress->schedules_id != (array)$valueProgress->id){
				$trackProgress = new TrackProgress;
				$trackProgress['schedules_id'] = ((array)$valueProgress->id)[0];
				$trackProgress->save();
			}
		}
		return redirect('/manageSchedule/schedule');
	}
}
