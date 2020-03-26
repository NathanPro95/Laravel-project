@extends('layouts.admin')

@section('content')
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        function getIdFollowWork(id) {
            $(".follow_work_id").val(id);
        }
    </script>
@endsection
