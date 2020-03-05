@extends('layouts.admin')

@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="card">
            <form method="post" action="{{empty($user['id']) ? route('user.store') : route('user.update',$user['id'])}}" role="form">
            @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Tên người dùng</label>
                        <input type="text" name="name" value="{{!empty($user['name']) ? $user['name'] : "" }}"  class="form-control" placeholder="Enter user name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" placeholder="Nhập email" value="{{!empty($user['email']) ? $user['email'] : "" }}" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input type="password" name="password" value="{{!empty($user['password']) ? $user['password'] : "" }}"  class="form-control" placeholder="Nhập mật khẩu">
                    </div>
                    <div class="form-group">
                        <label for="repassword">Nhập lại mật khẩu</label>
                        <input type="password" name="repassword"  class="form-control" placeholder="Nhập lại mật khẩu">
                    </div>
                    <div class="form-group">
                        <label for="role">Phân quyền</label>
                        <input type="text" name="role_id" value="{{!empty($user['role_id']) ? $user['role_id'] : "" }}"  class="form-control" placeholder="Nhập role">
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><?php if(empty($user['id'])) echo"Tạo mới"; else echo "Cập nhật"; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
