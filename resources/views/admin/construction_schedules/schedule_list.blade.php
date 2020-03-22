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
                        @foreach($dataProgress as $value)
                            <tr>
                                <td>
                                    {{$value['schedule_name']}}
                                </td>
                                <td>
                                    <p>{{!empty($value['handover_gorund']) ? $value['handover_gorund'] : 0}}%</p>
                                </td>
                                <td>
                                    <p>{{!empty($value['handover_of_subpplies']) ? $value['handover_of_subpplies'] : 0}}%</p>
                                </td>
                                <td>
                                    <p>{{!empty($value['construction']) ? $value['construction'] : 0}} %</p>
                                </td>
                                <td>
                                    <p>{{$value['area']}}</p>
                                </td>
                                <td>
                                    <p>{{$value['image']}}</p>
                                </td>
                                <td>
                                    <p>{{$value['created_at']}}</p>
                                </td>
                                <td>
                                    <p>{{$value['updated_at']}}</p>
                                </td>
                                <td>
                                    <a href="{{route('construction.detail',$value['id'])}}">Detail</a>
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
