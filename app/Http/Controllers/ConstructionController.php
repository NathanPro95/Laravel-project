<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\TrackProgress;
use App\models\FollowWork;
use League\Flysystem\Config;
use App\models\schedule;

class ConstructionController extends Controller
{
    //
    function __construct(TrackProgress $trackProgress, FollowWork $followWork, schedule $schedule)
    {
        $this->model = $trackProgress;
        $this->followWork = $followWork;
        $this->schedule = $schedule;
    }

    public function index()
    {
        $trackProgress = $this->model;
        $dataProgress = $trackProgress->rightJoin('schedules', 'track_progress.schedules_id', '=', 'schedules.id')->get(['schedules.id', 'schedules.schedule_name', 'track_progress.handover_gorund', 'track_progress.handover_of_subpplies', 'track_progress.construction', 'track_progress.area', 'track_progress.image', 'track_progress.created_at', 'track_progress.updated_at','track_progress.schedules_id'])->toArray();
        foreach ($dataProgress as $key => $valueProgress){
            if ($valueProgress['schedules_id'] != $valueProgress['id']){
                $trackProgress = new $this->model;
                $trackProgress['handover_gorund'] = Config('const.DEFAUTLTRACKPROGRESS');
                $trackProgress['handover_of_subpplies'] = Config('const.DEFAUTLTRACKPROGRESS');
                $trackProgress['construction'] = Config('const.DEFAUTLTRACKPROGRESS');
                $trackProgress['schedules_id'] = $valueProgress['id'];
                $trackProgress->save();
            }
        }
        $dataProgress = $trackProgress->rightJoin('schedules', 'track_progress.schedules_id', '=', 'schedules.id')->get(['schedules.id', 'schedules.schedule_name', 'track_progress.handover_gorund', 'track_progress.handover_of_subpplies', 'track_progress.construction', 'track_progress.area', 'track_progress.image', 'track_progress.created_at', 'track_progress.updated_at','track_progress.schedules_id'])->toArray();
        return view('admin.construction_schedules.schedule_list', compact('dataProgress'));
    }
    public function detail($id)
    {
        $detailTrackProgress = $this->model->where('schedules_id',$id)->get()->toArray();
        $sum = (1/3)*($detailTrackProgress[0]['handover_gorund']+$detailTrackProgress[0]['handover_of_subpplies']+$detailTrackProgress[0]['construction']);
        $detailTrackProgress[0]['sum'] = $sum;
        $detailTrackProgress[0]['work_id'] = ['gorund' => 1, 'subpplies' => 2, 'construction' => 3];
        return view('admin.construction_schedules.detail', compact('detailTrackProgress'));
    }
    public function detailWork($id)
    {
        $detailFollowWorks = $this->followWork->where('parent_id', $id)->get();
        return view('admin.construction_schedules.detail_work', compact('detailFollowWorks'));
    }
    public function getUpdate($id)
    {
        return view('admin.construction_schedules.update_progress', compact('id'));
    }
    public function postUpdate(Request $request)
    {
        $followWork = $this->followWork;
        $followWork['name'] = $request['name'];
        $followWork['finish'] = $request['finish'];
        $followWork['image'] = '';
        $followWork['expected_complete_date'] = $request['expected_complete_date'];
        $followWork['note'] = $request['note'];
        $followWork['end_date'] = $request['end_date'];
        $followWork['track_progress_id'] = $request['track_progress_id'];
        $followWork['parent_id'] = $request['parent_id'];
        if ($followWork->save()){
            $followWorks = $followWork->where(['track_progress_id' => $request['track_progress_id'], 'parent_id' => $request['parent_id']])->get();
            return view('admin.construction_schedules.detail_work', compact('followWorks'));
        }
    }
}
