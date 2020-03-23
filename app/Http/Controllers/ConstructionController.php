<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        $projectStart = [];
        $dem = Config('const.INITIALIZATION_0');
        $trackProgress = $this->model;
        $dataProgress = $trackProgress->rightJoin('schedules', 'track_progress.schedules_id', '=', 'schedules.id')->get(['schedules.id', 'schedules.schedule_name', 'schedules.contract_date', 'track_progress.handover_gorund', 'track_progress.handover_of_subpplies', 'track_progress.construction', 'track_progress.area', 'track_progress.image_handover_ground', 'track_progress.image_handover_supplies', 'track_progress.created_at', 'track_progress.updated_at','track_progress.schedules_id'])->toArray();
        for($i = Config('const.INITIALIZATION_0'); $i < count($dataProgress); $i++){
            if (date('d-m-Y',strtotime(Carbon::now())) >= date('d-m-Y',strtotime($dataProgress[$i]['contract_date']))){
                $projectStart[$dem] = $dataProgress[$i];
                $dem++;
            }
        }
        return view('admin.construction_schedules.schedule_list', compact('projectStart'));
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
        $followWork = $this->followWork;
        $followWorks = $followWork->where('track_progress_id',$id)->get();
        return view('admin.construction_schedules.detail_work', compact('followWorks'));
    }
    public function postUpdateConstruction(Request $request)
    {
        $followWork = $this->followWork->where('id', $request->follow_work_id)->first();
        $followWork['finish'] = $request->finish;
        if ($followWork->save()){
            $dataFromTrackProgressID = $this->followWork->where('track_progress_id', $followWork['track_progress_id'])->get();
            $this->sumConstruction($dataFromTrackProgressID, $followWork['track_progress_id']);
            return redirect('/manageSchedule/construction');
        }
    }
    public function postUpdate(Request $request)
    {
        if (isset($request->handover_ground) || isset($request->handover_of_subpplies)){
            $trackProgress = $this->model->where('id', $request->track_progress_id)->first();
            if (isset($request->protocol)){
                $image = $request->file('protocol');
                $fileNameWithExt = $image->getClientOriginalName();
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $image->move(public_path().'/images', $fileNameToStore);
            }
            if (isset($request->handover_ground)){
                if (!isset($fileNameToStore)){
                    $trackProgress['handover_gorund'] = $request->finish;
                } else {
                    $trackProgress['image_handover_ground'] = $fileNameToStore;
                }
                $trackProgress->save();
            } else if(isset($request->handover_of_subpplies)){
                if (!isset($fileNameToStore)){
                    $trackProgress['handover_of_subpplies'] = $request->finish;
                } else {
                    $trackProgress['image_handover_supplies'] = $fileNameToStore;
                }
                $trackProgress->save();
            }
            return redirect('/manageSchedule/construction');
        } else {
            $followWork = $this->followWork;
            $followWork['name'] = $request['name'];
            $followWork['finish'] = $request['finish'];
            $followWork['area'] = $request['area'];
            $followWork['expected_complete_date'] = $request['expected_complete_date'];
            $followWork['note'] = $request['note'];
            $followWork['end_date'] = $request['end_date'];
            $followWork['track_progress_id'] = $request['track_progress_id'];
            if ($followWork->save()){
                $followWorks = $followWork->where('track_progress_id',$request['track_progress_id'])->get();
                $this->sumConstruction($followWorks, $request['track_progress_id']);
            }
        }
        return view('admin.construction_schedules.detail_work', compact('followWorks'));
    }

    public function sumConstruction($data, $id){
        $trackProgress = $this->model;
        $trackProgress = $trackProgress->where('id', $id)->first();
        $trackProgress['construction'] = Config('const.INITIALIZATION_0');
        foreach ($data as $key => $followWork){
            $trackProgress['construction'] += $followWork['finish'];
        }
        $sumConstruction = (1/count($data))*$trackProgress['construction'];
        $trackProgress['construction'] = $sumConstruction;
        $trackProgress->save();
    }
}
