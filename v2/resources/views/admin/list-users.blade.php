@extends('layouts.admin-layout')

@section('title')
    <title>MIREA VIETNAM | LIST USERS</title>
@endsection

@section('content')
    <div class="content-wrapper container">
        <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Danh sách điểm danh</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">List</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Users</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h6><span class="badge bg-primary total-users-online">{{$total_users_online}}</span> Số lượng thành viên tham gia</h6>
                        <h6><span class="badge bg-primary total-users-offline">{{$total_users_offline}}</span> Số lượng thành viên vắng </h6>
                    </div>
                    <table class="table table-striped" id="users-datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Avatar</th>
                            <th>Họ và tên</th>
                            <th>Email</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
    </div>
@endsection

@section('script')
    <script src="https://js.pusher.com/7.0/pusher-with-encryption.min.js"></script>
    <script>
        var pusher = new Pusher('{{env("MIX_PUSHER_APP_KEY")}}', {
            cluster: '{{env("PUSHER_APP_CLUSTER")}}',
            encrypted: true
        });

        var channel = pusher.subscribe('list-users');
        channel.bind('App\\Events\\UpdatePageListUsers', function(data) {
            console.log(data);
                $('.total-users-online').html(data.total_users_online);
                $('.total-users-offline').html(data.total_users_offline);
        });

        function changeStatusAccount(e){
            var id = e.getAttribute('user-id');
            if(e.checked){
                $('#switch-status-'+id).html('Tham dự');
                var url = '{{route("admin.set-status-user")}}';
                $.ajax({
                    type:'POST',
                    url:url,
                    data: {
                        id: id,
                        status: '{{\App\Enums\StatusEnum::ACTIVE}}',
                        _token: '{{csrf_token()}}'
                    },
                    success:function(data){
                    }
                });
            } else {
                $('#switch-status-'+id).html('Vắng');
                var url = '{{route("admin.set-status-user")}}';
                $.ajax({
                    type:'POST',
                    url:url,
                    data: {
                        id: id,
                        status: '{{\App\Enums\StatusEnum::INACTIVE}}',
                        _token: '{{csrf_token()}}'
                    },
                    success:function(data){
                    }
                });
            }
        }
        function addCandidate(id){
            var url = '{{route("admin.add-candidate")}}';
            $.ajax({
                type:'POST',
                url:url,
                data: {
                    id: id,
                    _token: '{{csrf_token()}}'
                },
                success:function(data){
                    $('#button-action-'+id)
                        .addClass('btn-success')
                        .removeClass('btn-secondary');
                    $('#button-action-'+id).html(`Đã là ứng viên`);
                    $('#button-action-'+id).attr("onclick","removeCandidate("+id+")");
                }
            });
        }

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
                    $('#button-action-'+id)
                        .addClass('btn-secondary')
                        .removeClass('btn-success');
                    $('#button-action-'+id).html(`Chọn là ứng viên`);
                    $('#button-action-'+id).attr("onclick","addCandidate("+id+")");
                }
            });
        }

        $(function () {
            var table = $('#users-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.get-all-users') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false
                    },
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {
                        data: 'status',
                        name: 'status',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
