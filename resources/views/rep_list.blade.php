@extends('layouts.layout')

@if(Request::routeIs('req'))
    @section('title','รายการคำขอใบลา')
@endif

@section('style')
    {{-- Date Picker ใช้ flatpickr --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    {{-- Data tables --}}
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    {{-- Part --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb text-start">
                        <li class="breadcrumb-item">รายการคำขอ</li>
                        <li class="breadcrumb-item active">รายการคำขอใบลา</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{-- end part --}}

    <section class="content">
        <div class="container-fluid">

            {{-- ปุ่มเพิ่มใบลา --}}
            <div class="row">
                <div class="col-md-12 d-flex justify-content-end mb-3">
                    <a href="{{ route('create') }}">
                        <button class="btn btn-primary"><i class="fa-solid fa-plus"></i> เพิ่มใบลา</button>
                    </a>
                </div>
            </div>
            {{-- end ปุ่มเพิ่มใบลา --}}

            {{-- ตารางคำขอใบลา --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">
                                <i class="fas fa-list-alt mr-2"></i>
                                รายการคำขอใบลา
                            </h3>
                            <a href="{{ route('refresh') }}" class= "float-right text-info">↻ รีเฟรชข้อมูล</a>
                        </div>
                        <div class="card-body">

                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <span>{{ $message }}</span>
                                </div>
                            @endif
                            {{-- data range filter --}}
                            <form action="{{route('filter.req')}}" method="get">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="datetime-local" class="form-control filter" placeholder="ลาตั้งแต่ {{Request::routeIs('filter.req') ? $start_format : ''}}" name="start" readonly>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="datetime-local" class="form-control filter" placeholder="ถึง {{Request::routeIs('filter.req') ? $end_format : ''}}" name="end" readonly>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <div class="form-group mr-2">
                                            <button type="submit" class="btn btn-success">ค้นหา</button>
                                        </div>
                                        @if(Request::RouteIs('filter.req'))

                                            <div class="form-group">
                                                <a href="{{route('req')}}">
                                                    <button type="button" class="btn btn-warning">ล้าง</button>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </form>
                            {{-- end data enage filter --}}

                            <div class="row">
                                <div class="col-md-12">
                                    @php
                                        $style = 'white-space: nowrap; overflow: hidden; text-overflow: ellipsis;';
                                    @endphp
                                    <table id="req_list_table" class="table table-bordered table-hover text-center">
                                        <thead>
                                        <tr>
                                            <th style="{{ $style }} max-width: 40px;">วันที่ยื่นคำร้อง</th>
                                            <th style="{{ $style }} max-width: 30px;">จาก</th>
                                            <th style="{{ $style }} max-width: 40px;">ประเภทการลา</th>
                                            <th style="{{ $style }} max-width: 40px;">วันที่ลาตั้งแต่</th>
                                            <th style="{{ $style }} max-width: 40px;">ถึง</th>
                                            <th style="{{ $style }} max-width: 40px;">ลาทั้งหมด</th>
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
                    </div>
                </div>
            </div>
            {{-- end ตารางคำขอใบลา --}}
        </div>
    </section>

@endsection

@section('scripts')
    {{-- Datatime Picker ใช้ flatpickr--}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/th.js"></script>
    <script>
        flatpickr(".filter", {
            "locale": "th",
            allowInput: true,
            altInput: false,
            enableTime: true,
            dateFormat: "d/m/Y H:i",
            // minDate: "today",
            minTime: '09:00',
            maxTime: '18:00',

        });
    </script>
    {{-- end datatime picker --}}

    {{-- datatable --}}
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
            "pageLength": 100,
        });
    </script>
    {{-- end datatable --}}
@endsection
