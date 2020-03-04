@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container">
            <form method="post" action="{{empty($schedule['id']) ? route('schedule.store') : route('schedule.update',$schedule['id'])}}" role="form">
            @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="scheduleName">Schedule name</label>
                        <input type="text" name="schedule_name" value="{{!empty($schedule['schedule_name']) ? $schedule['schedule_name'] : "" }}"  class="form-control" placeholder="Enter schedule name">
                    </div>
                    <div class="form-group">
                        <label for="contractDate">Contract date</label>
                        <input type="date" name="contract_date" value="{{!empty($schedule['contract_date']) ? date('yyyy-MM-dd', strtotime($schedule['contract_date'])) : "" }}" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="valuable">Contract value</label>
                        <input type="text" name="valuable" value="{{!empty($schedule['valuable']) ? $schedule['valuable'] : "" }}"  class="form-control" placeholder="Enter contract valuable">
                    </div>
                    <div class="form-group">
                        <label for="numberMember">Number employee</label>
                        <input type="text" name="number_member" value="{{!empty($schedule['number_member']) ? $schedule['number_member'] : "" }}"  class="form-control" placeholder="Enter number employee">
                    </div>
                    <div class="form-group">
                        <label for="planConstruction">Plan construction</label>
                        <input type="text" name="construction_plan" value="{{!empty($schedule['construction_plan']) ? $schedule['construction_plan'] : "" }}"  class="form-control" placeholder="Enter construction plan">
                    </div>
                    <div class="form-group">
                        <label for="scheduleStatus">Schedule status</label>
                        <input type="text" name="schedule_status" value="{{!empty($schedule['schedule_status']) ? $schedule['schedule_status'] : "" }}" class="form-control" placeholder="Enter schedule status">
                    </div>
                    <div class="form-group">
                        <label for="endDate">End date</label>
                        <input type="date" name="end_date" value="{{!empty($schedule['end_date']) ? $schedule['end_date'] : "" }}" class="form-control" placeholder="Enter schedule status">
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
