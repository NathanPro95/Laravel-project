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
                            if(empty($schedule['id'])){
                                echo "Tạo mới công trình";
                            }else{
                                echo "Cập nhật công trình";
                            }
                            ?>
                        </h3>
                    </div>
                </div>
            </div>
            <form method="post" action="{{empty($schedule['id']) ? route('schedule.store') : route('schedule.update',$schedule['id'])}}" role="form">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="scheduleName">Tên công trình<span class="text-danger">(*)</span></label>
                                <input type="text" name="schedule_name" value="{{!empty($schedule['schedule_name']) ? $schedule['schedule_name'] : "" }}"  class="form-control" placeholder="Nhập tên công trình">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contractDate">Ngày hợp đồng</label>
                                <input type="date" name="contract_date" value="{{!empty($schedule['contract_date']) ? date('yyyy-MM-dd', strtotime($schedule['contract_date'])) : "" }}" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="valuable">Giá trị hợp đồng(VNĐ)</label>
                                <input type="text" name="valuable" value="{{!empty($schedule['valuable']) ? $schedule['valuable'] : "" }}"  class="form-control" placeholder="Nhập giá trị hợp đồng">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numberMember">Số công nhân</label>
                                <input type="text" name="number_member" value="{{!empty($schedule['number_member']) ? $schedule['number_member'] : "" }}"  class="form-control" placeholder="Nhập số lượng công nhân">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="scheduleStatus">Trạng thái công trình<span class="text-danger">(*)</span></label>
                                <input type="text" name="schedule_status" value="{{!empty($schedule['schedule_status']) ? $schedule['schedule_status'] : "" }}" class="form-control" placeholder="Nhập trạng thái công trình">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="endDate">Ngày kết thúc</label>
                                <input type="date" name="end_date" value="{{!empty($schedule['end_date']) ? $schedule['end_date'] : "" }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="planConstruction">Kế hoạch thi công</label>
                        <textarea type="text" name="construction_plan" rows="5" class="form-control" placeholder="Nhập kế hoạch thi công">{{!empty($schedule['construction_plan']) ? $schedule['construction_plan'] : "" }}</textarea>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><?php if(empty($schedule['id'])) echo"Tạo mới"; else echo "Cập nhật"; ?></button>
                    <a href="{{route('schedule.list')}}" class="btn btn-default">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
