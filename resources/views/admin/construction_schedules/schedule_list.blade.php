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
                                <th>Handover Ground</th>
                                <th>Handover Of Supplies</th>
                                <th>Schedule</th>
                                <th>Process</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    a
                                </td>
                                <td>
                                    <a href="{{route('construction.detail')}}" class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                    </a>
                                </td>
                                <td>
                                    <a href="#">Edit</a>
                                    <a href="#" onclick="return confirm('Are you sure to delete schedule '+'' + '?');">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Handover Ground</th>
                                <th>Handover Of Supplies</th>
                                <th>Schedule</th>
                                <th>Process</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
