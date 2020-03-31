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
            <form method="post" action="{{empty($user['id']) ? route('user.store') : route('user.update',$user['id'])}}" role="form" enctype="multipart/form-data" id="user-form">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Tên người dùng<span class="text-danger">(*)</span></label>
                                <input type="text" name="name" value="{{!empty($user['name']) ? $user['name'] : "" }}"  class="form-control" placeholder="Enter user name">
                                @if($errors->any() && $errors->has('name'))
                                    <p class="text-danger">Vui lòng nhập tên người dùng</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email<span class="text-danger">(*)</span></label>
                                <input type="email" name="email" placeholder="Nhập email" value="{{!empty($user['email']) ? $user['email'] : "" }}" class="form-control" >
                                @if($errors->any() && $errors->has('email'))
                                    <p class="text-danger">Vui lòng nhập email hoặc email đã tồn tại!</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if(empty($user['id']))
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Mật khẩu<span class="text-danger">(*)</span></label>
                                    <input type="password" name="password" id="password" value="{{!empty($user['password']) ? $user['password'] : "" }}"  class="form-control" placeholder="Nhập mật khẩu">
                                    @if($errors->any() && $errors->has('email'))
                                        <p class="text-danger">Vui lòng nhập mật khẩu tối thiểu 8 ký tự!</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="repassword">Nhập lại mật khẩu<span class="text-danger">(*)</span></label>
                                    <input type="password" name="repassword" id="repassword" class="form-control" placeholder="Nhập lại mật khẩu">
                                    <p style="display: none" id="password-error" class="text-danger">Mật khẩu không khớp</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role">Phân quyền</label>
                                <select class="form-control" name="role_id">
                                    @foreach($lstRole as $role)
                                        <option value="{{$role->id}}" {{ !empty($user['role_id']) ? $user['role_id'] == $role->id ? 'selected' : '' : ''}}>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Ảnh đại diện</label>
                                <input type="file" name="avatar" value="{{!empty($user['avatar']) ? $user['avatar'] : "" }}" class="form-control" >
                            </div>
                        </div>
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
    <script>
        $('#repassword').focusout(function(){
           if($('#password').val() != $('#repassword').val()){
               $('#password-error').css('display','block');
           }else{
               $('#password-error').css('display','none');
           }
        });
    </script>
@endsection
