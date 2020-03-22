@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info height-track">
                <div class="inner">
                    <h3>{{$detailTrackProgress['handover_gorund']}}<sup style="font-size: 20px">%</sup> <p>Bàn Giao Mặt Bằng</p></h3>
                    <div class="progress schedule">
                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: {{$detailTrackProgress['handover_gorund']}}%"
                             aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">{{$detailTrackProgress['handover_gorund']}}%</div>
                    </div>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('construction.detailwork', $detailTrackProgress['work_id']['gorund'])}}" class="small-box-footer text-update">Cập nhật tiến độ <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info height-track">
                <div class="inner">
                    <h3>{{$detailTrackProgress['handover_of_subpplies']}}<sup style="font-size: 20px">%</sup> <p>Bàn Giao Vật Tư</p></h3>
                    <div class="progress schedule">
                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: {{$detailTrackProgress['handover_of_subpplies']}}%"
                             aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">{{$detailTrackProgress['handover_of_subpplies']}}%</div>
                    </div>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('construction.detailwork', $detailTrackProgress['work_id']['subpplies'])}}" class="small-box-footer text-update">Cập nhật tiến độ <i class="fas fa-arrow-circle-right"></i></a>
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
                <a href="{{route('construction.detailwork', $detailTrackProgress['work_id']['construction'])}}" class="small-box-footer text-update">Cập nhật tiến độ <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger height-track">
                <div class="inner">
                    <h3>{{$detailTrackProgress['sum']}}<sup style="font-size: 20px">%</sup> <p>Kết Thúc</p></h3>
                    <div class="progress schedule">
                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: {{$detailTrackProgress['sum']}}%"
                             aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">{{$detailTrackProgress['sum']}}%</div>
                    </div>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div>
    </div>
@endsection
