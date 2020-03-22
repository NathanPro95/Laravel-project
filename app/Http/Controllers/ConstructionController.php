<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\TrackProgress;
use App\models\FollowWork;
use League\Flysystem\Config;

class ConstructionController extends Controller
{
    //
    function __construct(TrackProgress $trackProgress, FollowWork $followWork)
    {
        $this->model = $trackProgress;
        $this->followWork = $followWork;
    }

    public function index()
    {
        $trackProgress = $this->model->join('schedules', 'track_progress.schedules_id', '=', 'schedules.id')->get();
    	return view('admin.construction_schedules.schedule_list', compact('trackProgress'));
    }
    public function detail($id)
    {
        $detailTrackProgress = $this->model->find($id);
        $detailTrackProgress = $detailTrackProgress->toArray();
        $sum = (1/3)*($detailTrackProgress['handover_gorund']+$detailTrackProgress['handover_of_subpplies']+$detailTrackProgress['construction']);
        $detailTrackProgress['sum'] = $sum;
        $detailTrackProgress['work_id'] = ['gorund' => 1, 'subpplies' => 2, 'construction' => 3];
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
        if ($request->working == Config('const.WORKING.HANDOVERGORUND')){

        }
    }
}
