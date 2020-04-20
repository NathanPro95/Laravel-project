<?php

namespace App\Http\Controllers;

use App\models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\models\TrackProgress;
use App\models\FollowWork;
use App\models\ContructionItems;
use League\Flysystem\Config;

class ConstructionController extends Controller
{
    //
    function __construct(TrackProgress $trackProgress, FollowWork $followWork, ContructionItems $constructionItem)
    {
        $this->model = $trackProgress;
        $this->constructionItem = $constructionItem;
        $this->followWork = $followWork;
    }

    public function index()
    {
        $projectStart = [];
        $dem = Config('const.INITIALIZATION_0');
        $trackProgress = $this->model;
        $dataProgress = $trackProgress->rightJoin('schedules', 'track_progress.schedule_id', '=', 'schedules.id')->get(['schedules.schedule_name', 'schedules.contract_date', 'track_progress.id', 'track_progress.handover_ground', 'track_progress.handover_of_subpplies', 'track_progress.construction', 'track_progress.area', 'track_progress.image_handover_ground', 'track_progress.image_handover_supplies', 'track_progress.created_at', 'track_progress.updated_at','track_progress.schedule_id'])->toArray();
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
        $constructionItems = $this->constructionItem->get();
        $followWork = $this->followWork;
        $followWorks = $followWork->where('track_progress_id',$id)->get();
        $detailTrackProgress = $this->model->find($id);
        if($detailTrackProgress != null) {
            $scheduleName = Schedule::find($detailTrackProgress->schedule_id)->schedule_name;
            $detailTrackProgress = $detailTrackProgress->toArray();
            $sum = (1 / 10) * $detailTrackProgress['handover_ground'] + (1 / 10) * $detailTrackProgress['handover_of_subpplies'] + (8 / 10) * $detailTrackProgress['construction'];
            $detailTrackProgress['sum'] = $sum;
            $detailTrackProgress['work_id'] = ['gorund' => 1, 'subpplies' => 2, 'construction' => 3];
            return view('admin.construction_schedules.detail', compact('detailTrackProgress','scheduleName','followWorks', 'constructionItems'));
        }
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
        $followWork = $this->followWork;
        $trackProgress = $this->model;
        if (isset($request->handover_ground) || isset($request->handover_of_subpplies)){
            $trackProgress = $trackProgress->where('id', $request->track_progress_id)->first();
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
                    $trackProgress['handover_ground'] = $request->finish;
                } else {
                    $trackProgress['image_handover_ground'] = $fileNameToStore;
                    $trackProgress->save();
                    return redirect('manageSchedule/construction');
                }
            } else if(isset($request->handover_of_subpplies)){
                if (!isset($fileNameToStore)){
                    $trackProgress['handover_of_subpplies'] = $request->finish;
                } else {
                    $trackProgress['image_handover_supplies'] = $fileNameToStore;
                    $trackProgress->save();
                    return redirect('manageSchedule/construction');
                }
            }
            $trackProgress->save();
            $recordTrackProgressId = $trackProgress->find($request->track_progress_id);
            return response()->json($recordTrackProgressId);
        } else {
            $followWork['name'] = $request['name'];
            $followWork['finish'] = $request['finish'];
            $followWork['area'] = $request['area'];
            $followWork['expected_complete_date'] = $request['expected_complete_date'];
            $followWork['note'] = $request['note'];
            $followWork['end_date'] = $request['end_date'];
            $followWork['track_progress_id'] = $request['track_progress_id'];
            $followWork['item_id'] = $request['item_id'];
            if ($followWork->save()){
                $followWorks = $followWork->where('track_progress_id',$request['track_progress_id'])->get();
                $this->sumConstruction($followWorks, $request['track_progress_id']);
            }
            $recordTrackProgressId = $trackProgress->find($request->track_progress_id);
            if (!empty($followWorks)) {
                return response()->json([$recordTrackProgressId, $followWorks]);
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
