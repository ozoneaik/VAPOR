{{-- ปุ่มบันทึกการลา --}}
<form action="{{ route('rep.update', $leave_form->id) }}" method="POST">
    @method('PUT')
    @csrf

    <input type="hidden" name="user_id" value="{{ $leave_form->user_id }}">

    {{-- ปุ่มปฏิบัติงานแทน --}}
    <div class="col-md-12 justify-content-end d-flex pr-0">
        @if ($leave_form->approve_rep != 'กำลังดำเนินการ')
            <span class="text-danger">ไม่สามารถแก้ไขได้ เนื่องจากคุณได้ดำเนินการแล้ว</span>
        @endif
    </div>

    <div class="col-md-12 justify-content-end d-flex pr-0">
        <button type="button" class="btn btn-danger mr-3 " name="approve_rep" value="ไม่อนุมัติ" @if ($leave_form->approve_rep != 'กำลังดำเนินการ') disabled @endif>
            ปฏิเสธการปฏิบัติงานแทน
        </button>
        <button type="button" class="btn btn-primary" name="approve_rep" value="อนุมัติ" @if ($leave_form->approve_rep != 'กำลังดำเนินการ') disabled @endif>
            ยินยอมปฏิบัติงานแทน
        </button>
        <input type="hidden" name="approve_rep" value="{{ $leave_form->approve_rep }}"/>
    </div>

    <!-- Modal ยอมรับปฏิบัติงานแทน -->
    <div class="modal fade" id="confirmModal_rep" tabindex="-1" role="dialog"
         aria-labelledby="confirmModalLabel_rep" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel_rep">บันทึกข้อมูล</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span class="content"></span>
                    <br>
                    <span class="text-danger">*เมื่อกดยืนยันคุณจะไม่สามารถกลับมาแก้ไขได้</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        ปิด
                    </button>
                    <button type="submit" class="btn btn-success">
                        ยืนยัน
                    </button>
                </div>
                <input type="hidden" name="approve_rep" value="">
            </div>
        </div>
    </div>
</form>


@section('scripts')
    {{-- modal ปฏิบัติงานแทน --}}
    <script>
        $(document).ready(function() {
            $('button[name=approve_rep]').click(function() {
                var value = $(this).val();
                var confirmModal = $('#confirmModal_rep');
                console.log(value);
                confirmModal.find('input[name=approve_rep]').val(value);
                if (value === 'ไม่อนุมัติ') {
                    confirmModal.find('.modal-body .content').text('ยืนยันที่จะปฏิเสธงานแทน[❌]หรือไม่?');
                    confirmModal.find('.allowed input').prop('disabled', true);
                } else if (value === 'อนุมัติ') {
                    confirmModal.find('.modal-body .content').text('ยืนยันที่จะปฏิบัติงานแทน[✔️]หรือไม่?');
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
