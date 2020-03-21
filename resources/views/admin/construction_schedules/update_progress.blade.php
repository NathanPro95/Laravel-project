@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form method="post" action="{{(route('construction.post.update'))}}" role="form">
                    @csrf
                    <div class="card-body">
                        @if($id == Config('const.WORKING.HANDOVERGORUND') || $id == Config('const.WORKING.HANDOVEROFSUPPLIES'))
                            <div class="form-group">
                                <label for="scheduleName">Handover Protocol</label>
                                <input type="file" name="protocol" class="form-control" placeholder="Enter schedule name">
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="scheduleName">Area</label>
                            <input type="text" name="schedule_name"
                                   value="{{!empty($schedule['schedule_name']) ? $schedule['schedule_name'] : "" }}"
                                   class="form-control" placeholder="Enter schedule name">
                        </div>
                        <div class="form-group">
                            <label for="contractDate">Expected Complete Date</label>
                            <input type="date" name="contract_date"
                                   value="{{!empty($schedule['contract_date']) ? date('yyyy-MM-dd', strtotime($schedule['contract_date'])) : "" }}"
                                   class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="valuable">Note</label>
                            <textarea style="width: 100%"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="endDate">End date</label>
                            <input type="date" name="end_date"
                                   value="{{!empty($schedule['end_date']) ? $schedule['end_date'] : "" }}"
                                   class="form-control" placeholder="Enter schedule status">
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <input type="hidden" name="working" value="{{$id}}">
                </form>
            </div>
        </div>
    </div>
@endsection

<style>
    .schedule{
        margin: 30px 0 5px 0;
    }
    .text-update{
        font-size: 20px;
    }
</style>
