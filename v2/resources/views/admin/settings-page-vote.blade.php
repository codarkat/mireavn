@extends('layouts.admin-layout')

@section('title')
    <title>MIREA VIETNAM | SETTINGS PAGE VOTE</title>
@endsection

@section('content')
    <div class="content-wrapper container">
        <section class="section">
            @if($dataSettings->status == \App\Enums\StatusEnum::ACTIVE)
            <div class="alert alert-success d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="alert-heading">Phiếu bầu cử đang hoạt động</h4>
                    <p><i>Ấn nút "Ngừng bầu cử" để tắt.</i></p>
                </div>
                <form action="{{route('admin.set-status-page-vote')}}" method="post" enctype="multipart/form-data" onsubmit="return confirm('STOP ACTIVE?');">
                    @csrf
                    <input type="hidden" name="status" value="{{\App\Enums\StatusEnum::INACTIVE}}">
                    <button type="submit" class="btn btn-danger">Ngừng bầu cử</button>
                </form>

            </div>
            @else
            <div class="alert alert-danger d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="alert-heading">Phiếu bầu cử đang đóng</h4>
                    <p><i>Ấn nút "Kích hoạt bầu cử" để bật.</i></p>
                </div>
                <form action="{{route('admin.set-status-page-vote')}}" method="post" enctype="multipart/form-data" onsubmit="return confirm('ACTIVE?');">
                    @csrf
                    <input type="hidden" name="status" value="{{\App\Enums\StatusEnum::ACTIVE}}">
                    <button type="submit" class="btn btn-success">Kích hoạt bầu cử</button>
                </form>
            </div>
            @endif
        </section>

            <section class="section">
                @if(count($errors)> 0)
                    <div class="alert alert-danger">
                        Upload Validation Error<br><br>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if($message = Session::get('success'))
                    <div class="alert alert-success">
                        <strong>{{$message}}</strong>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Danh sách ứng viên</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="candidates-datatable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Avatar</th>
                                        <th>Họ và tên</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Cài đặt</h4>
                            </div>
                            <div class="card-body">
                                <div>
                                    <h6><span class="badge bg-light-danger">RESET</span> DANH SÁCH ỨNG VIÊN</h6>
                                    <p><i><small>Làm mới danh sách ứng viên.</small></i></p>
                                    <div class="d-flex justify-content-center">
                                        <form action="{{route('admin.reset-candidates')}}" method="post" enctype="multipart/form-data" onsubmit="return confirm('RESET DATA?');">
                                            @csrf
                                            <button type="submit" class="btn btn-danger rounded-pill">RESET</button>
                                        </form>
                                    </div>
                                </div>
                                <hr>
                                <div>
                                    <h6><span class="badge bg-light-info">SET</span> TRẠNG THÁI TÀI KHOẢN</h6>
                                    <p><i><small>Thiết lập đồng thời trạng thái cho tất cả tài khoản.</small></i></p>
                                    <div class="d-flex justify-content-center">
                                        <form action="{{route('admin.set-status-all-users')}}" method="post" enctype="multipart/form-data" onsubmit="return confirm('CHANGE STATUS -> ACTIVE?');">
                                            @csrf
                                            <input type="hidden" name="status" value="{{\App\Enums\StatusEnum::ACTIVE}}">
                                            <button type="submit" class="btn btn-success rounded-pill">ACTIVE</button>
                                        </form>
                                            <div class="me-2"></div>
                                        <form action="{{route('admin.set-status-all-users')}}" method="post" enctype="multipart/form-data" onsubmit="return confirm('CHANGE STATUS -> INACTIVE?');">
                                            @csrf
                                            <input type="hidden" name="status" value="{{\App\Enums\StatusEnum::INACTIVE}}">
                                            <button type="submit" class="btn btn-danger rounded-pill">INACTIVE</button>
                                        </form>
                                    </div>
                                </div>
                                <hr>
                                <div>
                                    <h6><span class="badge bg-light-info">SET</span> SỐ LƯỢNG BẦU CỬ</h6>
                                    <p><i><small>Thiết lập các số liệu cần thiết.</small></i></p>
                                    <form action="{{route('admin.set-qty')}}" method="post">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label>Số lượng yêu cầu</label>
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <input type="number" class="form-control" name="qty_receive"
                                                           value="{{$dataSettings->qty_receive}}">
                                                </div>
                                                <div class="col-md-8">
                                                    <label>Số lượng tham gia</label>
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <input type="number" class="form-control" name="qty_total"
                                                           value="{{$dataSettings->qty_total}}">
                                                </div>

                                                <div class="col-sm-12 d-flex justify-content-center">
                                                    <button type="submit" class="btn btn-primary rounded-pill me-1 mb-1">SET</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <hr>
                                <div>
                                    <h6><span class="badge bg-light-success">ADD</span> TẠO TÀI KHOẢN CÁ NHÂN</h6>
                                    <p><i><small>Tạo tài khoản cá nhân bằng file (*.xls), (*.xlsx).</small></i></p>
                                    <form action="{{route('admin.import-user-create')}}" method="post" enctype="multipart/form-data" onsubmit="return confirm('Refesh & Create data?');">
                                        @csrf
                                        <input class="form-control" type="file" name="select_file">
                                        <input class="form-control" type="hidden" name="select" value="refesh">
                                        <div class="col-sm-12 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success rounded-pill mt-4">Refesh&Create</button>
                                        </div>
                                    </form>
                                    <div class="p-2"></div>
                                    <form action="{{route('admin.import-user-create')}}" method="post" enctype="multipart/form-data" onsubmit="return confirm('Add new data?');">
                                        @csrf
                                        <input class="form-control" type="file" name="select_file">
                                        <input class="form-control" type="hidden" name="select" value="add">
                                        <div class="col-sm-12 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-info rounded-pill mt-4">Add new</button>
                                        </div>
                                    </form>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


    </div>
    </div>
@endsection

@section('script')
    <script>

        //Hàm xóa ứng viên
        function removeCandidate(id){
            var url = '{{route("admin.remove-candidate")}}';
            $.ajax({
                type:'POST',
                url:url,
                data: {
                    id: id,
                    _token: '{{csrf_token()}}'
                },
                success:function(data){
                }
            });
        }

        //Hiển thị dữ liệu vào bảng
        $(function () {
            var table = $('#candidates-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.get-all-candidates') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            //Xóa hàng trong bảng ajax
            $('#candidates-datatable tbody').on( 'click', 'button.remove-candidate', function (e) {
                e.preventDefault();
                table
                    .row( $(this).parents('tr') )
                    .remove()
                    .draw();
            });
        });

    </script>
@endsection
