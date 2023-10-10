@php use Carbon\Carbon; @endphp
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
                        <li class="breadcrumb-item">Project Manager</li>
                        <li class="breadcrumb-item active"><a href="{{route('pm.req.emp')}}">ใบลาพนักงาน</a></li>
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
                                <div class="col-md-12">
                                    @if ($errors->has('allowed_pm'))
                                        <span id="allowedPmError" class="text-danger">ถ้ากดอนุมัติกรุณาเลือก ตัวเลือกกดอนุญาตตามสิทธิ์พนักงานหลังกดยืนยันด้วยครับ</span>
                                    @endif

                                </div>
                                <div class="col-md-12">
                                    @if ($errors->has('other'))
                                        <span class="text-danger">ถ้ากดอนุมัติแล้วเป็น ตัวเลือก "อื่นๆ" พิมพ์ข้อความหลังอื่นๆด้วยครับ</span>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    {{-- รายละเอียดใบลา --}}
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title font-weight-bold">
                                                <i class="fas fa-file-invoice mr-2"></i>
                                                รายละเอียดใบลา </h3>
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
                                                            {{ Carbon::parse($leaveforms->leave_start)->addYears(543)->format('d/m/Y H:i') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                {{-- ถึง --}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>ถึง :</label>
                                                        <p class="form-control" readonly>
                                                            {{ Carbon::parse($leaveforms->leave_end)->addYears(543)->format('d/m/Y H:i') }}
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
                                                ระหว่างการลามอบหมายให้ </h3>
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
                                                                [{{ $leaveforms->sel_rep }}] </p>
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
                                                        <label for="">กรณีไม่มีผู้ปฏิบัติงานแทนสามารถ(ติดต่อ)</label>
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
                                                สถานะ </h3>
                                        </div>
                                        <div class="card-body text-center">
                                            <h1 class="pb-4 display-3 font-weight-bold {{ $leaveforms->status == 'อนุมัติ' ? 'text-success' : ($leaveforms->status == 'กำลังดำเนินการ' ? 'text-secondary' : 'text-danger') }}">
                                                {{ $leaveforms->status }}
                                            </h1>
                                            @if ($leaveforms->status == 'อนุมัติ')
                                                <h6 class="pb-3 text-muted font-weight-light">
                                                    อนุมัติเมื่อ
                                                    {{ Carbon::parse($leaveforms->updated_at)->addYears(543)->format('d/m/Y H:i:s') }}
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
                                                        <span class="font-weight-bold text-success">โดย:</span>
                                                        <br>
                                                        {{ $leaveforms->allowed_pm }}
                                                    @elseif ($leaveforms->not_allowed_pm)
                                                        <hr>
                                                        <span class="font-weight-bold text-danger">ไม่อนุญาตเนื่องจาก:</span>
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
                                                            {!! $leaveforms->reason_hr !!}
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
                            <div class="col-md-12 justify-content-end d-flex pr-0">
                                @if ($leaveforms->approve_pm != 'in_progress')
                                    <span class="text-danger">ไม่สามารถแก้ไขได้ เนื่องจากคุณได้ดำเนินการแล้ว</span>
                                @endif
                            </div>

                            <div class="row flex-row-reverse">

                                <div class="col-md-12 d-flex justify-content-end">

                                    {{-- ไม่อนุมัติ PM --}}
                                    <button type="button" class="btn btn-danger mr-3"
                                            @if ($leaveforms->approve_pm != 'in_progress') disabled
                                            @endif  data-toggle="modal" data-target="#not_confirmModal_pm">
                                        ไม่อนุมัติ
                                    </button>
                                    {{-- Modal ไม่อนุมัติ PM --}}
                                    <form action="{{ route('pm.req.emp.update', $leaveforms->id) }}" method="post">
                                        @csrf
                                        <div class="modal fade" id="not_confirmModal_pm" tabindex="-1" role="dialog"
                                             aria-labelledby="confirmModalLabel_pm" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmModalLabel_pm">
                                                            บันทึกข้อมูล</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="approve_pm" value="disapproval">
                                                        <div class="form-group" id="not_allowed">
                                                            <label for="not_allowed">ไม่อนุญาติเนื่องจาก</label>
                                                            @if($errors->has('not_allowed_pm'))
                                                                <span class="text-danger">
                                                                {{$errors->first('not_allowed_pm')}}
                                                            </span>
                                                            @endif
                                                            <textarea
                                                                    class="form-control @error('not_allowed_pm') is-invalid @enderror"
                                                                    name="not_allowed_pm" id="" cols="30"
                                                                    rows="4"></textarea>
                                                        </div>
                                                        <span>
                                                            ยืนยันที่จะไม่อนุมัติ[❌]หรือไม่?
                                                        </span>
                                                        <br>
                                                        <span class="text-danger">
                                                            *เมื่อกดยืนยันคุณจะไม่สามารถกลับมาแก้ไขได้
                                                        </span>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">
                                                            ปิด
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">ยืนยัน</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    {{-- อนุมัติ PM --}}
                                    <button type="button" class="btn btn-primary"
                                            @if ($leaveforms->approve_pm != 'in_progress') disabled
                                            @endif data-toggle="modal" data-target="#confirmModal_pm">
                                        อนุมัติ
                                    </button>
                                    {{-- modal อนุมัติ PM --}}
                                    <form action="{{ route('pm.req.emp.update', $leaveforms->id) }}" method="post">
                                        @csrf
                                        <div class="modal fade" id="confirmModal_pm" tabindex="-1" role="dialog"
                                             aria-labelledby="confirmModalLabel_pm" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmModalLabel_pm">
                                                            บันทึกข้อมูล</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group reason_pm">
                                                            <label for="reason_pm">ความเห็น Project Manager</label>
                                                            @if ($errors->has('reason_pm'))
                                                                <span class="text-danger">{{ $errors->first('reason_pm') }}
                                                            </span>
                                                            @endif
                                                            <textarea
                                                                    class="form-control @error('reason_pm') is-invalid @enderror "
                                                                    id="reason_pm" name="reason_pm" rows="3"></textarea>
                                                        </div>
                                                        <div class="form-group allowed">
                                                            <label for="allowed_pm">
                                                                เลือกตัวเลือกดังต่อไปนี้
                                                            </label>

                                                            @if ($errors->has('allowed_pm'))
                                                                <br>
                                                                <span class="text-danger">
                                                                {{ $errors->first('allowed_pm') }}
                                                            </span>
                                                            @endif
                                                            <br>
                                                            <input type="hidden" name="approve_pm" value="approve">

                                                            <div class="icheck-primary d-block">
                                                                <input type="radio" name="allowed_pm" id="0"
                                                                       value="อนุญาตตามสิทธิ์พนักงาน" required>
                                                                <label class="font-weight-normal" for="0">
                                                                    อนุญาตตามสิทธิ์พนักงาน
                                                                </label>
                                                            </div>

                                                            <div class="icheck-primary d-block">
                                                                <input type="radio" name="allowed_pm" id="3"
                                                                       value="ไม่รับค่าแรงตามจำนวนวันที่ลา" required>
                                                                <label for="3" class="font-weight-normal">
                                                                    ไม่รับค่าแรงตามจำนวนวันที่ลา
                                                                </label>
                                                            </div>

                                                            <div class="icheck-primary d-block">
                                                                <input type="radio" name="allowed_pm" id="2" value="ทำงานชดเชยเป็นจำนวน" onchange="showInputFields()" required>
                                                                <label class="font-weight-normal" for="2">ทำงานชดเชยเป็นจำนวน</label>
                                                                <input type="number" name="day" id="day" style="width: 10%; display: none;" min="0" max="150">วัน
                                                                <input type="number" name="hour" id="hour" style="width: 10%; display: none;" min="0" max="8">ชั่วโมง
                                                                <input type="number" name="minutes" id="minutes" style="width: 10%; display: none;" min="0" max="59">นาที
                                                            </div>
                                                            <div class="icheck-primary d-block">
                                                                <input type="radio" name="allowed_pm" id="4" value="อื่นๆ...">
                                                                <label class="font-weight-normal" for="4">
                                                                    อื่นๆ
                                                                    <input type="text" name="other" style="width: 350px">
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <span>
                                                            ยืนยันที่จะอนุมัติ[✔️]หรือไม่?
                                                        </span>
                                                        <br>
                                                        <span class="text-danger">*เมื่อกดยืนยันคุณจะไม่สามารถกลับมาแก้ไขได้</span>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                        <button type="submit" class="btn btn-primary">ยืนยัน</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end container fluid --}}
    </section>
    {{-- end mian content --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var radio = document.getElementsByName('allowed_pm');
            var otherInput = document.getElementsByName('other')[0];

            for (var i = 0; i < radio.length; i++) {
                radio[i].addEventListener('change', function () {
                    if (this.checked && this.value === 'อื่นๆ...') {
                        otherInput.setAttribute('required', 'required');
                    } else {
                        otherInput.removeAttribute('required');
                    }
                });
            }
        });
    </script>
    <script>
        function showInputFields() {
            var radio = document.querySelector('input[name="allowed_pm"]:checked');
            if (radio && radio.value === "ทำงานชดเชยเป็นจำนวน") {
                document.getElementById("day").style.display = "inline-block"; // show day input field
                document.getElementById("hour").style.display = "inline-block"; // show hour input field
                document.getElementById("minutes").style.display = "inline-block"; // show minutes input field
            } else {
                document.getElementById("day").style.display = "none"; // hide day input field
                document.getElementById("hour").style.display = "none"; // hide hour input field
                document.getElementById("minutes").style.display = "none"; // hide minutes input field
            }

        }
    </script>

@endsection

