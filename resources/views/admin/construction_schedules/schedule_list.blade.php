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
                                <th>Tên công trình</th>
                                <th>Bàn giao mặt bằng</th>
                                <th>Bàn giao vật tư</th>
                                <th>Thi công</th>
                                <th>Khu vực</th>
                                <th>Biên bản mặt bằng</th>
                                <th>Biên bản vật tư</th>
                                <th>Ngày cập nhật</th>
                                <th>Chức Năng</th>
                            </tr>
                        </thead>
                        <tbody class="track-progress">
                        @foreach($projectStart as $value)
                            <tr>
                                <td>
                                    <a href="{{route('construction.detail',$value['id'])}}">
                                        {{$value['schedule_name']}}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('construction.detail',$value['id'])}}">
                                        {{!empty($value['handover_ground']) ? $value['handover_ground'] : 0}}%
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('construction.detail',$value['id'])}}">
                                        {{!empty($value['handover_of_subpplies']) ? $value['handover_of_subpplies'] : 0}}%
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('construction.detail',$value['id'])}}">
                                        {{!empty($value['construction']) ? $value['construction'] : 0}} %
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('construction.detail',$value['id'])}}">
                                        {{$value['area']}}
                                    </a>
                                </td>
                                <td>
                                    @if(!empty($value['image_handover_ground']))
                                        <img src="{{asset('images')}}/{{$value['image_handover_ground']}}" alt="">
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($value['image_handover_supplies']))
                                        <img src="{{asset('images')}}/{{$value['image_handover_supplies']}}" alt="">
                                    @endif
                                </td>
                                <td>
                                    {{$value['updated_at'] != null ? date('d-m-Y',strtotime($value['updated_at'])) : ""}}
                                </td>
                                <td>
                                    <a href="{{route('construction.detail', $value['id'])}}" title="">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Tên công trình</th>
                                <th>Bàn giao mặt bằng</th>
                                <th>Bàn giao vật tư</th>
                                <th>Thi công</th>
                                <th>Khu vực</th>
                                <th>Biên bản mặt bằng</th>
                                <th>Biên bản vật tư</th>
                                <th>Ngày cập nhật</th>
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
