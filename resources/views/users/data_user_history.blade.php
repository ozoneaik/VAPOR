@extends('layouts.layout')

@section('title')
    {{ 'รายการคำขอใบลา/รายละเอียด' }}
@endsection

@section('content')
    {{-- Part --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb text-start">
                        <li class="breadcrumb-item">ข้อมูลพนักงาน</li>
                        <li class="breadcrumb-item active"><a href="{{route('data.user.detail',$leaveforms->user_id)}}">รายละเอียดข้อมูลพนักงาน</a></li>
                        <li class="breadcrumb-item active">รายละเอียด</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{-- end part --}}

    {{-- Mian Content --}}
    <section class="content">
        {{-- Container Fluid --}}
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">
                                <i class="fas fa-file-medical mr-2"></i>
                                รายละเอียด </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    {{-- รายละเอียดใบลา --}}
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title font-weight-bold">
                                                <i class="fas fa-file-invoice mr-2"></i>
                                                รายละเอียดใบลา </h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                {{-- รหัสพนักงาน ชื่อ-นามสกุล ตำแหน่ง --}}
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">รหัสพนักงาน</label>
                                                        <p class="form-control" readonly>{{$leaveforms->relation_user->id}}</p>
                                                    </div>
                                                </div>
                                                {{-- ชื่อ-นามสกุล --}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">ชื่อ-นามสกุล</label>
                                                        <p class="form-control" readonly>{{$leaveforms->relation_user->name}}</p>
                                                    </div>
                                                </div>
                                                {{-- ชื่อเล่น --}}
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">ชื่อเล่น</label>
                                                        <p class="form-control" readonly>{{$leaveforms->relation_user->nick_name}}</p>
                                                    </div>
                                                </div>
                                                {{-- ตำแหน่ง --}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">ตำแหน่ง</label>
                                                        <p class="form-control" readonly>{{$leaveforms->relation_user->possition}}</p>
                                                    </div>
                                                </div>
                                                {{-- ประเภทการลา --}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">ประเภทการลา</label>
                                                        <p class="form-control" readonly>{{ $leaveforms->leave_type }}</p>
                                                    </div>
                                                </div>
                                                {{-- ลาตังแต่ --}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>ลาตั้งแต่ :</label>
                                                        <div class="input-group">
                                                            <p class="form-control" readonly>{{ \Carbon\Carbon::parse($leaveforms->leave_start)->addYears(543)->format('d/m/Y H:i') }}</p>
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
                                                            <p class="form-control" readonly>{{ \Carbon\Carbon::parse($leaveforms->leave_end)->addYears(543)->format('d/m/Y H:i') }}</p>
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
                                                    <p class="form-control" readonly>{{ $leaveforms->leave_total }}</p>
                                                </div>
                                                {{-- เหตุผลการลา --}}
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>เหตุผลการลา</label>
                                                        @if ($leaveforms->reason)
                                                            <textarea class="form-control p-2" rows="4" readonly>{{ $leaveforms->reason }}</textarea>
                                                        @else
                                                            <textarea class="form-control p-2" rows="4" readonly>ไม่ได้กรอกเหตุผลการลา</textarea>
                                                        @endif
                                                    </div>
                                                </div>
                                                {{-- เอกสารประกอบการลา --}}
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">เอกสารประกอบการลา</label>
                                                        <br>
                                                        @if ($leaveforms->file1)
                                                            <a href="{{ asset($leaveforms->file1) }}" download>ดาวน์โหลด</a>
                                                        @else
                                                            <p class="text-secondary">ไม่มีเอกสารประกอบการลา</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                {{-- เอกสารประกอบการลาเพิ่มเติม (ถ้ามี) --}}
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">เอกสารประกอบการลาเพิ่มเติม (ถ้ามี)</label>
                                                        <br>
                                                        @if ($leaveforms->file2)
                                                            <a href="{{ asset($leaveforms->file2) }}" download>ดาวน์โหลด</a>
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
                                                ระหว่างการลามอบหมายให้ </h3>
                                            @if ($leaveforms->approve_rep == 'disapproval')
                                                <span class="card-title float-right text-sm btn btn-xs btn-danger">ปฏิเสธในการปฏิบัติทำแทนแล้ว</span>
                                            @elseif($leaveforms->approve_rep == 'approve')
                                                <span class="card-title float-right text-sm btn btn-xs btn-success">ยินยอมในการปฏิบัติทำแทนแล้ว</span>
                                            @elseif(is_null($leaveforms->sel_rep))
                                                <span class="card-title float-right text-sm btn btn-xs btn-info">ไม่มีผู้ปฏิบัติงานแทน</span>
                                            @else
                                                <span class="card-title float-right text-sm btn btn-xs btn-info">กำลังดำเนินการ</span>
                                            @endif
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                {{-- รหัสพนักงาน --}}
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">รหัสพนักงาน</label>
                                                        @if ($leaveforms->sel_rep)
                                                            <p class="form-control " readonly>{{ $leaveforms->sel_rep }}</p>
                                                        @else
                                                            <p class="form-control" readonly> - </p>
                                                        @endif
                                                    </div>
                                                </div>
                                                {{-- ชื่อ-นามสกุล --}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">ชื่อ-นามสกุล</label>
                                                        @if ($leaveforms->sel_rep)
                                                            <p class="form-control " readonly>{{$leaveforms->representative->name}}</p>
                                                        @else
                                                            <p class="form-control" readonly> - </p>
                                                        @endif
                                                    </div>
                                                </div>
                                                {{-- ชื่อเล่น --}}
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">ชื่อเล่น</label>
                                                        @if ($leaveforms->sel_rep)
                                                            <p class="form-control " readonly>{{$leaveforms->representative->nick_name}}</p>
                                                        @else
                                                            <p class="form-control" readonly> - </p>
                                                        @endif
                                                    </div>
                                                </div>
                                                {{-- ตำแหน่ง --}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">ตำแหน่ง</label>
                                                        @if ($leaveforms->sel_rep)
                                                            <p class="form-control " readonly>{{ $leaveforms->representative->possition }}</p>
                                                        @else
                                                            <p class="form-control" readonly> - </p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">กรณีไม่มีผู้ปฏิบัติงานแทนสามารถ(ติดต่อ)</label>
                                                        @if ($leaveforms->case_no_rep)
                                                            <p class="form-control" readonly>{{ $leaveforms->case_no_rep }}</p>
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
                                            <h1 class="pb-4 display-3 font-weight-bold {{ $leaveforms->status == 'อนุมัติ' ? 'text-success' : ($leaveforms->status == 'กำลังดำเนินการ' ? 'text-secondary' : 'text-danger') }}">
                                                {{ $leaveforms->status }}
                                            </h1>
                                            @if ($leaveforms->status == 'อนุมัติ')
                                                <h6 class="pb-3 text-muted font-weight-light">
                                                    อนุมัติเมื่อ
                                                    {{ \Carbon\Carbon::parse($leaveforms->updated_at)->addYears(543)->format('d/m/Y H:i:s') }}
                                                </h6>
                                                <h5 class="pb-3">ผู้อนุมัติ</h5>
                                                <h5 class="pb-3 text-muted font-weight-light">นายณัฐดนัย หอมดง</h5>
                                                <h5 class="pb-3">
                                                    ตำแหน่ง
                                                    <span class="text-muted font-weight-light">
                                                            Solution Architect Director
                                                        </span>
                                                </h5>
                                            @else
                                                @if($leaveforms->approve_pm == 'in_progress')
                                                    <p>Project manager (PM)
                                                        <button class="btn btn-sm btn-secondary">กำลังดำเนินการ</button>
                                                    </p>
                                                @elseif($leaveforms->approve_pm == 'approve' || $leaveforms->approve_pm == '-')
                                                    @if($leaveforms->approve_pm == 'approve')
                                                        <p>Project manager (PM)
                                                            <button class="btn btn-sm btn-success">อนุมัติ</button>
                                                        </p>
                                                    @else
                                                        <p>Project manager (PM)
                                                            <button class="btn btn-sm btn-secondary">-</button>
                                                        </p>
                                                    @endif
                                                    @if($leaveforms->approve_hr == 'in_progress')
                                                        <p>Human Resources(HR)
                                                            <button class="btn btn-sm btn-secondary">กำลังดำเนินการ
                                                            </button>
                                                        </p>
                                                    @elseif($leaveforms->approve_hr == 'approve' || $leaveforms->approve_hr == '-')
                                                        @if($leaveforms->approve_hr == 'approve')
                                                            <p>Human Resources(HR)
                                                                <button class="btn btn-sm btn-success">อนุมัติ</button>
                                                            </p>
                                                        @else
                                                            <p>Human Resources(HR)
                                                                <button class="btn btn-sm btn-secondary">-</button>
                                                            </p>
                                                        @endif
                                                        @if($leaveforms->approve_ceo == 'in_progress')
                                                            <p>Solution Architect Director
                                                                <button class="btn btn-sm btn-secondary">
                                                                    กำลังดำเนินการ
                                                                </button>
                                                            </p>
                                                        @elseif($leaveforms->approve_ceo == 'disapproval')
                                                            <p>Solution Architect Director
                                                                <button class="btn btn-sm btn-danger">ไม่อนุมัติ
                                                                </button>
                                                            </p>
                                                        @endif
                                                    @elseif($leaveforms->approve_hr == 'disapproval')
                                                        <p>Human Resources(HR)
                                                            <button class="btn btn-sm btn-danger">ไม่อนุมัติ</button>
                                                        </p>
                                                    @endif
                                                @elseif($leaveforms->approve_pm == 'disapproval')
                                                    <p>Project manager (PM)
                                                        <button class="btn btn-sm btn-danger">ไม่อนุมัติ</button>
                                                    </p>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                    {{-- ความเห็น Project manager --}}
                                    @if ($leaveforms->approve_pm != 'in_progress' && $leaveforms->approve_pm != '-')
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title font-weight-bold">
                                                    <i class="fa-solid fa-comment mr-2"></i>
                                                    ความเห็น Project manager (PM) </h3>
                                            </div>
                                            <div class="card-body">
                                                    <span>
                                                        @if ($leaveforms->reason_pm)
                                                            {{ $leaveforms->reason_pm }}
                                                        @else
                                                            ไม่มีความเห็น
                                                        @endif
                                                        @if ($leaveforms->allowed_pm)
                                                            <hr>
                                                            <span class="font-weight-bold text-success">อนุญาตตามสิทธิ์พนักงาน
                                                                โดย:</span>
                                                            <br>
                                                            {{ $leaveforms->allowed_pm }}
                                                        @elseif ($leaveforms->not_allowed_pm)
                                                            <hr>
                                                            <span class="font-weight-bold text-danger">ไม่อนุญาตเนื่องจาก
                                                                :</span>
                                                            <br>
                                                            {{ $leaveforms->not_allowed_pm }}
                                                        @endif
                                                    </span>
                                            </div>
                                        </div>
                                    @endif
                                    {{-- ความเห็น Human Resources (HR) --}}
                                    @if ($leaveforms->approve_hr != 'in_progress' && $leaveforms->approve_hr != '-')
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title font-weight-bold">
                                                    <i class="fa-solid fa-message mr-2"></i>
                                                    ความเห็น Human Resources (HR) </h3>
                                            </div>
                                            <div class="card-body">
                                                <span>
                                                    @if($leaveforms->approve_hr != 'disapproval')
                                                        @if ($leaveforms->reason_hr)
                                                            {{ $leaveforms->reason_hr}}
                                                        @else
                                                            ไม่มีความเห็น
                                                        @endif
                                                    @endif
                                                    @if($leaveforms->approve_hr != 'approve')
                                                        @if ($leaveforms->not_allowed_hr)
                                                            {{ $leaveforms->not_allowed_hr }}
                                                        @else
                                                            ไม่มีความเห็น
                                                        @endif
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                    {{-- ความเห็น Solution Architect Director --}}
                                    @if ($leaveforms->approve_ceo != 'in_progress' && $leaveforms->approve_ceo != '-')
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title font-weight-bold">
                                                    <i class="fa-solid fa-comment-dots mr-2"></i>
                                                    ความเห็น Solution Architect Director </h3>
                                            </div>
                                            <div class="card-body">
                                                <span>
                                                    @if($leaveforms->approve_ceo != 'disapproval')
                                                        @if ($leaveforms->reason_ceo)
                                                            {{ $leaveforms->reason_ceo}}
                                                        @else
                                                            ไม่มีความเห็น
                                                        @endif
                                                    @endif
                                                    @if($leaveforms->approve_ceo != 'approve')
                                                        @if ($leaveforms->not_allowed_ceo)
                                                            {{ $leaveforms->not_allowed_ceo }}
                                                        @else
                                                            ไม่มีความเห็น
                                                        @endif
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            {{-- ปุ่มบันทึกการลา --}}
                            <div class="col-md-12 justify-content-end d-flex ">
                                @if ($leaveforms->status == 'อนุมัติ')
                                    <a href="{{route('pdf',$leaveforms->id)}}" class="btn btn-info mr-3" target="_blank">พิมพ์ใบลา</a>
                                @endif
                                <a href="{{ route('req') }}" class="btn btn-primary">ย้อนกลับ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- end container fluid --}}
    </section>
    {{-- end mian content --}}
@endsection
