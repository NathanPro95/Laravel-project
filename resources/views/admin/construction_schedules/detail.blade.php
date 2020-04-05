@extends('layouts.admin')

@section('content')
<div class="card">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h3 class="card-title">
                   {{$scheduleName}}
                </h3>
            </div>
        </div>
    </div>
    <div class="card-body">
    <!-- progress -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info height-track">
                <div class="inner">
                    <h3 class="handover-gorund-h3">{{$detailTrackProgress['handover_ground']}}<sup style="font-size: 20px">%</sup> <p>Bàn Giao Mặt Bằng</p></h3>
                    <div class="progress schedule">
                        <div class="progress-bar progress-bar-striped handover-gorund" role="progressbar" style="width: {{$detailTrackProgress['handover_ground']}}%"
                             aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">{{$detailTrackProgress['handover_ground']}}%</div>
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
                    <h3 class="construction-h3">{{$detailTrackProgress['construction']}}<sup style="font-size: 20px">%</sup> <p>Thi Công</p></h3>
                    <div class="progress schedule">
                        <div class="progress-bar progress-bar-striped construction" role="progressbar" style="width: {{$detailTrackProgress['construction']}}%"
                             aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">{{$detailTrackProgress['construction']}}%</div>
                    </div>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" data-toggle="modal" class="update-construction small-box-footer text-update" data-target="#update-construction" data-whatever="@mdo">Cập nhật tiến độ <i class="fas fa-arrow-circle-right"></i></a>
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
    <!-- end progress -->

    <!-- form update construction progress -->
    <div class="modal fade" id="update-construction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Tiến Độ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateContruction" role="form">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="scheduleName">Hạng Mục</label> <span class="text-danger">(*)</span>
                            <select name="name" class="nameContruction form-control" required="">
                                <option value="">-------------- Hạng Mục --------------</option>
                                @foreach($constructionItems as $constructionItem)
                                <option value="{{$constructionItem['id']}}" class="nameItem{{$constructionItem['id']}}">{{$constructionItem['name_item']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="scheduleName">Khu Vực</label> <span class="text-danger">(*)</span>
                            <input type="text" name="area" class="areaContruction form-control" placeholder="Khu Vực" required="">
                        </div>
                        <div class="form-group">
                            <label for="scheduleName">Tiến Độ</label> <span class="text-danger">(*)</span>
                            <input type="number" name="finish" class="finishContruction form-control" placeholder="Tiến Độ" required="">
                        </div>
                        <div class="form-group">
                            <label for="contractDate">Ngày Dự Kiến Hoàn Thành</label>
                            <input type="date" name="expected_complete_date" class="expected_complete_date form-control">
                        </div>
                        <div class="form-group">
                            <label for="valuable">Ghi Chú</label>
                            <textarea style="width: 100%" name="note" class="noteContruction"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="endDate">Ngày Kết Thúc</label>
                            <input type="date" name="end_date" class="end_date form-control" placeholder="Enter schedule status">
                        </div>
                        <input type="hidden" name="track_progress_id" class="trackProgressIdContruction" value="{{$detailTrackProgress['id']}}">
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
    <!--end form update construction progress -->

    <!-- nav tab -->
    <div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active activeForm-1" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Bàn Giao Mặt Bằng</a>
                <a class="nav-item nav-link activeForm-2" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Bàn Giao Vật Tư</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Thi Công</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active inputHandoverGround" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <form id="updateHandoverGround" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <input type="hidden" name="handover_ground" class="handover_ground" value="Bàn Giao Mặt Bằng">
                        @if($detailTrackProgress['handover_ground'] == 100)
                            <div class="form-group">
                                <label for="scheduleName">Biên Bản Bàn Giao</label>
                                <input type="file" name="protocol" class="protocol form-control" placeholder="Enter schedule name">
                            </div>
                        @else
                        <div class="form-group">
                            <label for="scheduleName">Tiến Độ</label> <span class="text-danger">(*)</span>
                            <input type="number" name="finish" class="finish form-control" placeholder="Tiến Độ" required="">
                        </div>
                        <div class="form-group">
                            <label for="valuable">Ghi Chú</label>
                            <textarea style="width: 100%" name="note" class="note"></textarea>
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
            <div class="tab-pane fade inputHandoverOfSupplies" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <form id="updateHandoverOfSupplies" role="form" enctype="multipart/form-data">
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
                            <label for="scheduleName">Tiến Độ</label> <span class="text-danger">(*)</span>
                            <input type="number" name="finish" class="finishSubpplies form-control" placeholder="Tiến Độ" required="">
                        </div>
                        <div class="form-group">
                            <label for="valuable">Ghi Chú</label>
                            <textarea style="width: 100%" name="note" class="noteSubpplies"></textarea>
                        </div>
                        @endif
                        <input type="hidden" name="track_progress_id" class="trackProgressIdSupplies" value="{{$detailTrackProgress['id']}}">
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade listContruction" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="schedule_table" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Hạng Mục</th>
                                            <th>Khu Vực</th>
                                            <th>Hoàn Thành</th>
                                            <th>Ghi Chú</th>
                                            <th>Ngày Dự Kiến</th>
                                            <th>Ngày Kết Thúc</th>
                                            <th>Chức Năng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($followWorks as $followWork)
                                        <tr>
                                            <td>
                                                <p>{{$followWork['name']}}</p>
                                            </td>
                                            <td>
                                                <p>{{$followWork['area']}}</p>
                                            </td>
                                            <td>
                                                <p>{{$followWork['finish']}}</p>
                                            </td>
                                            <td>
                                                <p>{{$followWork['note']}}</p>
                                            </td>
                                            <td>
                                                <p>{{date('d-m-Y', strtotime($followWork['expected_complete_date']))}}</p>
                                            </td>
                                            <td>
                                                <p>{{date('d-m-Y', strtotime($followWork['end_date']))}}</p>
                                            </td>
                                            <td>
                                                <a href="#" data-toggle="modal" class="update-construction" onclick="getIdFollowWork({{$followWork['id']}})" data-target="#exampleModal" data-whatever="@mdo">Cập Nhật</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Hạng Mục</th>
                                            <th>Khu Vực</th>
                                            <th>Hoàn Thành</th>
                                            <th>Ghi Chú</th>
                                            <th>Ngày Dự Kiến</th>
                                            <th>Ngày Kết Thúc</th>
                                            <th>Chức Năng</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Tiến Độ</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{route('construction.post.updateConstruction')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Tiến Độ Công Việc</label>
                                        <input type="number" name="finish" class="form-control">
                                    </div>
                                    <input type="hidden" name="follow_work_id" class="follow_work_id">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Send message</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end nav tab -->
    </div>
</div>
    <script>
        function updateSchedule(id){
            $('#nav-tab .nav-item').removeClass('active');
            $('.activeForm-'+id).trigger('click');
        }
        jQuery(document).ready(function($) {
            $('#updateContruction').on('submit',function(event){
                event.preventDefault();
                item_id = $('.nameContruction').val();
                name = $('.nameContruction option:selected').text();
                area = $('.areaContruction').val();
                finish = $('.finishContruction').val();
                expected_complete_date = $('.expected_complete_date').val();
                note = $('.noteContruction').val();
                end_date = $('.end_date').val();
                track_progress_id = $('.trackProgressIdContruction').val();
                $.ajax({
                    url: "{{route('construction.post.update')}}",
                    type:"POST",
                    data_type: "JSON",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        name:name,
                        area: area,
                        finish: finish,
                        expected_complete_date: expected_complete_date,
                        note: note,
                        end_date: end_date,
                        track_progress_id: track_progress_id,
                        item_id: item_id
                    },
                    success:function(data){
                        console.log(data);
                        sum = (1/10)*data[0].handover_ground + (1/10)*data[0].handover_of_subpplies + (8/10)*data[0].construction;
                        $('.construction-h3').html(data[0].construction + '<sup style="font-size: 20px">%</sup> <p>Bàn Giao Mặt Bằng</p>');
                        $('.construction').html(data[0].construction + '%');
                        $('.construction').css('width', data[0].construction + '%');
                        $('.sum').html(sum + '<sup style="font-size: 20px">%</sup> <p>Bàn Giao Mặt Bằng</p>');
                        $('.sum').html(sum + '%');
                        $('.sum').css('width', sum + '%');
                        var tableHTML = '<div class="row">'+
                        '<div class="col-md-12">'+
                        '<div class="card">'+
                            '<div class="card-body">'+
                        '<table id="schedule_table" class="table table-striped'+ 
                        'table-bordered" style="width:100%">'+
                                    '<thead>'+
                                        '<tr>'+
                                            '<th>Hạng Mục</th>'+
                                            '<th>Khu Vực</th>'+
                                            '<th>Hoàn Thành</th>'+
                                            '<th>Ghi Chú</th>'+
                                            '<th>Ngày Dự Kiến</th>'+
                                            '<th>Ngày Kết Thúc</th>'+
                                            '<th>Chức Năng</th>'+
                                        '</tr>'+
                                    '</thead>'+
                                    '<tbody>';
                        var taga = '@if(isset($followWork['id']))'+
                            '<a href="#" data-toggle="modal" class="update-construction" onclick="getIdFollowWork({{$followWork['id']}})" data-target="#exampleModal" data-whatever="@mdo">Cập Nhật</a>' +
                            '@endif'
                        ;
                        $.each(data[1], function( index, dataContruction ) {
                                console.log(dataContruction.name);
                                tableHTML += '<tr>'+
                                            '<td>'+
                                                '<p>'+dataContruction.name+'</p>'+
                                            '</td>'+
                                            '<td>'+
                                                '<p>'+dataContruction.area+'</p>'+
                                            '</td>'+
                                            '<td>'+
                                                '<p>'+dataContruction.finish+'</p>'+
                                            '</td>'+
                                            '<td>'+
                                                '<p>'+dataContruction.note+'</p>'+
                                            '</td>'+
                                            '<td>'+
                                                '<p>'+dataContruction.expected_complete_date+'</p>'+
                                            '</td>'+
                                            '<td>'+
                                                '<p>'+dataContruction.end_date+'</p>'+
                                            '</td>'+
                                            '<td>'+
                                                taga +
                                            '</td>'+
                                        '</tr>';
                        });
                        tableHTML += '</tbody>'+
                                    '<tfoot>'+
                                        '<tr>'+
                                            '<th>Hạng Mục</th>'+
                                            '<th>Khu Vực</th>'+
                                            '<th>Hoàn Thành</th>'+
                                            '<th>Ghi Chú</th>'+
                                            '<th>Ngày Dự Kiến</th>'+
                                            '<th>Ngày Kết Thúc</th>'+
                                            '<th>Chức Năng</th>'+
                                        '</tr>'+
                                    '</tfoot>'+
                                '</table>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>';
                        $('.listContruction').html(tableHTML);
                    },
                });
            });
        });
        jQuery(document).ready(function($) {
            $('#updateHandoverOfSupplies').on('submit',function(event){
                event.preventDefault();
                handover_of_subpplies = $('.handover_of_subpplies').val();
                area = $('.areaSubpplies').val();
                protocol = $('.protocolSubpplies').val();
                finish = $('.finishSubpplies').val();
                expected_complete_date = $('.expected_complete_date_subpplies').val();
                note = $('.noteSubpplies').val();
                end_date = $('.end_dateSubpplies').val();
                track_progress_id = $('.trackProgressIdSupplies').val();
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
                        sum = (1/10)*data.handover_ground + (1/10)*data.handover_of_subpplies + (8/10)*data.construction;
                        $('.handover-of-subpplies-h3').html(data.handover_of_subpplies + '<sup style="font-size: 20px">%</sup> <p>Bàn Giao Mặt Bằng</p>');
                        $('.handover-of-subpplies').html(data.handover_of_subpplies + '%');
                        $('.handover-of-subpplies').css('width', data.handover_of_subpplies + '%');
                        $('.sum').html(sum + '<sup style="font-size: 20px">%</sup> <p>Bàn Giao Mặt Bằng</p>');
                        $('.sum').html(sum + '%');
                        $('.sum').css('width', sum + '%');
                        if(data.handover_of_subpplies == 100){
                            $('.inputHandoverOfSupplies').html('<form method="post" action="{{(route("construction.post.update"))}}" role="form" enctype="multipart/form-data">\n' +
                                '                    @csrf\n' +
                                '                    <input type="hidden" name="handover_of_subpplies" class="handover_of_subpplies" value="Biên Bản Vật Tư">' +
                                '                            <div class="form-group">\n' +
                                '                                <label for="scheduleName">Biên Bản Bàn Giao</label>\n' +
                                '                                <input type="file" name="protocol" class="protocolSubpplies form-control" placeholder="Enter schedule name">\n' +
                                '                            </div>\n' +
                                '                            <input type="hidden" name="track_progress_id" class="trackProgressIdSupplies" value="{{$detailTrackProgress["id"]}}">\n' +
                                '                    <div class="card-footer">\n' +
                                '                        <button type="submit" class="btn btn-primary">Cập nhật</button>\n' +
                                '                    </div>\n' +
                                '                </form>');
                        }
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
                        console.log(data.handover_ground);
                        sum = (1/10)*data.handover_ground + (1/10)*data.handover_of_subpplies + (8/10)*data.construction;
                        $('.handover-gorund-h3').html(data.handover_ground + '<sup style="font-size: 20px">%</sup> <p>Bàn Giao Mặt Bằng</p>');
                        $('.handover-gorund').html(data.handover_ground + '%');
                        $('.handover-gorund').css('width', data.handover_ground + '%');
                        $('.sum').html(sum + '<sup style="font-size: 20px">%</sup> <p>Bàn Giao Mặt Bằng</p>');
                        $('.sum').html(sum + '%');
                        $('.sum').css('width', sum + '%');
                        if(data.handover_ground == 100){
                            $('.inputHandoverGround').html('<form method="post" action="{{(route("construction.post.update"))}}" role="form" enctype="multipart/form-data">\n' +
                                '                    @csrf\n' +
                                '                    <input type="hidden" name="handover_ground" class="handover_ground" value="Bàn Giao Mặt Bằng">' +
                                '                            <div class="form-group">\n' +
                                '                                <label for="scheduleName">Biên Bản Bàn Giao</label>\n' +
                                '                                <input type="file" name="protocol" class="protocolSubpplies form-control" placeholder="Enter schedule name">\n' +
                                '                            </div>\n' +
                                '                            <input type="hidden" name="track_progress_id" class="track_progress_id" value="{{$detailTrackProgress["id"]}}">\n' +
                                '                    <div class="card-footer">\n' +
                                '                        <button type="submit" class="btn btn-primary">Cập nhật</button>\n' +
                                '                    </div>\n' +
                                '                </form>');
                        }
                    },
                });
            });
        });
        function getIdFollowWork(id) {
            $(".follow_work_id").val(id);
        }
    </script>
@endsection
