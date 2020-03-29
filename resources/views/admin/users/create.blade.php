@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title">
                            <?php
                            if(empty($user['id'])){
                                echo "Tạo mới người dùng";
                            }else{
                                echo "Cập nhật người dùng";
                            }
                            ?>
                        </h3>
                    </div>
                </div>
            </div>
            <form method="post" action="{{empty($user['id']) ? route('user.store') : route('user.update',$user['id'])}}" role="form">
                @csrf
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br />
                    @endif
                    <div class="form-group">
                        <label for="name">Tên người dùng</label>
                        <input type="text" name="name" value="{{!empty($user['name']) ? $user['name'] : "" }}"  class="form-control" placeholder="Enter user name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" placeholder="Nhập email" value="{{!empty($user['email']) ? $user['email'] : "" }}" class="form-control" >
                    </div>
                    @if(empty($user['id']))
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" name="password" value="{{!empty($user['password']) ? $user['password'] : "" }}"  class="form-control" placeholder="Nhập mật khẩu">
                        </div>
                        <div class="form-group">
                            <label for="repassword">Nhập lại mật khẩu</label>
                            <input type="password" name="repassword"  class="form-control" placeholder="Nhập lại mật khẩu">
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="role">Phân quyền</label>
                        <select class="form-control" name="role_id">
                            @foreach($lstRole as $role)
                                <option value="{{$role->id}}" {{ !empty($user['role_id']) ? $user['role_id'] == $role->id ? 'selected' : '' : ''}}>{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                        <div class="form-group">
                            <label for="email">Ảnh đại diện</label>
                            <input type="file" name="avatar" value="{{!empty($user['avatar']) ? $user['avatar'] : "" }}" class="form-control" >
                        </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><?php if(empty($user['id'])) echo"Tạo mới"; else echo "Cập nhật"; ?></button>
                    <a href="{{route('user.list')}}" class="btn btn-default">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
