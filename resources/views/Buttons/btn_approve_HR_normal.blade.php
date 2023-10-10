<form action="{{ route('hr.req.emp.update', $leave_form->id) }}" method="post">
    @csrf
    {{-- อนุมัติ HR --}}

    <div class="col-md-12 justify-content-end d-flex pr-0">
        @if ($leave_form->approve_hr != 'กำลังดำเนินการ')
            <span class="text-danger">ไม่สามารถแก้ไขได้ เนื่องจากคุณได้ดำเนินการแล้ว</span>
        @endif
    </div>

    <div class="col-md-12 justify-content-end d-flex pr-0">
        <button type="button" class="btn btn-danger mr-3 " name="approve_hr" value="ไม่อนุมัติ"
                @if ($leave_form->approve_hr != 'กำลังดำเนินการ') disabled @endif>
            ไม่อนุมัติ
        </button>
        <button type="button" class="btn btn-primary" name="approve_hr" value="อนุมัติ"
                @if ($leave_form->approve_hr != 'กำลังดำเนินการ') disabled @endif>
            อนุมัติ
        </button>
        <input type="hidden" name="approve_hr" value="{{ $leave_form->approve_hr }}"/>
    </div>

    <!-- Modal อนุมัติ HR -->
    <div class="modal fade" id="confirmModal_hr" tabindex="-1" role="dialog"
         aria-labelledby="confirmModalLabel_hr" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel_hr">บันทึกข้อมูล</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group reason_hr">
                        <label for="reason_hr">ความเห็น Human Resources (HR)</label>
                        @if ($errors->has('reason_hr'))
                            <span
                                class="text-danger">{{ $errors->first('reason_hr') }}
                                                        </span>
                        @endif
                        <textarea
                            class="form-control @error('reason_hr') is-invalid @enderror"
                            id="reason_hr" name="reason_hr" rows="3"></textarea>
                    </div>

                    <div class="form-group" id="not_allowed_hr">
                        <label for="not_allowed_hr">ความเห็น Human Resources (HR)</label>
                        @if($errors->has('not_allowed_hr'))
                            <span
                                class="text-danger">{{$errors->first('not_allowed_hr')}}</span>
                        @endif
                        <textarea
                            class="form-control @error('not_allowed_hr') is-invalid @enderror"
                            name="not_allowed_hr" id="" cols="30" rows="4"></textarea>
                    </div>

                    <span class="content"></span>
                    <br>
                    <span
                        class="text-danger">*เมื่อกดยืนยันคุณจะไม่สามารถกลับมาแก้ไขได้</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">ปิด
                    </button>
                    <button type="submit" class="btn btn-primary">ยืนยัน</button>
                </div>
                <input type="hidden" name="approve_hr" value="">
            </div>
        </div>
    </div>

    <input name="user_id" type="hidden" value="{{$leave_form->user_id}}" >


</form>



@section('scripts')
    {{-- modal HR --}}
    <script>
        $(document).ready(function() {
            $('button[name=approve_hr]').click(function() {
                var value = $(this).val();
                var confirmModal = $('#confirmModal_hr');
                console.log(value);
                confirmModal.find('input[name=approve_hr]').val(value);
                if (value === 'ไม่อนุมัติ') {
                    confirmModal.find('.modal-body .content').text('ยืนยันที่จะไม่อนุมัติ[❌]หรือไม่?');
                    confirmModal.find('.reason_hr').hide();
                    confirmModal.find('#not_allowed_hr').show();
                    // Disable all input elements within elements with class "allowed"
                    confirmModal.find('.allowed input').prop('disabled', true);

                } else if (value === 'อนุมัติ') {
                    confirmModal.find('.modal-body .content').text('ยืนยันที่จะอนุมัติ[✔️]หรือไม่?');
                    confirmModal.find('.modal-body .form-group').show();
                    confirmModal.find('.allowed').show();
                    confirmModal.find('#not_allowed_hr').hide();
                    confirmModal.find('.allowed input').prop('disabled', false);
                }
                confirmModal.modal('show');

            });
            console.log($("form").serialize());
            $('#confirmModal form').submit(function(e) {
                console.log("Form submitted");
                $('#confirmModal').modal('hide');
            });
        });
    </script>
@endsection
