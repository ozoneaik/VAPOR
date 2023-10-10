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
                        <li class="breadcrumb-item">Solution Architect Director</li>
                        <li class="breadcrumb-item active"><a href="{{route('ceo.req.emp')}}">ใบลาพนักงาน</a></li>
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
                                รายละเอียด
                            </h3>
                        </div>
                        <div class="card-body">
                            @if ($errors->has('approve_rep'))
                                <span class="text-danger">{{ $errors->first('approve_rep') }}
                                </span>
                            @endif
                            <div class="row">
                                <div class="col-md-8">
                                    {{-- รายละเอียดใบลา --}}
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title font-weight-bold">
                                                <i class="fas fa-file-invoice mr-2"></i>
                                                รายละเอียดใบลา
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            @php
                                                $user = $users->firstWhere('id', $leaveforms->user_id);
                                            @endphp
                                            <div class="row">
                                                {{-- รหัสพนักงาน ชื่อ-นามสกุล ตำแหน่ง --}}
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">รหัสพนักงาน</label>
                                                        <p class="form-control" readonly>
                                                            {{ $leaveforms->user_id }}
                                                        </p>
                                                    </div>
                                                </div>
                                                {{-- ชื่อ-นามสกุล --}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">ชื่อ-นามสกุล</label>
                                                        <p class="form-control" readonly>
                                                            {{ $user->name }}
                                                        </p>
                                                    </div>
                                                </div>
                                                {{-- ชื่อเล่น --}}
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">ชื่อเล่น</label>
                                                        <p class="form-control" readonly>
                                                            {{ $user->nick_name }}
                                                        </p>
                                                    </div>
                                                </div>
                                                {{-- ตำแหน่ง --}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">ตำแหน่ง</label>
                                                        <p class="form-control" readonly>
                                                            {{ $user->possition }}
                                                        </p>
                                                    </div>
                                                </div>
                                                {{-- ประเภทการลา --}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">ประเภทการลา</label>
                                                        <p class="form-control" readonly>
                                                            {{ $leaveforms->leave_type }}
                                                        </p>
                                                    </div>
                                                </div>
                                                {{-- ลาตังแต่ --}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>ลาตั้งแต่ :</label>
                                                        <p class="form-control" readonly>
                                                            {{ \Carbon\Carbon::parse($leaveforms->leave_start)->addYears(543)->format('d/m/Y
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            H:i') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                {{-- ถึง --}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>ถึง :</label>
                                                        <p class="form-control" readonly>
                                                            {{ \Carbon\Carbon::parse($leaveforms->leave_end)->addYears(543)->format('d/m/Y
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            H:i') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                {{-- ลาทั้งหมด --}}
                                                <div class="col-md-12">
                                                    <label>ลาทั้งหมด</label>
                                                    <p class="form-control" readonly>
                                                        {{ $leaveforms->leave_total }}
                                                    </p>
                                                </div>
                                                {{-- เหตุผลการลา --}}
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>เหตุผลการลา</label>
                                                        @if ($leaveforms->reason)
                                                            <textarea class="form-control p-2" rows="4"
                                                                      readonly>{{ $leaveforms->reason }}</textarea>
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
                                                            <a href="{{ asset($leaveforms->file1) }}" download>
                                                                ดาวน์โหลด
                                                            </a>
                                                        @else
                                                            <p>ไม่มีเอกสารประกอบการลา</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                {{-- เอกสารประกอบการลาเพิ่มเติม (ถ้ามี) --}}
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">เอกสารประกอบการลาเพิ่มเติม (ถ้ามี)</label>
                                                        <br>
                                                        @if ($leaveforms->file2)
                                                            <a href="{{ asset($leaveforms->file2) }}" download>
                                                                ดาวน์โหลด
                                                            </a>
                                                        @else
                                                            <p>ไม่มีเอกสารประกอบการลาเพิ่มเติม</p>
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
                                            @if ($leaveforms->approve_rep == 'disapproval')
                                                <span class="card-title float-right text-sm btn btn-xs btn-danger">ปฏิเสธในการปฏิบัติทำแทนแล้ว</span>
                                            @endif
                                        </div>
                                        <div class="card-body">
                                            @php
                                                $user = $users->firstWhere('id', $leaveforms->sel_rep);
                                            @endphp
                                            <div class="row">
                                                {{-- รหัสพนักงาน --}}
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">รหัสพนักงาน</label>
                                                        @if ($leaveforms->sel_rep)
                                                            <p class="form-control " readonly>
                                                                [{{ $leaveforms->sel_rep }}]
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
                                                        @if ($leaveforms->sel_rep)
                                                            <p class="form-control " readonly>
                                                                {{ $user->name }}
                                                            </p>
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
                                                            <p class="form-control " readonly>
                                                                {{ $user->nick_name }}
                                                            </p>
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
                                                            <p class="form-control " readonly>
                                                                {{ $user->possition }}
                                                            </p>
                                                        @else
                                                            <p class="form-control" readonly> - </p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label
                                                            for="">กรณีไม่มีผู้ปฏิบัติงานแทนสามารถ(ติดต่อ)</label>
                                                        @if ($leaveforms->case_no_rep)
                                                            <p class="form-control" readonly>
                                                                {{ $leaveforms->case_no_rep }}
                                                            </p>
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
                                                class="pb-4 display-3 font-weight-bold {{ $leaveforms->status == 'อนุมัติ' ? 'text-success' : ($leaveforms->status == 'กำลังดำเนินการ' ? 'text-secondary' : 'text-danger') }}">
                                                {{ $leaveforms->status }}
                                            </h1>
                                            @if ($leaveforms->status == 'อนุมัติ')
                                                <h6 class="pb-3 text-muted font-weight-light">
                                                    อนุมัติเมื่อ {{ $leaveforms->updated_at }}
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
                                                <p class="font-weight-bold">Project manager(PM)
                                                    <button class="btn btn-sm @if($leaveforms->approve_pm == 'in_progress') btn-secondary">กำลังดำเนินการ
                                                        @elseif($leaveforms->approve_pm == 'approve')
                                                            btn-success">อนุมัติแล้ว
                                                        @elseif($leaveforms->approve_pm == 'disapproval')
                                                            btn-danger">ไม่อนุมัติ
                                                        @elseif($leaveforms->approve_pm == '-')
                                                            btn-light"> -
                                                        @endif
                                                    </button>
                                                </p>
                                                <p class="font-weight-bold">Human Resources(HR)
                                                    <button class="btn btn-sm @if($leaveforms->approve_hr == 'in_progress') btn-secondary">กำลังดำเนินการ
                                                        @elseif($leaveforms->approve_hr == 'approve')
                                                            btn-success">อนุมัติแล้ว
                                                        @elseif($leaveforms->approve_hr == 'disapproval')
                                                            btn-danger">ไม่อนุมัติ
                                                        @elseif($leaveforms->approve_hr == '-')
                                                            btn-light"> -
                                                        @endif
                                                    </button>
                                                </p>
                                                <p class="font-weight-bold">Solution Architect Director(CEO)
                                                    <button class="btn btn-sm @if($leaveforms->approve_ceo == 'in_progress') btn-secondary">กำลังดำเนินการ
                                                        @elseif($leaveforms->approve_ceo == 'approve')
                                                            btn-success">อนุมัติแล้ว
                                                        @elseif($leaveforms->approve_ceo == 'disapproval')
                                                            btn-danger">ไม่อนุมัติ
                                                        @elseif($leaveforms->approve_ceo == '-')
                                                            btn-light"> -
                                                        @endif
                                                    </button>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- ความเห็น Project manager --}}
                                    @if ($leaveforms->approve_pm != 'in_progress' && $leaveforms->approve_pm != '-')
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title font-weight-bold">
                                                    <i class="fa-solid fa-comment mr-2"></i>
                                                    ความเห็น Project manager (PM)
                                                </h3>
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
                                                        <span
                                                            class="font-weight-bold text-danger">ไม่อนุญาตเนื่องจาก:</span>
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
                                                    ความเห็น Human Resources (HR)
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <span>
                                                    @if ($leaveforms->approve_hr != 'disapproval')
                                                        @if ($leaveforms->reason_hr)
                                                            {!! $leaveforms->reason_hr !!}
                                                        @else
                                                            ไม่มีความเห็น
                                                        @endif
                                                    @endif
                                                    @if ($leaveforms->approve_hr != 'approve')
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
                                                    ความเห็น Solution Architect Director
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <span>
                                                    @if ($leaveforms->approve_ceo != 'disapproval')
                                                        @if ($leaveforms->reason_ceo)
                                                            {{ $leaveforms->reason_ceo }}
                                                        @else
                                                            ไม่มีความเห็น
                                                        @endif
                                                    @endif
                                                    @if ($leaveforms->approve_ceo != 'approve')
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
                            <form action="{{ route('ceo.req.emp.update', $leaveforms->id) }}" method="post">
                                @csrf
                                {{-- อนุมัติ CEO --}}
                                <div class="col-md-12 justify-content-end d-flex pr-0">
                                    @if ($leaveforms->approve_ceo != 'in_progress')
                                        <span class="text-danger">ไม่สามารถแก้ไขได้ เนื่องจากคุณได้ดำเนินการแล้ว</span>
                                    @endif
                                </div>

                                <div class="col-md-12 justify-content-end d-flex pr-0">
                                    <button type="button" class="btn btn-danger mr-3 " name="approve_ceo"
                                            value="disapproval" @if ($leaveforms->approve_ceo != 'in_progress') disabled @endif>
                                        ไม่อนุมัติ
                                    </button>
                                    <button type="button" class="btn btn-primary" name="approve_ceo" value="approve"
                                            @if ($leaveforms->approve_ceo != 'in_progress') disabled @endif>
                                        อนุมัติ
                                    </button>
                                    <input type="hidden" name="approve_ceo" value="{{ $leaveforms->approve_ceo }}"/>
                                </div>

                                <!-- Modal อนุมัติ CEO -->
                                <div class="modal fade" id="confirmModal_ceo" tabindex="-1" role="dialog"
                                     aria-labelledby="confirmModalLabel_ceo" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmModalLabel_ceo">บันทึกข้อมูล</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="form-group reason_ceo">
                                                    <label for="reason_ceo">ความเห็น Solution Architect Director</label>
                                                    @if ($errors->has('reason_ceo'))
                                                        <span class="text-danger">
                                                            {{ $errors->first('reason_ceo') }}
                                                        </span>
                                                    @endif
                                                    <textarea
                                                        class="form-control @error('reason_ceo') is-invalid @enderror"
                                                        id="reason_ceo" name="reason_ceo"
                                                        rows="3"></textarea>
                                                </div>

                                                <div class="form-group" id="not_allowed_ceo">
                                                    <label for="not_allowed_ceo">ความเห็น Solution Architect
                                                        Director</label>
                                                    @if ($errors->has('not_allowed_ceo'))
                                                        <span class="text-danger">
                                                            {{ $errors->first('not_allowed_ceo') }}
                                                        </span>
                                                    @endif
                                                    <textarea
                                                        class="form-control @error('not_allowed_ceo') is-invalid @enderror"
                                                        name="not_allowed_ceo" id=""
                                                        cols="30" rows="4"></textarea>
                                                </div>

                                                <span class="content"></span>
                                                <br>
                                                <span
                                                    class="text-danger">*เมื่อกดยืนยันคุณจะไม่สามารถกลับมาแก้ไขได้</span>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด
                                                </button>
                                                <button type="submit" class="btn btn-primary">ยืนยัน</button>
                                            </div>
                                            <input type="hidden" name="approve_ceo" value="">
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end container fluid --}}
    </section>
    {{-- end mian content --}}
@endsection
