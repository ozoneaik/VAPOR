<form action="{{ route('ceo.req.emp.update', $leave_form->id) }}" method="post">
    @csrf
    {{-- อนุมัติ ceo --}}

    <div class="col-md-12 justify-content-end d-flex pr-0">
        @if ($leave_form->approve_ceo != 'กำลังดำเนินการ')
            <span class="text-danger">ไม่สามารถแก้ไขได้ เนื่องจากคุณได้ดำเนินการแล้ว</span>
        @endif
    </div>

    <div class="col-md-12 justify-content-end d-flex pr-0">
        <button type="button" class="btn btn-danger mr-3 " name="approve_ceo" value="ไม่อนุมัติ"
                @if ($leave_form->approve_ceo != 'กำลังดำเนินการ') disabled @endif>
            ไม่อนุมัติ
        </button>
        <button type="button" class="btn btn-primary" name="approve_ceo" value="อนุมัติ"
                @if ($leave_form->approve_ceo != 'กำลังดำเนินการ') disabled @endif>
            อนุมัติ
        </button>
        <input type="hidden" name="approve_ceo" value="{{ $leave_form->approve_ceo }}"/>
    </div>

    <!-- Modal อนุมัติ ceo -->
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
                        <label for="reason_ceo">ความเห็น Human Resources (ceo)</label>
                        @if ($errors->has('reason_ceo'))
                            <span
                                class="text-danger">{{ $errors->first('reason_ceo') }}
                                                        </span>
                        @endif
                        <textarea
                            class="form-control @error('reason_ceo') is-invalid @enderror"
                            id="reason_ceo" name="reason_ceo" rows="3"></textarea>
                    </div>

                    <div class="form-group" id="not_allowed_ceo">
                        <label for="not_allowed_ceo">ความเห็น Human Resources (ceo)</label>
                        @if($errors->has('not_allowed_ceo'))
                            <span
                                class="text-danger">{{$errors->first('not_allowed_ceo')}}</span>
                        @endif
                        <textarea
                            class="form-control @error('not_allowed_ceo') is-invalid @enderror"
                            name="not_allowed_ceo" id="" cols="30" rows="4"></textarea>
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
                <input type="hidden" name="approve_ceo" value="">
            </div>
        </div>
    </div>

    <input name="user_id" type="hidden" value="{{$leave_form->user_id}}" >


</form>



@section('scripts')
    {{-- modal ceo --}}
    <script>
        $(document).ready(function() {
            $('button[name=approve_ceo]').click(function() {
                var value = $(this).val();
                var confirmModal = $('#confirmModal_ceo');
                console.log(value);
                confirmModal.find('input[name=approve_ceo]').val(value);
                if (value === 'ไม่อนุมัติ') {
                    confirmModal.find('.modal-body .content').text('ยืนยันที่จะไม่อนุมัติ[❌]หรือไม่?');
                    confirmModal.find('.reason_ceo').hide();
                    confirmModal.find('#not_allowed_ceo').show();
                    // Disable all input elements within elements with class "allowed"
                    confirmModal.find('.allowed input').prop('disabled', true);

                } else if (value === 'อนุมัติ') {
                    confirmModal.find('.modal-body .content').text('ยืนยันที่จะอนุมัติ[✔️]หรือไม่?');
                    confirmModal.find('.modal-body .form-group').show();
                    confirmModal.find('.allowed').show();
                    confirmModal.find('#not_allowed_ceo').hide();
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
