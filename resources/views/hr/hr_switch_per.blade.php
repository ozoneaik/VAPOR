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
                        <li class="breadcrumb-item">โอนสิทธิ์อนุมัติใบลาพนักงาน /</li>
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
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">โอนสิทธิ์อนุมัติใบลาพนักงาน</h3>
                        </div>
                        <form action="{{ route('hr.update.per')}}" method="get">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="select_hr">เลือก HR ที่ต้องการโอนสิทธิ์ให้</label>
                                    <select class="form-control select2" name="select_hr" style="width: 100%">
                                    @foreach($HRs as $HR)
                                            <option value="{{ $HR->id }}">{{ $HR->name }}</option> <!-- Use the name as the value -->
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer d-flex flex-row-reverse">
                            <button class="btn btn-primary ml-2" type="button" data-toggle="modal" data-target="#update_hr">
                                บันทึก
                            </button>
                            </div>
                            {{-- Modal --}}
                            <div class="modal fade" id="update_hr">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">บันทึกข้อมูล</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>ยืนยันการโอนสิทธิ์หรือไม่?</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                ยกเลิก
                                            </button>
                                                <button type="submit" class="btn btn-primary">ยืนยัน</button>

                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            {{-- end modal --}}




                        </form>

                    </div>
                </div>
            </div>
        </div>
        {{-- end container fluid --}}
    </section>
    {{-- end mian content --}}
@endsection
