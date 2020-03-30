@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="card-title">
                                Danh sách người dùng
                            </h3>
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('user.create')}}" class="btn btn-primary float-right">Tạo người dùng</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="schedule_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên người dùng</th>
                                <th>Email</th>
                                <th>Quyền</th>
                                <th>Ảnh đại diện</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                @role('admin')
                                    <th>Thao tác</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>#{{$user['id']}}</td>
                                <td>{{$user['name']}}</td>
                                <td>{{$user['email']}}</td>
                                <td>{{$user['role_id'] == 1 ? "Admin" : "User"}}</td>
                                <td>@if($user['avatar'] != null) <img src="{{asset('avatars/'.$user['avatar'])}}" width="50px" height="50px"> @endif</td>
                                <td>{{$user['created_at'] != null ? date('d-m-Y',strtotime($user['created_at'])) : ""}}</td>
                                <td>{{$user['updated_at'] != null ? date('d-m-Y',strtotime($user['updated_at'])) : ""}}</td>
                                @role('admin')
                                    <td>
                                        <a href="{{route('user.edit',$user['id'])}}" style="float: left;margin-right: 5px;" title="Cập nhật"><i class="fa fa-edit"></i></a>
                                        @if(auth()->user()->id !== $user->id)
                                            <form action="{{ route('user.delete', $user->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button style="background: unset;border: unset;color: #f70707;" onclick="return confirm('Are you sure to delete user '+'{{$user['name']}}' + '?');" type="submit" title="Xóa"><i class="fa fa-trash"></i></button>
                                            </form>
                                        @endif
                                    </td>
                                @endrole
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Tên người dùng</th>
                                <th>Email</th>
                                <th>Quyền</th>
                                <th>Ảnh đại diện</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                @role('admin')
                                    <th>Thao tác</th>
                                @endrole
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
