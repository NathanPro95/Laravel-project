@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('schedule.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="file" name="file" class="form-control" accept=".csv">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button class="btn btn-success">Import Schedule</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <table id="schedule_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Contract date</th>
                                <th>Valuable</th>
                                <th>Number emp</th>
                                <th>Plan</th>
                                <th>Status</th>
                                <th>End date</th>
                                @role('admin')
                                    <th>Process</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedules as $schedule)
                            <tr>
                                <td>{{$schedule['schedule_name']}}</td>
                                <td>{{$schedule['contract_date'] != null ? date('d-m-Y',strtotime($schedule['contract_date'])) : ""}}</td>
                                <td>{{$schedule['valuable'] != null ? $schedule['valuable'] : ""}}</td>
                                <td>{{$schedule['number_member'] != null ? $schedule['number_member'] : "" }}</td>
                                <td>{{$schedule['construction_plan'] != null ? $schedule['construction_plan'] : ""}}</td>
                                <td>{{$schedule['schedule_status']}}</td>
                                <td>{{$schedule['end_date'] != null ? date('d-m-Y',strtotime($schedule['end_date'])) : ""}}</td>
                                @role('admin')
                                    <td>
                                        <a href="{{route('schedule.edit',$schedule['id'])}}" style="float: left;margin-right: 5px;" title="Cập nhật"><i class="fa fa-edit"></i></a>
                                        <form action="{{route('schedule.delete',$schedule['id'])}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button style="background: unset;border: unset;color: #f70707;" onclick="return confirm('Are you sure to delete schedule '+'{{$schedule['schedule_name']}}' + '?');" type="submit" title="Xóa"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                @endrole
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Contract date</th>
                                <th>Valuable</th>
                                <th>Number emp</th>
                                <th>Plan</th>
                                <th>Status</th>
                                <th>End date</th>
                                @role('admin')
                                    <th>Process</th>
                                @endrole
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
