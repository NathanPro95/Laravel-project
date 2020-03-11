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
                                    <a href="{{route('user.edit',$user['id'])}}" style="float: left;margin-right: 5px;" title="Cập nhật"><i class="fa fa-edit"></i></a>
                                    @if($user['role_id'] != 1)
                                        <form action="{{ route('user.delete', $user->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button style="background: unset;border: unset;color: #f70707;" onclick="return confirm('Are you sure to delete user '+'{{$user['name']}}' + '?');" type="submit" title="Xóa"><i class="fa fa-trash"></i></button>
                                        </form>
                                    @endif
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
