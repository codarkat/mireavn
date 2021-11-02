@extends('layouts.admin-layout')

@section('title')
    <title>MIREA VIETNAM | RESULTS</title>
@endsection

@section('content')
    <div class="content-wrapper container">
        <section class="section" id="chart-results" style="display: none">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title text-center mt-2">BẢNG KẾT QUẢ</h2>
                    <div class="mt-3 mb-3">
                        <h6><span class="badge bg-primary total-users-online">{{$total_users_online}}</span> Số lượng thành viên tham gia</h6>
                        <h6><span class="badge bg-primary total-users-online">{{$total_users_online}}</span> Số lượng phiếu phát ra </h6>
                        <h6><span class="badge bg-primary total-users-vote">{{$total_users_vote}}</span> Số lượng phiếu thu vào </h6>
                        <h6><span class="badge bg-primary total-users-vote-empty">{{$total_users_online-$total_users_vote}}</span> Số lượng phiếu phiếu trống </h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-5">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                @foreach($arrayDataCandidates as $candidate)
                                    <th>{{$candidate}}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                @foreach($arrayDataVotesPercent as $data)
                                    <td>{{$data}}%</td>
                                @endforeach
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <canvas id="bar"></canvas>

                </div>
            </div>
        </section>

        <section class="section" id="loading" style="display: none">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center">Vui lòng đợi</h4>
                </div>
                <div class="card-body d-flex justify-content-center">
                    <img src="{{asset('public/admin/assets/vendors/svg-loaders/circles.svg')}}" class="" style="width: 7rem" alt="audio">
                </div>
            </div>
        </section>

        <section class="section" id="list-results">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Danh sách bầu cử chi tiết</h4>
                    <button class="btn btn-success" id="show_results">Hiển thị kết quả</button>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6><span class="badge bg-primary total-users-online">{{$total_users_online}}</span> Số lượng thành viên tham gia</h6>
                        <h6><span class="badge bg-primary total-users-online">{{$total_users_online}}</span> Số lượng phiếu phát ra </h6>
                        <h6><span class="badge bg-primary total-users-vote">{{$total_users_vote}}</span> Số lượng phiếu thu vào </h6>
                        <h6><span class="badge bg-primary total-users-vote-empty">{{$total_users_online-$total_users_vote}}</span> Số lượng phiếu phiếu trống </h6>
                    </div>
                    <table class="table table-striped" id="votes-datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ID mã hóa</th>
                            @foreach($arrayDataCandidates as $candidate)
                                <th>{{$candidate}}</th>
                            @endforeach
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
    <script src="{{asset('public/admin/assets/vendors/chartjs/Chart.min.js')}}"></script>
    <script>

        //Hiển thị danh sách voted
        $(function () {
            var table = $('#votes-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.get-all-votes') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        searchable: false
                    },
                    @foreach($dataCandidates as $candidate)
                        @foreach($dataUsers as $user)
                            @if($candidate->user_id == $user->id)
                                {
                                    data: '{{$user->id}}',
                                    name: '{{$user->id}}',
                                    orderable: false,
                                    searchable: false
                                },
                            @endif
                        @endforeach
                    @endforeach
                ]
            });
        });

        //Hiển thị kết quả
        $('#show_results').on('click', function(e){
            e.preventDefault();
            $('#list-results').hide();
            $('#loading').show();
            var url = '{{route("admin.show-result")}}';
            $.ajax({
                type:'GET',
                url:url,
                data: {
                    _token: '{{csrf_token()}}'
                },
                success:function(data){
                    //Lấy dữ liệu từ hàm tính toán showResult
                    var     arrayDataCandidates = data.arrayDataCandidates,
                            arrayDataVotes = data.arrayDataVotes;

                    //Set màu cho biểu đồ
                    var arrayDataColors = [];
                    for (var i = 0; i < {{$dataSettings->qty_total-$dataSettings->qty_receive}}; i++){
                        //Màu xám cho ứng viên không trúng cử
                        arrayDataColors.push("#EBEFF6");
                    }
                    for (var i = {{$dataSettings->qty_total-$dataSettings->qty_receive}}; i < {{$dataSettings->qty_total}}; i++){
                        //Màu xám cho ứng viên trúng cử
                        arrayDataColors.push("#3245D1");
                    }
                    //Sort dữ liệu từ thấp đến cao
                    sortTogether(arrayDataVotes, arrayDataCandidates);
                    //Vẽ biểu đồ từ dữ liệu
                    pushDataToChart(arrayDataCandidates, arrayDataVotes, arrayDataColors);
                }
            });
            setTimeout(function(){
                $('#loading').hide();
                $('#chart-results').show();
            }, 5000);
        })

        //Hàm vẽ dữ liệu dạng biểu đồ
        function pushDataToChart(arrayDataCandidates, arrayDataVotes, arrayDataColors){

            var ctxBar = document.getElementById("bar").getContext("2d");
            var myBar = new Chart(ctxBar, {

                type: 'bar',
                data: {
                    labels: arrayDataCandidates,
                    datasets: [{
                        label: 'Votes',
                        backgroundColor: arrayDataColors,
                        data: arrayDataVotes
                    }]
                },
                options: {
                    responsive: true,
                    barRoundness: 1,
                    title: {
                        display: false,
                        text: "Chart"
                    },
                    legend: {
                        display:false
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                suggestedMax: 50 + 20,
                                padding: 10,
                            },
                            gridLines: {
                                drawBorder: false,
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display:false,
                                drawBorder: false
                            }
                        }]
                    }
                }
            });
        }

        //Sắp xếp 2 array đồng thời chung index
        function sortTogether(array1, array2) {
            var merged = [];
            for (var i = 0; i < array1.length; i++) {
                merged.push({
                    'a1': array1[i],
                    'a2': array2[i]
                });
            }
            merged.sort(function(o1, o2) {
                return ((o1.a1 < o2.a1) ? -1 : ((o1.a1 == o2.a1) ? 0 : 1));
            });
            for (var i = 0; i < merged.length; i++) {
                array1[i] = merged[i].a1;
                array2[i] = merged[i].a2;
            }
        }
    </script>
@endsection
