@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Danh sách tiến độ công việc
                    </h3>
                </div>
                <div class="card-body">
                    <table id="schedule_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Tên Dự Án</th>
                                <th>Bàn Giao Mặt Bằng</th>
                                <th>Bàn Giao Vật Tư</th>
                                <th>Thi Công</th>
                                <th>Khu Vực</th>
                                <th>Biên Bản Mặt Bằng</th>
                                <th>Biên Bản Vật Tư</th>
                                <th>Ngày Tạo</th>
                                <th>Ngày Cập Nhật</th>
                                <th>Chức Năng</th>
                            </tr>
                        </thead>
                        <tbody class="track-progress">
                        @foreach($projectStart as $value)
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
                                    @if(!empty($value['image_handover_ground']))
                                    <p><img src="{{asset('images')}}/{{$value['image_handover_ground']}}" alt=""></p>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($value['image_handover_supplies']))
                                    <p><img src="{{asset('images')}}/{{$value['image_handover_supplies']}}" alt=""></p>
                                    @endif
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
                                <th>Biên Bản Mặt Bằng</th>
                                <th>Biên Bản Vật Tư</th>
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
<style>
    img{
        width: 60px;
        height: 60px;
        border-radius: 50%;
    }
</style>
