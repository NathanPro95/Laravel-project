@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="card-title">
                                Lập kế hoạch công trình
                            </h3>
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('schedule.create')}}" class="btn btn-primary float-right">Xuất biểu mẫu</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
@endsection
