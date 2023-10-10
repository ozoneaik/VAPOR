@extends('layouts.layout')

@section('title')
    {{ 'เพิ่มใบลา' }}
@endsection
@section('style')
    {{-- Select2 (สไต dropdown) --}}
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    {{-- Date Picker ใช้ flatpickr --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')

    {{-- Part --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb text-start">
                        <li class="breadcrumb-item">รายการคำขอ</li>
                        <li class="breadcrumb-item active"><a href="{{ route('req') }}">รายการคำขอใบลา</a></li>
                        <li class="breadcrumb-item active">เพิ่มใบลา</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{-- end part --}}

    {{-- Mian Content --}}
    <section class="content">
        {{-- Example data --}}
        <?php
        $leave = ['ลาป่วย', 'ลากิจ', 'ลาพักผ่อนประจำปี', 'ลาเพื่อทำหมัน', 'ลาเพื่อฝึกอบรม', 'ลาอุปสมบท', 'ลาคลอดบุตร', 'ลารับราชการทหาร', 'ลาเพื่อสมรส'];
        ?>
        {{-- end example data --}}

        {{-- Container Fluid --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <span>{{ $message }}</span>
                        </div>
                    @endif
                </div>
            </div>
            <form action="{{ route('leaveform.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title font-weight-bold">
                                    <i class="fas fa-file-medical mr-2"></i>
                                    เพิ่มใบลา
                                </h3>
                            </div>
                            <div class="card-body">
                                {{-- รายละเอียดใบลา --}}
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title font-weight-bold">
                                            <i class="fas fa-file-invoice mr-2"></i>
                                            รายละเอียดใบลา
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            {{-- รหัสพนักงาน ชื่อ-นามสกุล ตำแหน่ง --}}
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">รหัสพนักงาน ชื่อ-นามสกุล ตำแหน่ง</label>
                                                    <input class="form-control" value="{{ Auth::user()->id }} {{ Auth::user()->name }} {{ Auth::user()->position }}" disabled>
                                                </div>
                                            </div>
                                            {{-- ประเภทการลา --}}
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="leave_type"><span style="color: red">* </span>ประเภทการลา</label>
                                                    <select name="leave_type" id="" class="form-control select2" style="width:100%;">
                                                        @foreach ($leave_types as $leave_type)
                                                            <option value="{{ $leave_type->leave_type_name }}">
                                                                {{ $leave_type->leave_type_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- ลาตังแต่ --}}
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label><span style="color: red">* </span>ลาตั้งแต่ :</label>
                                                    <div class="input-group">
                                                        <input type="datetime-local" class="form-control @error('leave_start') is-invalid @enderror" name="leave_start" id="start-date" onchange="calculate()" value="{{ old('leave_start') }}" placeholder="เลือกวันที่ลาตั้งแต่..." readonly />
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @if ($errors->has('leave_start'))
                                                        <span class="text-danger">{{ $errors->first('leave_start') }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- ถึง --}}
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label><span style="color: red">* </span>ถึง :</label>
                                                    <div class="input-group">
                                                        <input type="datetime-local" class="form-control @error('leave_end') is-invalid @enderror" name="leave_end" id="end-date" onchange="calculate()" value="{{ old('leave_end') }}" placeholder="เลือกวันที่ลาถึง..." readonly />
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @if ($errors->has('leave_end'))
                                                        <span class="text-danger">{{ $errors->first('leave_end') }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- ลาทั้งหมด --}}
                                            <div class="col-md-12">
                                                <label>ลาทั้งหมด</label>
                                                <p id="result" class="form-control"></p>
                                                <input type="hidden" id="calculated-result" name="leave_total">
                                            </div>
                                            {{-- เหตุผลการลา --}}
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>
                                                        เหตุผลการลา
                                                        <span id="reason-count" class="text-secondary text-secondary font-weight-normal">
                                                            0/255
                                                        </span>
                                                    </label>

                                                    <textarea id="reason" class="form-control @error('reason') is-invalid @enderror" rows="5" name="reason" placeholder="กรอกเหตุผลการลาที่นี่...">{{ old('reason') }}</textarea>

                                                    @if ($errors->has('reason'))
                                                        <span class="text-danger">{{ $errors->first('reason') }}</span>
                                                    @endif

                                                </div>
                                            </div>
                                            {{-- เอกสารประกอบการลา --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">เอกสารประกอบการลา</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="file1" name="file1" value="{{ old('file1', '') }}" accept=".png, .jpg, .pdf, .jpeg">
                                                            <label class="custom-file-label" for="file1">อัปโหลด</label>
                                                        </div>
                                                    </div>
                                                    @if ($errors->has('file1'))
                                                        <span class="text-danger">{{ $errors->first('file1') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- เอกสารประกอบการลาเพิ่มเติม (ถ้ามี) --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">เอกสารประกอบการลาเพิ่มเติม (ถ้ามี)</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="file2" name="file2" value="{{ old('file2', '') }}" accept=".png, .jpg, .pdf, .jpeg">
                                                            <label class="custom-file-label" for="file2">อัปโหลด</label>
                                                        </div>
                                                    </div>
                                                    @if ($errors->has('file2'))
                                                        <span class="text-danger">{{ $errors->first('file2') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (Auth::user()->type != 'pm')
                                    {{-- ระหว่างการลามอบหมายให้ --}}
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title font-weight-bold">
                                                <i class="fa-solid fa-user mr-2"></i>
                                                ระหว่างการลามอบหมายให้
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">รหัสพนักงาน ชื่อ-นามสกุล ตำแหน่ง</label>
                                                        <select name="sel_rep" id="" class="form-control select2" style="width:100%;">
                                                            @if (Auth::user()->type != 'hr' && Auth::user()->type != 'hr(admin)')
                                                                <option value="">ไม่มีผู้ปฏิบัติงานแทน</option>
                                                            @endif
                                                            @foreach ($users_reps as $users_rep)
                                                                @php
                                                                    $isDisabled = $users_rep->id == Auth::user()->id ? 'disabled="disabled"' : '';
                                                                @endphp
                                                                <option value="{{ $users_rep->id }}" {{ old('sel_rep') == $users_rep->id ? 'selected' : '' }} {{ $isDisabled }}>
                                                                    {{ $users_rep->id }} {{ $users_rep->name }} {{ $users_rep->position }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">กรณีไม่มีผู้ปฏิบัติงานแทนสามารถ(ติดต่อ)</label>
                                                        <input class="form-control @error('case_no_rep') is-invalid @enderror" type="text" name="case_no_rep" value="{{ old('case_no_rep', Auth::user()->phone_no_1) }}">
                                                        @if ($errors->has('case_no_rep'))
                                                            <span class="text-danger">
                                                                {{ $errors->first('case_no_rep') }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if (Auth::user()->type != 'hr' && Auth::user()->type != 'hr(admin)')
                                        {{-- เลือก Project manager --}}
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title font-weight-bold">
                                                    <i class="fa-solid fa-user-gear mr-2"></i>
                                                    เลือก Project manager
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">รหัสพนักงาน ชื่อ-นามสกุล ตำแหน่ง</label>
                                                            <select name="sel_pm" id="" class="form-control select2" style="width:100%;">
                                                                @foreach ($users_pms as $users_pm)
                                                                    <option value="{{ $users_pm->id }}">{{ $users_pm->id }} {{ $users_pm->name }} {{ $users_pm->position }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                {{-- ปุ่มบันทึกการลา --}}
                                <div class="col-md-12 justify-content-end d-flex ">
                                    <a href="{{ route('home') }}" class="btn btn-danger">ยกเลิก</a>
                                    <button class="btn btn-primary ml-2" type="button" data-toggle="modal" data-target="#modal-default">
                                        บันทึก
                                    </button>
                                    {{-- Modal --}}
                                    <div class="modal fade" id="modal-default">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">บันทึกข้อมูล</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>ต้องการบันทึกข้อมูลหรือไม่??</p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        ยกเลิก
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">บันทึก</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    {{-- end modal --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        {{-- end container fluid --}}
    </section>
    {{-- end mian content --}}

    {{-- Datatime Picker ใช้ flatpickr --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/th.js"></script>
    <script>
        flatpickr("#start-date , #end-date", {
            "locale": "th",
            allowInput: true,
            altInput: false,
            enableTime: true,
            dateFormat: "d/m/Y H:i",
            // minDate: "today",
            minTime: '09:00',
            maxTime: '18:00',
            // minDate: new Date(),
            // defaultDate: "now",
            // time_24hr: true,
            // disableMobile: "true",
            "disable": [
                function(date) {
                    // return true to disable
                    return (date.getDay() === 0 || date.getDay() === 6);
                }
            ],
        });
        var startDateInput = document.getElementById("start-date");
        var endDateInput = document.getElementById("end-date");

        startDateInput.addEventListener("change", function() {
            var startDate = moment(this.value, 'DD/MM/YYYY HH:mm');
            flatpickr(endDateInput, {
                locale: "th",
                allowInput: false,
                altInput: false,
                enableTime: true,
                dateFormat: "d/m/Y H:i",
                minTime: '09:00',
                maxTime: '18:00',
                defaultDate: "now",
                time_24hr: true,
                disableMobile: "true",
                // minDate: startDate.toDate(),
                "disable": [
                    function(date) {
                        // return true to disable
                        return (date.getDay() === 0 || date.getDay() === 6);
                    }
                ],
                // onChange: function (selectedDates, dateStr, instance) {
                //     var endDate = moment(selectedDates[0]);
                //     if (endDate.isBefore(startDate)) {
                //         instance.setDate(startDate.toDate(), false, 'd/m/Y H:i');
                //     }
                // }
            });
        });
    </script>
    {{-- end datatime picker --}}

    {{-- นับตัวอักษร Reason --}}
    <script>
        var reason = document.getElementById('reason');
        var reasonCount = document.getElementById('reason-count');

        reason.addEventListener('input', function() {
            var count = reason.value.length;
            reasonCount.innerHTML = count + '/255';
            if (count >= 255) {
                reasonCount.classList.add('text-danger');
                reasonCount.innerHTML = 'คุณพิมพ์เกิน 255';
            } else {
                reasonCount.classList.remove('text-danger');
            }
        });
    </script>

    {{-- Upload Files --}}
    <script>
        document.querySelectorAll('input[type="file"]').forEach((fileInput, index) => {
            fileInput.addEventListener('change', () => {
                document.querySelectorAll('.custom-file-label')[index].innerText = fileInput.files[0]?.name || '';
            });
        });
    </script>

    {{-- คำนวนหักลบ วันที่ลาตั้งแต่ - ถึง ในหน้า form.blade.php --}}
    <script>
        function calculate() {
            var startDate = moment(document.getElementById("start-date").value, 'DD/MM/YYYY HH:mm');
            var endDate = moment(document.getElementById("end-date").value, 'DD/MM/YYYY HH:mm');

            startDate.minutes(Math.max(0, Math.min(59, startDate.minutes()))).seconds(0);
            endDate.minutes(Math.max(0, Math.min(59, endDate.minutes()))).seconds(0);

            var duration = moment.duration(endDate.diff(startDate));
            var days = Math.floor(duration.asDays());
            var remainingHours = Math.floor(duration.hours() % 24);
            var minutes = Math.floor(duration.minutes() % 60);

            for (var i = 0; i <= days; i++) {
                var currentDate = moment(startDate).add(i, 'days');
                if (currentDate.isoWeekday() === 6 || currentDate.isoWeekday() === 7) {
                    days -= 1;
                }
            }
            if (startDate.hours() <= 12 && endDate.hours() >= 13) {
                remainingHours -= 1;
            }
            if (startDate.hours() >= 13 && endDate.hours() <= 12) {
                remainingHours -= 15;
            }
            if (startDate.hours() >= 13 && endDate.hours() >= 13 && startDate.hours() > endDate.hours()) {
                remainingHours -= 8;
                days -= 1;
            }

            if (remainingHours >= 8) {
                days += 1;
                remainingHours -= 8;
            }

            if (isNaN(days) || isNaN(remainingHours) || isNaN(minutes)) {
                console.log("An error occurred while calculating due to missing time selection. Setting values to 0.");
                days = 0;
                remainingHours = 0;
                minutes = 0;
            }

            var totalMinutes = minutes + remainingHours * 60;

            var result = days + " วัน " +
                Math.floor(totalMinutes / 60) + " ชั่วโมง " +
                (totalMinutes % 60) + " นาที ";

            document.getElementById("calculated-result").value = result;
            document.getElementById("result").innerHTML = result;
        }
    </script>
    {{-- end upload fliles --}}
@endsection

@section('scripts')
    {{-- Form Select 2 --}}
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $('.select2').select2()
    </script>
    {{-- end form select 2 --}}
@endsection
