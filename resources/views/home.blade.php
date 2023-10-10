@extends('layouts.layout')

@section('title')
    {{ 'เมนูหลัก' }}
@endsection

@section('style')
    {{-- Data tables --}}
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            {{-- ลา 4 อันแรก --}}
            <div class="row mb-3">
                <link rel="stylesheet" href="{{ asset('style/css.css') }}">
                @php
                    $colors = ['#E8533D', '#5182FF', '#FEAD10', '#6d99c5'];
                    $colors1 = ['#F37762', '#759CFF', '#FFCA62', '#92b3d4'];
                    $icon = ['fa-solid fa-stethoscope', 'fa-solid fa-business-time', 'fa-solid fa-umbrella-beach', 'fa-solid fa-book'];
                    $count = 0;
                @endphp
                @foreach ($leave_datas as $leave_data)
                    @if ($count == 0 || $count == 1 || $count == 2 || $count == 3)
                        <div class="col-lg-3 mb-2">
                            <div class="card-box" style="background-color: {{ $colors[$count % count($colors)] }};">
                                <div class="content1">
                                    <div class="icon-card" style="background-color:{{ $colors1[$count % count($colors1)] }}">
                                        <i class="{{ $icon[$count % count($icon)] }}" style="width: 50px; height:50px; color:white"></i>
                                    </div>
                                    <div class="day">
                                        <span class="Hday">{{ $time_already_useds[$loop->index] }}</span><span class="Sday">/{{ $time_remains[$loop->index] }}</span>
                                        <span class="SSday">วัน</span>
                                    </div>
                                </div>
                                <br>
                                <div class="content1">
                                    <div class="title">
                                        <p class="mb-0">{{ $leave_data->leave_type_name }}</p>
                                    </div>
                                    <div class="detail">
                                        <button class="btn btn-link pr-0" href="" data-toggle="modal" data-target="#card{{ $count }}">
                                            <i class="fas fa-file-lines fa-xl" style="color:white"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {{-- modal ลาป่วย --}}
                            <div class="modal fade" id="card{{ $count }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">
                                                {{ $leave_data->leave_type_name }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ลาไปแล้ว {{ $leave_data->time_already_used }}
                                            <br>
                                            คงเหลือ {{ $leave_data->time_remain }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @php
                        $count++;
                    @endphp
                @endforeach
            </div>
            {{-- ลาอื่นๆ --}}
            <div class="row">
                <div class="col-lg-12">
                    <a class="btn btn-outline-secondary btn-block mb-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        ประเภทการลาเพิ่มเติม
                    </a>
                </div>
                {{-- collaps ลาอิ่นๆ --}}
                <div class="col-lg-12">
                    <div class="collapse" id="collapseExample">
                        <div class="card">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    @php
                                        $bg = ['', '', '', '#eef7ff', '#f1fbff;', '#ffe6f5', '#f9e3ff', '#e2f5de', '#fff7f0'];
                                        $icon_color = ['', '', '', '#6d99c5', '#00b7fe', '#ff009b', '#c600fe', '#1fb500', '#ff6a00'];
                                        $icon = ['', '', '', 'fa-solid fa-book', 'fa-solid fa-baby', 'fa-solid fa-heart', 'fa-solid fa-hospital-user', 'fa-solid fa-person-rifle', 'fa-solid fa-hands-praying'];
                                        $count = 0;
                                    @endphp
                                    @foreach ($leave_datas as $leave_data)
                                        @if ($count >= 3 && $count < 9)
                                            {{-- ลาอื่นๆ --}}
                                            <div class="col-md-2">
                                                <div class="card-box-other d-flex justify-content-between align-items-center" data-toggle="modal" data-target="#modal{{ $count }}">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="align-items-center d-flex justify-content-center" style="background-color: {{ $bg[$count] }}; height:70px;width:70px;border-radius:50px">
                                                            <i class="{{ $icon[$count] }} fa-2xl" style="color:{{ $icon_color[$count] }}"></i>
                                                        </div>
                                                        <div class="ml-2 d-flex flex-column justify-content-center">
                                                            <p class="text-dark font-weight-bold mb-0" style="font-size: 18px;">{{ $leave_data->leave_type_name }}</p>
                                                            <p class="text-dark mb-0" style="color:black">
                                                                {{ $time_already_useds[$loop->index] }}/{{ $time_remains[$loop->index] }}วัน
                                                            </p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal ลาอื่นๆ -->
                                            <div class="modal fade" id="modal{{ $count }}" tabindex="-1" role="dialog" aria-labelledby="modal{{ $count }}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modal{{ $count }}Label">
                                                                {{ $leave_data->leave_type_name }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            ลาไปแล้ว {{ $leave_data->time_already_used }}
                                                            <br>
                                                            คงเหลือ {{ $leave_data->time_remain }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @php
                                            $count++;
                                            if ($count >= 9) {
                                                break;
                                            }
                                        @endphp
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end d-flex pr-0">
                <a href="{{ route('create') }}" class="btn btn-primary ms-auto">+ เพิ่มใบลา</a>
            </div>
        </div>
    </section>

    {{-- ChartJS --}}
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-bold">
                                <i class="fas fa-chart-bar mr-2"></i>
                                สรุปผลข้อมูลจำนวนการลาในเดือนนั้นๆ
                            </h3>
                            <div class="card-body">
                                <canvas id="leave_chart_of_years" style="min-height: 250px; height: 250px; max-height: 400px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end ChartJS --}}

    {{-- ตาราง --}}
    @php
        $style = 'white-space: nowrap; overflow: hidden; text-overflow: ellipsis;';
    @endphp
    <section class="content">
        <div class="container-fluid">
            {{-- ตารางรายการคำขอใบลา --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">
                                <i class="fas fa-list-alt mr-2"></i>
                                รายการคำขอใบลา
                            </h3>
                        </div>
                        <div class="card-body">
                            {{-- data-table --}}
                            <table id="req_list_table" class="table table-bordered table-hover text-center">
                                <thead>
                                <tr>
                                    <th style="{{ $style }} max-width: 40px;">วันที่ยื่นคำร้อง</th>
                                    <th style="{{ $style }} max-width: 40px;">ประเภทการลา</th>
                                    <th style="{{ $style }} max-width: 40px;">วันที่ลาตั้งแต่</th>
                                    <th style="{{ $style }} max-width: 40px;">ถึง</th>
                                    <th style="{{ $style }} max-width: 40px;">ลาทั้งหมด</th>
                                    <th style="{{ $style }} max-width: 30px;">ผู้ปฏิบัติงานแทน</th>
                                    <th style="{{ $style }} max-width: 50px;">สถานะ</th>
                                    <th style="{{ $style }} max-width: 10px;">รายละเอียด</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($leave_forms as $leave_form)
                                    <tr>
                                        <td style="{{ $style }} max-width: 40px;">
                                            {{ \Carbon\Carbon::parse($leave_form->created_at)->addYears(543)->format('d/m/Y H:i') }}
                                        </td>
                                        <td style="{{ $style }} max-width: 40px;">{{ $leave_form->leave_type }}</td>
                                        <td style="{{ $style }} max-width:40px;">
                                            {{ \Carbon\Carbon::parse($leave_form->leave_start)->addYears(543)->format('d/m/Y H:i') }}
                                        </td>
                                        <td style="{{ $style }} max-width: 40px;">
                                            {{ \Carbon\Carbon::parse($leave_form->leave_end)->addYears(543)->format('d/m/Y H:i') }}
                                        </td>
                                        <td style="{{ $style }} max-width: 40px;">{{ $leave_form->leave_total }}</td>
                                        @if (!$sel_reps[$loop->index]->name)
                                            <td style="{{ $style }} max-width: 40px;">ไม่มีผู้ปฎิบัติงานแทน</td>
                                        @else
                                            <td style="{{ $style }} max-width: 40px;">{{ $sel_reps[$loop->index]->name }}</td>
                                        @endif
                                        <td style="{{ $style }} max-width: 40px;">
                                            <button type="button"
                                                    class="btn btn-sm rounded-pill
                                                    @if($leave_form->status == 'กำลังดำเนินการ') btn-secondary
                                                    @elseif($leave_form->status == 'อนุมัติ') btn-success
                                                    @elseif($leave_form->status == 'ไม่อนุมัติ') btn-danger
                                                    @elseif($leave_form->status == 'หมดอายุ') btn-outline-info
                                                    @elseif($leave_form->status == 'ยกเลิกใบลา') btn-info
                                                    @else btn-warning
                                                    @endif ">
                                                {{ $leave_form->status }}</button>
                                        </td>
                                        <td style="{{ $style }} max-width: 20px;">
                                            <a href="{{ route('req.detail', $leave_form->id) }}">
                                                <i class="fas fa-file-invoice"></i>
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
                {{-- end รายการคำขอใบลา --}}
            </div>
            {{-- end ตารางรายการคำขอใบลา --}}

            {{-- ตารางรายการคำขอปฏิบัติแทน --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">
                                <i class="fas fa-list-alt mr-2"></i>
                                รายการคำขอปฏิบัติแทน
                            </h3>
                        </div>
                        <div class="card-body">
                            {{-- data-table --}}
                            <table id="req_list_table1" class="table table-bordered table-hover text-center">
                                <thead>
                                <tr>
                                    <th style="{{ $style }} max-width: 40px;">วันที่ยื่นคำร้อง</th>
                                    <th style="{{ $style }} max-width: 40px;">ประเภทการลา</th>
                                    <th style="{{ $style }} max-width: 40px;">วันที่ลาตั้งแต่</th>
                                    <th style="{{ $style }} max-width: 40px;">ถึง</th>
                                    <th style="{{ $style }} max-width: 40px;">ลาทั้งหมด</th>
                                    <th style="{{ $style }} max-width: 30px;">จาก</th>
                                    <th style="{{ $style }} max-width: 50px;">สถานะ</th>
                                    <th style="{{ $style }} max-width: 10px;">รายละเอียด</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($leave_forms_rep as $leave_form)
                                    <tr>
                                        <td style="{{ $style }} max-width: 40px;">
                                            {{ \Carbon\Carbon::parse($leave_form->created_at)->addYears(543)->format('d/m/Y H:i') }}
                                        </td>
                                        <td style="{{ $style }} max-width: 40px;">{{ $get_name_from[$loop->index]->name }}</td>
                                        <td style="{{ $style }} max-width: 40px;">{{ $leave_form->leave_type }}</td>
                                        <td style="{{ $style }} max-width:40px;">
                                            {{ \Carbon\Carbon::parse($leave_form->leave_start)->addYears(543)->format('d/m/Y H:i') }}
                                        </td>
                                        <td style="{{ $style }} max-width: 40px;">
                                            {{ \Carbon\Carbon::parse($leave_form->leave_end)->addYears(543)->format('d/m/Y H:i') }}
                                        </td>
                                        <td style="{{ $style }} max-width: 40px;">{{ $leave_form->leave_total }}</td>
                                        <td style="{{ $style }} max-width: 40px;">
                                            <button type="button"
                                                    class="btn btn-sm rounded-pill
                                                    @if($leave_form->status == 'กำลังดำเนินการ') btn-secondary
                                                    @elseif($leave_form->status == 'อนุมัติ') btn-success
                                                    @elseif($leave_form->status == 'ไม่อนุมัติ') btn-danger
                                                    @elseif($leave_form->status == 'หมดอายุ') btn-outline-info
                                                    @elseif($leave_form->status == 'ยกเลิกใบลา') btn-info
                                                    @else btn-warning
                                                    @endif ">
                                                {{ $leave_form->status }}</button>
                                        </td>
                                        <td style="{{ $style }} max-width: 20px;">
                                            <a href="{{ route('rep.detail', $leave_form->id) }}">
                                                <i class="fas fa-file-invoice"></i>
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
                {{-- end รายการคำขอใบลา --}}
            </div>
            {{-- end ตารางรายการคำขอปฏิบัติแทน --}}
        </div>

    </section>
    {{-- end ตาราง --}}
@endsection

@section('scripts')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script>
        $("#req_list_table").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "order": false,
            "pageLength": 25,
        });
        $("#req_list_table1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "order": false,
            "pageLength": 25,
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script type="text/javascript">
        var xValues = @json($labels);
        var yValues = {{ $data }};
        var barColors = ["red", "green", "blue", "orange", "purple", "pink", "yellow", "cyan", "magenta", "teal", "lime"];

        new Chart("leave_chart_of_years", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    label: 'จำนวนการลาในเดือนนั้นๆ(/ครั้ง)',
                    backgroundColor: barColors,
                    data: yValues,
                    pointStyle: 'circle', // Add the pointStyle property here
                    pointRadius: 5, // Adjust the pointRadius as needed
                    pointBorderColor: 'rgba(0,0,0,0)', // Set the point border color to transparent
                    pointBackgroundColor: barColors, // Set the point background color to match the bar color
                    pointHitRadius: 10,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 10
                    }
                },
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                    },
                }
            },
        });
    </script>

@endsection
