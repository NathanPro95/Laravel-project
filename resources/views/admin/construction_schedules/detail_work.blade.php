@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="schedule_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>Tên Dự Án</th>
                            <th>Bàn Giao Mặt Bằng</th>
                            <th>Bàn Giao Vật Tư</th>
                            <th>Thi Công</th>
                            <th>Khu Vực</th>
                            <th>Hình Ảnh</th>
                            <th>Ngày Tạo</th>
                            <th>Ngày Cập Nhật</th>
                            <th>Chức Năng</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($detailFollowWorks as $detailFollowWork)
                            <tr>
                                <td>
                                    <p>{{$detailFollowWork['name']}}</p>
                                </td>
                                <td>
                                    <p></p>
                                </td>
                                <td>
                                    <p></p>
                                </td>
                                <td>
                                    <p></p>
                                </td>
                                <td>
                                    <p></p>
                                </td>
                                <td>
                                    <p></p>
                                </td>
                                <td>

                                </td>
                                <td>
                                    <p></p>
                                </td>
                                <td>
                                    <a href="{{route('construction.update', $detailFollowWork['parent_id'])}}}">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Tên Dự Án</th>
                            <th>Bàn Giao Mặt Bằng</th>
                            <th>Bàn Giao Vật Tư</th>
                            <th>Thi Công</th>
                            <th>Khu Vực</th>
                            <th>Hình Ảnh</th>
                            <th>Ngày Tạo</th>
                            <th>Ngày Cập Nhật</th>
                            <th>Chức Năng</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
