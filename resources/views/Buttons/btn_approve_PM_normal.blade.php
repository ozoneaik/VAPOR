<div class="col-md-12 justify-content-end d-flex pr-0">
    @if ($leave_form->approve_pm != 'กำลังดำเนินการ')
        <span class="text-danger">ไม่สามารถแก้ไขได้ เนื่องจากคุณได้ดำเนินการแล้ว</span>
    @endif
</div>

<div class="row flex-row-reverse">

    <div class="col-md-12 d-flex justify-content-end">

        {{-- ไม่อนุมัติ PM --}}
        <button type="button" class="btn btn-danger mr-3"
                @if ($leave_form->approve_pm != 'กำลังดำเนินการ') disabled
                @endif  data-toggle="modal" data-target="#not_confirmModal_pm">
            ไม่อนุมัติ
        </button>
        {{-- Modal ไม่อนุมัติ PM --}}
        <form action="{{ route('pm.req.emp.update', $leave_form->id) }}" method="post">
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
                            <input type="hidden" name="approve_pm" value="ไม่อนุมัติ">
                            <div class="form-group" id="not_allowed">
                                <label for="not_allowed">ไม่อนุญาติเนื่องจาก</label>
                                @if($errors->has('not_allowed_pm'))
                                    <span class="text-danger">{{$errors->first('not_allowed_pm')}}</span>
                                @endif
                                <textarea
                                    class="form-control @error('not_allowed_pm') is-invalid @enderror"
                                    name="not_allowed_pm" id="" cols="30"
                                    rows="4"></textarea>
                            </div>
                            <span>ยืนยันที่จะไม่อนุมัติ[❌]หรือไม่?</span>
                            <br>
                            <span class="text-danger">*เมื่อกดยืนยันคุณจะไม่สามารถกลับมาแก้ไขได้</span>
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
                @if ($leave_form->approve_pm != 'กำลังดำเนินการ') disabled
                @endif data-toggle="modal" data-target="#confirmModal_pm">
            อนุมัติ
        </button>
        {{-- modal อนุมัติ PM --}}
        <form action="{{ route('pm.req.emp.update', $leave_form->id) }}" method="post">
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
                                    <span class="text-danger">{{ $errors->first('reason_pm') }}</span>
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
                                    <span class="text-danger">{{ $errors->first('allowed_pm') }}</span>
                                @endif
                                <br>
                                <input type="hidden" name="approve_pm" value="อนุมัติ">

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
                            <span>ยืนยันที่จะอนุมัติ[✔️]หรือไม่?</span>
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

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var radio = document.getElementsByName('allowed_pm');
            var otherInput = document.getElementsByName('other')[0];
            console.log(value);
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
