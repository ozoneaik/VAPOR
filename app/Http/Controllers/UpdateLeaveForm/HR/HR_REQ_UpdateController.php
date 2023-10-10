<?php

namespace App\Http\Controllers\UpdateLeaveForm\HR;

use App\Http\Controllers\Controller;
use App\Models\LeaveForm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HR_REQ_UpdateController extends Controller
{
    //เอาข้อมูลไปแสดงในหน้ารายการคำขอใบลาพนักงาน[HR]
    public function HR_req()
    {
        $leave_forms_rep = DB::table('leave_forms')
            ->join('users', 'leave_forms.user_id', '=', 'users.id')
            ->where('leave_forms.approve_hr', '!=', '-')
            ->select(
                'leave_forms.id',
                'users.name',
                'leave_forms.created_at',
                'leave_forms.leave_type',
                'leave_forms.leave_start',
                'leave_forms.leave_end',
                'leave_forms.leave_total',
                'leave_forms.status',
                'leave_forms.user_id',
                'leave_forms.approve_hr'
            )->get();
//        dd($leave_forms_rep->all());
        return view('req_list_emp', compact('leave_forms_rep'));
    }

// เอาข้อมูลไปแสดงในหน้ารายการคำขอใบลาพนักงานคนนั้น [HR]
    public function hr_req_list_emp_detail($id)
    {
        $leave_form = DB::table('leave_forms')
            ->where('id','=',$id)
            ->first();
        $user = DB::table('leave_forms')
            ->join('users','leave_forms.user_id','users.id')
            ->where('leave_forms.id','=',$id)
            ->select('users.id','users.name','users.nick_name','users.position')
            ->first();
        $sel_rep = DB::table('leave_forms')
            ->join('users','leave_forms.sel_rep','users.id')
            ->select('users.id','users.name','users.nick_name','users.position')
            ->first();
//        dd($leave_form,$sel_rep->all(),$id,$user);
        return view('rep_list_detail',compact('user','leave_form','sel_rep'));
    }

// ทำการอัปเดทข้อมูลการอนุมัติของ HR
    public function hr_req_list_emp_detail_update(Request $request, $id)
    {
//         dd($request->all());
        $request->validate(
            [
                'approve_hr' => 'required',
                'reason_hr' => 'nullable|max:255',
                'not_allowed_hr' => 'nullable|max:255',
            ],
            [
                'approve_hr.required' => 'no requ', // 'allowed_pm.required' => 'โปรดเลือก',
                'reason_hr.max' => 'ป้อนอักขระเกิน 255',
                'not_allowed_hr.max' => 'ป้อนเกิน 255',
            ]
        );

        $leave_form = LeaveForm::find($id);
        if ($request->approve_hr == 'ไม่อนุมัติ'){
            if (!$request->not_allowed_hr){
                $request->not_allowed_hr = 'ไม่มีความเห็น';
            }
            $leave_form->reason_hr = $request->not_allowed_hr;
            $leave_form->approve_hr = 'ไม่อนุมัติ';
            $leave_form->approve_ceo = '-';
            $leave_form->status = 'ไม่อนุมัติ';
        }else{
            if (!$request->reason_hr){
                $request->reason_hr = 'ไม่มีความเห็น';
            }
            $leave_form->reason_hr = $request->reason_hr;
            $leave_form->approve_hr = 'อนุมัติ';
            $leave_form->approve_ceo = 'กำลังดำเนินการ';
            $leave_form->status = 'กำลังดำเนินการ';
        }
        $leave_form->save();

        return back()->with('success', 'บันทึกข้อมูลสำเร็จ');
    }
}
