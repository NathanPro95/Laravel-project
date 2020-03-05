@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="schedule_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>UserName</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created date</th>
                                <th>Updated date</th>
                                <th>Process</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>#{{$user['id']}}</td>
                                <td>{{$user['name']}}</td>
                                <td>{{$user['email']}}</td>
                                <td>{{$user['role_id'] == 1 ? "Admin" : "User"}}</td>
                                <td>{{$user['created_at'] != null ? date('d-m-Y',strtotime($user['created_at'])) : ""}}</td>
                                <td>{{$user['updated_at'] != null ? date('d-m-Y',strtotime($user['updated_at'])) : ""}}</td>
                                <td>
                                    <a href="{{route('user.edit',$user['id'])}}">Edit</a>
                                    <a href="{{route('user.delete',$user['id'])}}" onclick="return confirm('Are you sure to delete user '+'{{$user['name']}}' + '?');">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>UserName</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created date</th>
                                <th>Updated date</th>
                                <th>Process</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
