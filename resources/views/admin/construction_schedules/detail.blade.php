@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-body">
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info height-track">
                <div class="inner">
                    <h3 class="handover-gorund-h3">{{$detailTrackProgress['handover_gorund']}}<sup style="font-size: 20px">%</sup> <p>Bàn Giao Mặt Bằng</p></h3>
                    <div class="progress schedule">
                        <div class="progress-bar progress-bar-striped handover-gorund" role="progressbar" style="width: {{$detailTrackProgress['handover_gorund']}}%"
                             aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">{{$detailTrackProgress['handover_gorund']}}%</div>
                    </div>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" onclick="updateSchedule({{$detailTrackProgress['work_id']['gorund']}})" class="small-box-footer text-update">Cập nhật tiến độ <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info height-track">
                <div class="inner">
                    <h3 class="handover-of-subpplies-h3">{{$detailTrackProgress['handover_of_subpplies']}}<sup style="font-size: 20px">%</sup> <p>Bàn Giao Vật Tư</p></h3>
                    <div class="progress schedule">
                        <div class="progress-bar progress-bar-striped handover-of-subpplies" role="progressbar" style="width: {{$detailTrackProgress['handover_of_subpplies']}}%"
                             aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">{{$detailTrackProgress['handover_of_subpplies']}}%</div>
                    </div>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" onclick="updateSchedule({{$detailTrackProgress['work_id']['subpplies']}})" class="small-box-footer text-update">Cập nhật tiến độ <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info height-track">
                <div class="inner">
                    <h3>{{$detailTrackProgress['construction']}}<sup style="font-size: 20px">%</sup> <p>Thi Công</p></h3>
                    <div class="progress schedule">
                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: {{$detailTrackProgress['construction']}}%"
                             aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">{{$detailTrackProgress['construction']}}%</div>
                    </div>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('construction.detailwork', $detailTrackProgress['id'])}}" class="small-box-footer text-update">Cập nhật tiến độ <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger height-track">
                <div class="inner">
                    <h3 class="sum">{{$detailTrackProgress['sum']}}<sup style="font-size: 20px">%</sup> <p>Kết Thúc</p></h3>
                    <div class="progress schedule">
                        <div class="progress-bar progress-bar-striped sum" role="progressbar" style="width: {{$detailTrackProgress['sum']}}%"
                             aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">{{$detailTrackProgress['sum']}}%</div>
                    </div>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div>
    </div>
    <div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active activeForm-1" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Bàn Giao Mặt Bằng</a>
                <a class="nav-item nav-link activeForm-2" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Bàn Giao Vật Tư</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Thi Công</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <form id="updateHandoverGround" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <input type="hidden" name="handover_ground" class="handover_ground" value="Bàn Giao Mặt Bằng">
                        @if($detailTrackProgress['handover_gorund'] == 100)
                            <div class="form-group">
                                <label for="scheduleName">Biên Bản Bàn Giao</label>
                                <input type="file" name="protocol" class="protocol form-control" placeholder="Enter schedule name">
                            </div>
                        @else
                        <div class="form-group">
                            <label for="scheduleName">Tiến Độ</label>
                            <input type="number" name="finish" class="finish form-control" placeholder="Tiến Độ">
                        </div>
                        <div class="form-group">
                            <label for="valuable">Ghi Chú</label>
                            <textarea style="width: 100%" name="note" class="note"></textarea>
                        </div>
                        @endif
                        <input type="hidden" name="track_progress_id" value="{{$detailTrackProgress['id']}}">
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <form id="updateHandoverOfSubpplies" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <input type="hidden" name="handover_of_subpplies" class="handover_of_subpplies" value="Biên Bản Vật Tư">
                        @if($detailTrackProgress['handover_of_subpplies'] == 100)
                            <div class="form-group">
                                <label for="scheduleName">Biên Bản Bàn Giao</label>
                                <input type="file" name="protocol" class="protocolSubpplies form-control" placeholder="Enter schedule name">
                            </div>
                        @else
                        <div class="form-group">
                            <label for="scheduleName">Tiến Độ</label>
                            <input type="number" name="finish" class="finishSubpplies form-control" placeholder="Tiến Độ">
                        </div>
                        <div class="form-group">
                            <label for="valuable">Ghi Chú</label>
                            <textarea style="width: 100%" name="note" class="noteSubpplies"></textarea>
                        </div>
                        @endif
                        <input type="hidden" name="track_progress_id" class="track_progress_id" value="{{$detailTrackProgress['id']}}">
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <form method="post" action="{{(route('construction.post.update'))}}" role="form">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="scheduleName">Hạng Mục</label>
                            <input type="text" name="name" class="form-control" placeholder="Hạng Mục">
                        </div>
                        <div class="form-group">
                            <label for="scheduleName">Khu Vực</label>
                            <input type="text" name="area" class="form-control" placeholder="Khu Vực">
                        </div>
                        <div class="form-group">
                            <label for="scheduleName">Tiến Độ</label>
                            <input type="number" name="finish" class="form-control" placeholder="Tiến Độ">
                        </div>
                        <div class="form-group">
                            <label for="contractDate">Ngày Dự Kiến Hoàn Thành</label>
                            <input type="date" name="expected_complete_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="valuable">Ghi Chú</label>
                            <textarea style="width: 100%" name="note"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="endDate">Ngày Kết Thúc</label>
                            <input type="date" name="end_date" class="form-control" placeholder="Enter schedule status">
                        </div>
                        <input type="hidden" name="track_progress_id" value="{{$detailTrackProgress['id']}}">
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
    <script>
        function updateSchedule(id){
            $('#nav-tab .nav-item').removeClass('active');
            $('.activeForm-'+id).trigger('click');
        }
        jQuery(document).ready(function($) {
            $('#updateHandoverOfSubpplies').on('submit',function(event){
                event.preventDefault();
                handover_of_subpplies = $('.handover_of_subpplies').val();
                area = $('.areaSubpplies').val();
                protocol = $('.protocolSubpplies').val();
                finish = $('.finishSubpplies').val();
                expected_complete_date = $('.expected_complete_date_subpplies').val();
                note = $('.noteSubpplies').val();
                end_date = $('.end_dateSubpplies').val();
                track_progress_id = $('.track_progress_id').val();
                $.ajax({
                    url: "{{route('construction.post.update')}}",
                    type:"POST",
                    data_type: "JSON",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        handover_of_subpplies:handover_of_subpplies,
                        protocol: protocol,
                        area: area,
                        finish: finish,
                        expected_complete_date: expected_complete_date,
                        note: note,
                        end_date: end_date,
                        track_progress_id: track_progress_id
                    },
                    success:function(data){
                        console.log(data);
                        sum = (1/10)*data.handover_gorund + (1/10)*data.handover_of_subpplies + (8/10)*data.construction;
                        $('.handover-of-subpplies-h3').html(data.handover_of_subpplies + '<sup style="font-size: 20px">%</sup> <p>Bàn Giao Mặt Bằng</p>');
                        $('.handover-of-subpplies').html(data.handover_of_subpplies + '%');
                        $('.handover-of-subpplies').css('width', data.handover_of_subpplies + '%');
                        $('.sum').html(sum + '<sup style="font-size: 20px">%</sup> <p>Bàn Giao Mặt Bằng</p>');
                        $('.sum').html(sum + '%');
                        $('.sum').css('width', sum + '%');
                    },
                });
            });
        });
        jQuery(document).ready(function($) {
            $('#updateHandoverGround').on('submit', function (event) {
                event.preventDefault();
                handover_ground = $('.handover_ground').val();
                protocol = $('.protocol').val();
                area = $('.area').val();
                finish = $('.finish').val();
                expected_complete_date = $('.expected_complete_date').val();
                note = $('.note').val();
                end_date = $('.end_date').val();
                track_progress_id = $('.track_progress_id').val();
                $.ajax({
                    url: "{{route('construction.post.update')}}",
                    type: "POST",
                    data_type: "JSON",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        handover_ground: handover_ground,
                        protocol: protocol,
                        area: area,
                        finish: finish,
                        expected_complete_date: expected_complete_date,
                        note: note,
                        end_date: end_date,
                        track_progress_id: track_progress_id
                    },
                    success: function (data) {
                        console.log(data);
                        console.log(data.handover_gorund);
                        sum = (1/10)*data.handover_gorund + (1/10)*data.handover_of_subpplies + (8/10)*data.construction;
                        $('.handover-gorund-h3').html(data.handover_gorund + '<sup style="font-size: 20px">%</sup> <p>Bàn Giao Mặt Bằng</p>');
                        $('.handover-gorund').html(data.handover_gorund + '%');
                        $('.handover-gorund').css('width', data.handover_gorund + '%');
                        $('.sum').html(sum + '<sup style="font-size: 20px">%</sup> <p>Bàn Giao Mặt Bằng</p>');
                        $('.sum').html(sum + '%');
                        $('.sum').css('width', sum + '%');
                    },
                });
            });
        });
    </script>
@endsection
