@extends('layouts.layout')
@section('title','ข้อมูลพนักงาน')
@section('content')
    {{-- Part --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb text-start">
                        <li class="breadcrumb-item">ข้อมูลพนักงาน</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{-- end part --}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">
                                รายละเอียด
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-7">
                                    {{-- ข้อมูลพนักงาน --}}
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title font-weight-bold">
                                                <i class="fas fa-file-invoice mr-2"></i>
                                                ข้อมูลพนักงาน
                                            </h3>
                                            <style>
                                                .d1:hover {
                                                    background: red !important;
                                                    border-radius: 10px;
                                                }
                                            </style>
                                        @if(Auth::user()->type == 'hr(admin)')
                                                <form action="{{ route('hr.delete', $user->id) }}" method="POST" class="float-right">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="d1" style="border:none; background: none" data-toggle="modal" data-target="#deleteModal">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">ยืนยันการลบ</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            คุณต้องการลบบัญชีผู้ใช้นี้ใช่หรือไม่ ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                                            <form action="{{ route('hr.delete', $user->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">ยืนยัน</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="card-body">
                                            <div class="row">
                                                {{-- รหัสพนักงาน ชื่อ-นามสกุล ตำแหน่ง --}}
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">รหัสพนักงาน</label>
                                                        <p class="form-control" readonly>
                                                            {{ $user->id }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="">ชื่อ - นามสกุล</label>
                                                        <p class="form-control" readonly>
                                                            {{ $user->name }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">ชื่อเล่น</label>
                                                        <p class="form-control" readonly>
                                                            {{ $user->nick_name }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">ตำแหน่ง</label>
                                                        <p class="form-control" readonly>
                                                            {{ $user->possition }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">วันเดือนปีเกิด</label>
                                                        <p class="form-control" readonly>
                                                            {{ $user->birthday }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">อีเมล</label>
                                                        <p class="form-control" readonly>
                                                            {{ $user->email }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">เบอร์โทรศัพท์</label>
                                                        <p class="form-control" readonly>
                                                            {{ $user->phone_no_1 }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">เบอร์โทรศัพท์(สำรอง)</label>
                                                        <p class="form-control" readonly>
                                                            {{ $user->phone_no_2 }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">ที่อยู่</label>
                                                        <p class="form-control" readonly>
                                                            {{ $user->address }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    {{-- ข้อมูลการลา --}}
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title font-weight-bold">
                                                <i class="fas fa-file-invoice mr-2"></i>
                                                ข้อมูลการลา
                                            </h3>
                                            <style>
                                                .b1:hover {
                                                    background: greenyellow !important;
                                                    border-radius: 10px;
                                                }
                                            </style>
                                            @if(Auth::user()->type == 'hr(admin)')
                                                <button data-toggle="modal" data-target=".bd-example-modal-lg"
                                                        type="button"
                                                        class="float-right b1" style="border:none; background: none">
                                                    <i class="fa-solid fa-pen-to-square "></i>
                                                </button>
                                            @endif
                                            <form action="{{route('leave.update',$user->id)}}" method="post">
                                                @csrf
                                                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                                                     aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    แก้ไขข้อมูลการลา</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table table-bordered mb-0 text-center">
                                                                    <thead>
                                                                    <tr>
                                                                        <th rowspan="2" colspan="1"
                                                                            class="table-white ">
                                                                            ประเภทการลา
                                                                        </th>
                                                                        <th rowspan="1" colspan="3"
                                                                            class="table-warning ">
                                                                            ลาไปแล้ว
                                                                        </th>
                                                                        <th rowspan="1" colspan="3" class="table-info ">
                                                                            ลาคงเหลือ
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="table-warning ">วัน</th>
                                                                        <th class="table-warning ">ชั่วโมง</th>
                                                                        <th class="table-warning ">นาที</th>
                                                                        <th class="table-info ">วัน</th>
                                                                        <th class="table-info ">ชั่วโมง</th>
                                                                        <th class="table-info ">นาที</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @php
                                                                        $i = -1;
                                                                        $totalMinutes2 = array();
                                                                    @endphp
                                                                    @foreach($leave_datas as $leave_data)
                                                                            <?php
                                                                            $i = $i + 1;
                                                                            ?>
                                                                        <tr>
                                                                            <td class="table-white ">{{ $leave_data->leave_type_name }}</td>
                                                                            @php
                                                                                $parts = explode(' ', $leave_data->time_already_used);
                                                                                $D = (int)$parts[0];
                                                                                $H = (int)$parts[2];
                                                                                $M = (int)$parts[4];
                                                                                $totalMinutes = ($D * 8 * 60) + ($H * 60) + $M;
                                                                                $parts = explode(' ', $leave_data->time_remain);
                                                                                $D1 = (int)$parts[0];
                                                                                $H1 = (int)$parts[2];
                                                                                $M1 = (int)$parts[4];
                                                                                $totalMinutes1 = ($D1 * 8 * 60) + ($H1 * 60) + $M1;
                                                                                $style = 'width: 55px;border-radius: 5px; border:red';
                                                                                $totalMinutes2[$i] = $totalMinutes1 + $totalMinutes;
                                                                                error_log($totalMinutes2[0]);
                                                                            @endphp
                                                                            <td class="table-warning">
                                                                                <input type="number" min="0"
                                                                                       value="{{ $D }}"
                                                                                       style="{{$style}}"
                                                                                       name="D_used{{$i}}"
                                                                                       onchange="calculateRemain({{$i}},{{$totalMinutes2[$i]}})"
                                                                                       onkeydown="handleKeyDown(event)">
                                                                            </td>


                                                                            <td class="table-warning ">
                                                                                <input type="number" min="0" max="7"
                                                                                       value="{{ $H }}"
                                                                                       style="{{$style}}"
                                                                                       name="H_used{{$i}}"
                                                                                       onchange="calculateRemain({{$i}},{{$totalMinutes2[$i]}})"
                                                                                       onkeydown="handleKeyDown(event)">

                                                                            </td>
                                                                            <td class="table-warning ">
                                                                                <input type="number" min="0" max="59"
                                                                                       value="{{ $M }}"
                                                                                       style="{{$style}}"
                                                                                       name="M_used{{$i}}"
                                                                                       onchange="calculateRemain({{$i}},{{$totalMinutes2[$i]}})"
                                                                                       onkeydown="handleKeyDown(event)">
                                                                            </td>
                                                                            <td class="table-info">
                                                                                <input type="number" min="0"
                                                                                       value="{{ $D1 }}"
                                                                                       style="{{$style}}"
                                                                                       name="D_remain{{$i}}" readonly>
                                                                            </td>
                                                                            <td class="table-info ">
                                                                                <input type="number" min="0" max="7"
                                                                                       value="{{ $H1 }}"
                                                                                       style="{{$style}}"
                                                                                       name="H_remain{{$i}}" readonly>
                                                                            </td>
                                                                            <td class="table-info ">
                                                                                <input type="number" min="0" max="59"
                                                                                       value="{{ $M1 }}"
                                                                                       style="{{$style}}"
                                                                                       name="M_remain{{$i}}" readonly>
                                                                            </td>
                                                                        </tr>

                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">ปิด
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">บันทึก
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table class="table table-bordered mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th>ประเภทการลา</th>
                                                            <th>ลาไปแล้ว</th>
                                                            <th>ลาคงเหลือ</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($leave_datas as $leave_data)
                                                            <tr>
                                                                <td>{{ $leave_data->leave_type_name }}</td>
                                                                <td>{{ $leave_data->time_already_used }}</td>
                                                                <td>{{ $leave_data->time_remain }}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{-- ประวัติการของ --}}
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">
                                <i class="fas fa-user mr-2"></i>
                                ประวัติการลาของ {{$user->name}} ({{$user->nick_name}})</h3>
                        </div>
                        @php
                            $style = 'white-space: nowrap; overflow: hidden; text-overflow: ellipsis;';

                        @endphp
                        <div class="card-body">
                            <table id="data-table" class="table table-bordered table-hover text-center">
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
                                @foreach ($leaves as $row)
                                    <tr>
                                        <td style="{{ $style }} max-width: 40px;">{{ \Carbon\Carbon::parse($row->created_at)->addYears(543)->format('d/m/Y H:i') }}
                                        </td>
                                        <td style="{{ $style }} max-width: 40px;">{{ $row->leave_type }}</td>
                                        <td style="{{ $style }} max-width:40px;">{{ \Carbon\Carbon::parse($row->leave_start)->addYears(543)->format('d/m/Y H:i') }}
                                        </td>
                                        <td style="{{ $style }} max-width: 40px;">{{ \Carbon\Carbon::parse($row->leave_end)->addYears(543)->format('d/m/Y H:i') }}
                                        </td>
                                        <td style="{{ $style }} max-width: 40px;">{{ $row->leave_total }}</td>
                                        @if (!$row->sel_rep || $row->approve_rep == '❌')
                                            <td style="{{ $style }} max-width: 40px;">
                                                ไม่มีผู้ปฏิบัติแทน @if($row->approve_rep == '❌')
                                                    ถูกปฏิเสธ
                                                @endif</td>
                                        @else
                                            <td style="{{ $style }} max-width: 40px;">{{ $row->representative->name }}</td>
                                        @endif
                                        <td style="{{ $style }} max-width: 40px;" class="">
                                            <button class="btn btn-sm rounded-pill text-dark" style="background-color: @if($row->status == 'อนุมัติ') #c8ffd5 @elseif($row->status == 'กำลังดำเนินการ') #efefef @else #ff9292 @endif;">
                                                {{ $row->status }}
                                            </button>
                                        </td>
                                        <td style="{{ $style }} max-width: 20px;">
                                            <a href="{{ route('data.user.history', $row->id) }}">
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
            </div>
        </div>
    </div>

    {{--  คำนวนวันลาแบบเรียลทาม  --}}
    <script>
        function calculateRemain(index, totalMinutes2) {
            console.log("index", index, 'total', totalMinutes2);
            var D_used = parseInt(document.getElementsByName('D_used' + index)[0].value);
            var H_used = parseInt(document.getElementsByName('H_used' + index)[0].value);
            var M_used = parseInt(document.getElementsByName('M_used' + index)[0].value);
            var totalMinutes = (D_used * 8 * 60) + (H_used * 60) + M_used;

            var D_remain_input = document.getElementsByName('D_remain' + index)[0];
            var H_remain_input = document.getElementsByName('H_remain' + index)[0];
            var M_remain_input = document.getElementsByName('M_remain' + index)[0];

            var remainingMinutes = totalMinutes2 - totalMinutes;

            var newD_remain = Math.floor(remainingMinutes / (8 * 60));
            remainingMinutes %= 8 * 60;
            var newH_remain = Math.floor(remainingMinutes / 60);
            remainingMinutes %= 60;
            var newM_remain = remainingMinutes;

            D_remain_input.value = newD_remain;
            H_remain_input.value = newH_remain;
            M_remain_input.value = newM_remain;
        }
    </script>
    <script>
        function updateRemainingValue1(input, $H2, index) {
            var value = parseInt(input.value);
            var remainingField = document.getElementsByName('D_remain' + index)[1];
            var usedField = document.getElementsByName('D_used' + index)[1];
            $H2 -= value;
            remainingField.value = $H2 < 0 ? 0 : $H2;
            usedField.value = value;
            console.log($H2, remainingField.value, usedField.value);
        }
    </script>

    {{-- ดักจับคีย์บอรืดไม่ให้พิมพ์ตัวเลข --}}
    <script>
        function handleKeyDown(event) {
            if (event.keyCode !== 38 && event.keyCode !== 40) {
                event.preventDefault();
            }
        }
    </script>
@endsection
