@extends('layouts.admin')

@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="card">
            <form method="post" action="{{empty($schedule['id']) ? route('schedule.store') : route('schedule.update',$schedule['id'])}}" role="form">
            @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="scheduleName">Handover Report</label>
                        <input type="text" name="schedule_name" value="{{!empty($schedule['schedule_name']) ? $schedule['schedule_name'] : "" }}"  class="form-control" placeholder="Enter schedule name">
                    </div>
                    <div class="form-group">
                        <label for="contractDate">Expected Complete Date</label>
                        <input type="date" name="contract_date" value="{{!empty($schedule['contract_date']) ? date('yyyy-MM-dd', strtotime($schedule['contract_date'])) : "" }}" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="valuable">Note</label>
                        <textarea style="width: 100%"></textarea>
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
