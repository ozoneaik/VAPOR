@extends('layouts.layout')
@section('title','รายการคำขอใบลา/รายละเอียด')

@section('style')
@endsection

@section('content')
    <div class="content">
        {{-- Part --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb text-start">
                            <li class="breadcrumb-item">รายการคำขอ</li>
                            <li class="breadcrumb-item active"><a href="{{ route('req') }}">รายการคำขอใบลา</a></li>
                            <li class="breadcrumb-item active">รายละเอียด</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- end part --}}
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-info alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <span>{{ $message }}</span>
                            </div>
                        @elseif($message = Session::get('error'))
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <span>{{ $message }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title font-weight-bold">
                                    <i class="fas fa-file-medical mr-2"></i>
                                    รายละเอียด
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        {{-- รายละเอียดใบลา --}}
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title font-weight-bold">
                                                    <i class="fas fa-file-invoice mr-2"></i>
                                                    รายละเอียดใบลาผู้ลา
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    {{-- รหัสพนักงาน ชื่อ-นามสกุล ตำแหน่ง --}}
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">รหัสพนักงาน</label>
                                                            <p class="form-control" readonly>
                                                                {{ $user->id }}</p>
                                                        </div>
                                                    </div>
                                                    {{-- ชื่อ-นามสกุล --}}
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">ชื่อ-นามสกุล</label>
                                                            <p class="form-control" readonly>
                                                                {{ $user->name }}</p>
                                                        </div>
                                                    </div>
                                                    {{-- ชื่อเล่น --}}
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">ชื่อเล่น</label>
                                                            <p class="form-control" readonly>
                                                                {{ $user->nick_name }}</p>
                                                        </div>
                                                    </div>
                                                    {{-- ตำแหน่ง --}}
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">ตำแหน่ง</label>
                                                            <p class="form-control" readonly>
                                                                {{ $user->position }}</p>
                                                        </div>
                                                    </div>
                                                    {{-- ประเภทการลา --}}
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">ประเภทการลา</label>
                                                            <p class="form-control" readonly>{{ $leave_form->leave_type }}</p>
                                                        </div>
                                                    </div>
                                                    {{-- ลาตังแต่ --}}
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>ลาตั้งแต่ :</label>
                                                            <div class="input-group">
                                                                <p class="form-control" readonly>
                                                                    {{ \Carbon\Carbon::parse($leave_form->leave_start)->addYears(543)->format('d/m/Y H:i') }}
                                                                </p>
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- ถึง --}}
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>ถึง :</label>
                                                            <div class="input-group">
                                                                <p class="form-control" readonly>
                                                                    {{ \Carbon\Carbon::parse($leave_form->leave_end)->addYears(543)->format('d/m/Y H:i') }}
                                                                </p>
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- ลาทั้งหมด --}}
                                                    <div class="col-md-12">
                                                        <label>ลาทั้งหมด</label>
                                                        <p class="form-control" readonly>{{ $leave_form->leave_total }}</p>
                                                    </div>
                                                    {{-- เหตุผลการลา --}}
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>เหตุผลการลา</label>
                                                            <textarea class="form-control p-2" rows="4" readonly>{{ $leave_form->reason }}</textarea>
                                                        </div>
                                                    </div>
                                                    {{-- เอกสารประกอบการลา --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">เอกสารประกอบการลา</label>
                                                            <br>
                                                            @if ($leave_form->file1)
                                                                <a href="{{ asset($leave_form->file1) }}"
                                                                   download>ดาวน์โหลด</a>
                                                            @else
                                                                <p class="text-secondary">ไม่มีเอกสารประกอบการลา</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    {{-- เอกสารประกอบการลาเพิ่มเติม (ถ้ามี) --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">เอกสารประกอบการลาเพิ่มเติม (ถ้ามี)</label>
                                                            <br>
                                                            @if ($leave_form->file2)
                                                                <a href="{{ asset($leave_form->file2) }}"
                                                                   download>ดาวน์โหลด</a>
                                                            @else
                                                                <p class="text-secondary">
                                                                    ไม่มีเอกสารประกอบการลาเพิ่มเติม</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        {{-- ระหว่างการลามอบหมายให้ --}}
                                        <div class="card  mb-3">
                                            <div class="card-header">
                                                <h3 class="card-title font-weight-bold">
                                                    <i class="fa-solid fa-user mr-2"></i>
                                                    ระหว่างการลามอบหมายให้
                                                </h3>
                                                @php
                                                    $statuses = [
                                                        'ไม่อนุมัติ' => ['style' => 'btn-danger', 'text' => 'ปฏิเสธในการปฏิบัติทำแทนแล้ว'],
                                                        'อนุมัติ' => ['style' => 'btn-success', 'text' => 'ยินยอมในการปฏิบัติทำแทนแล้ว'],
                                                        '-' => ['style' => 'btn-info', 'text' => 'ไม่มีผู้ปฏิบัติงานแทน'],
                                                        'กำลังดำเนินการ' => ['style' => 'btn-info', 'text' => 'กำลังดำเนินการ'],
                                                    ];
                                                    $status = $leave_form->approve_rep ?? 'null';
                                                @endphp
                                                <span class="card-title float-right text-sm btn btn-xs {{ $statuses[$status]['style'] }}">{{ $statuses[$status]['text'] }}</span>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    {{-- รหัสพนักงาน --}}
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">รหัสพนักงาน</label>
                                                            @if ($leave_form->sel_rep)
                                                                <p class="form-control " readonly>{{ $leave_form->sel_rep }}
                                                                </p>
                                                            @else
                                                                <p class="form-control" readonly> - </p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    {{-- ชื่อ-นามสกุล --}}
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">ชื่อ-นามสกุล</label>
                                                            @if ($leave_form->sel_rep)
                                                                <p class="form-control " readonly>
                                                                    {{ $sel_rep->name }}</p>
                                                            @else
                                                                <p class="form-control" readonly> - </p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    {{-- ชื่อเล่น --}}
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">ชื่อเล่น</label>
                                                            @if ($leave_form->sel_rep)
                                                                <p class="form-control " readonly>
                                                                    {{ $sel_rep->nick_name }}</p>
                                                            @else
                                                                <p class="form-control" readonly> - </p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    {{-- ตำแหน่ง --}}
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">ตำแหน่ง</label>
                                                            @if ($leave_form->sel_rep)
                                                                <p class="form-control " readonly>
                                                                    {{ $sel_rep->position }}</p>
                                                            @else
                                                                <p class="form-control" readonly> - </p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label
                                                                for="">กรณีไม่มีผู้ปฏิบัติงานแทนสามารถ(ติดต่อ)</label>
                                                            @if ($leave_form->case_no_rep)
                                                                <p class="form-control" readonly>
                                                                    {{ $leave_form->case_no_rep }}</p>
                                                            @else
                                                                <p class="form-control" readonly>-</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        {{-- สถานะ --}}
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title font-weight-bold">
                                                    <i class="fa-solid fa-file-waveform mr-2"></i>
                                                    สถานะ
                                                </h3>
                                            </div>
                                            <div class="card-body text-center">
                                                <h1
                                                    class="pb-4 display-3 font-weight-bold {{ $leave_form->status == 'อนุมัติ' ? 'text-success' : ($leave_form->status == 'กำลังดำเนินการ' ? 'text-secondary' : ($leave_form->status == 'ยกเลิกใบลา' ? 'text-info' : 'text-danger')) }}">
                                                    {{ $leave_form->status }}
                                                </h1>
                                                @if ($leave_form->status == 'อนุมัติ')
                                                    <h6 class="pb-3 text-muted font-weight-light">
                                                        อนุมัติเมื่อ
                                                        {{ \Carbon\Carbon::parse($leave_form->updated_at)->addYears(543)->format('d/m/Y H:i:s') }}
                                                    </h6>
                                                    <h5 class="pb-3">ผู้อนุมัติ</h5>
                                                    <h5 class="pb-3 text-muted font-weight-light">นายณัฐดนัย หอมดง</h5>
                                                    <h5 class="pb-3">
                                                        ตำแหน่ง
                                                        <span class="text-muted font-weight-light">
                                                        Solution Architect Director
                                                    </span>
                                                    </h5>
                                                @elseif($leave_form->status == 'ยกเลิกใบลา')
                                                    <h6 class="pb-3 text-muted font-weight-light">
                                                        ยกเลิกเมื่อ {{\Carbon\Carbon::parse($leave_form->updated_at)->addYears(543)->format('d/m/y H:i:s')}}
                                                    </h6>
                                                @else
                                                    @php
                                                        $array_role_names = ['Project manager (PM)', 'Human Resources (HR)', 'Solution Architect Director (CEO)'];
                                                        $array_roles = ['approve_pm', 'approve_hr', 'approve_ceo'];
                                                    @endphp

                                                    @foreach($array_roles as $array_role)
                                                        <p>
                                                            {{ $array_role_names[$loop->index] }}
                                                            <button class="btn btn-sm
                                                                @if($leave_form->$array_role == 'กำลังดำเนินการ') btn-secondary
                                                                @elseif($leave_form->$array_role == 'อนุมัติ') btn-success
                                                                @elseif($leave_form->$array_role == 'ไม่อนุมัติ') btn-danger
                                                                @else btn-info @endif">
                                                                {{ $leave_form->$array_role }}
                                                            </button>
                                                        </p>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        {{-- ความเห็น Project manager --}}
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title font-weight-bold">
                                                    <i class="fa-solid fa-comment mr-2"></i>
                                                    ความเห็น Project manager (PM)
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <span>
                                                    @if ($leave_form->reason_pm)
                                                        {{ $leave_form->reason_pm }}
                                                    @endif
                                                    @if ($leave_form->allowed_pm)
                                                        <hr>
                                                        <span class="font-weight-bold text-success">อนุญาตตามสิทธิ์พนักงาน
                                                            โดย:</span>
                                                        <br>
                                                        {{ $leave_form->allowed_pm }}
                                                    @elseif ($leave_form->not_allowed_pm)
                                                        <hr>
                                                        <span class="font-weight-bold text-danger">ไม่อนุญาตเนื่องจาก
                                                            :</span>
                                                        <br>
                                                        {{ $leave_form->not_allowed_pm }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>

                                        {{-- ความเห็น Human Resources (HR) --}}
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title font-weight-bold">
                                                    <i class="fa-solid fa-message mr-2"></i>
                                                    ความเห็น Human Resources (HR)
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <span>
                                                    @if ($leave_form->approve_hr != 'ไม่อนุมัติ')
                                                        {{ $leave_form->reason_hr }}

                                                    @endif
                                                    @if ($leave_form->approve_hr != 'อนุมัติ')
                                                        {{ $leave_form->not_allowed_hr }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>

                                        {{-- ความเห็น Solution Architect Director --}}
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title font-weight-bold">
                                                    <i class="fa-solid fa-comment-dots mr-2"></i>
                                                    ความเห็น Solution Architect Director
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <span>
                                                    @if ($leave_form->approve_ceo != 'ไม่อนุมัติ')
                                                        {{ $leave_form->reason_ceo }}
                                                    @endif
                                                    @if ($leave_form->approve_ceo != 'อนุมัติ')
                                                        {{ $leave_form->not_allowed_ceo }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ปุ่มยินยอมปฏิบัติแทน --}}
                                @if(Auth::user()->type == 'emp')
                                    @include('Buttons.btn_rep_normal')
                                {{-- ปุ่มอนุมัติ PM --}}
                                @elseif(Auth::user()->type == 'pm')
                                    @include('Buttons.btn_approve_PM_normal')
                                {{-- ปุ่มยินยอมปฏิบัติแทน กรณีผู้ลาเป็น HR --}}
                                {{-- ปุ่มอนุมัติ HR --}}
                                @elseif(Auth::user()->type == 'hr(admin)' || Auth::user()->type == 'hr')
                                    @include('Buttons.btn_approve_HR_normal')
                                {{-- ปุ่มอนุมัติ CEO --}}
                                @elseif(Auth::user()->type == 'ceo')
                                    @include('Buttons.btn_approve_CEO_normal')
                                @else
                                @endif




                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function cancelLeaveForm(leaveFormId) {
            Swal.fire({
                title: 'ยืนยันการยกเลิกใบลา',
                text: 'คุณต้องการยกเลิกใบลานี้หรือไม่?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the cancellation route when confirmed
                    window.location.href = "{{ route('cancel', ':id') }}".replace(':id', leaveFormId);
                }
            });
        }
    </script>

@endsection
