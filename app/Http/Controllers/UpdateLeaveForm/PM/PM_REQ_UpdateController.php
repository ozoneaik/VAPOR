<?php

namespace App\Http\Controllers\UpdateLeaveForm\PM;

use App\Http\Controllers\Controller;
use App\Models\LeaveForm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PM_REQ_UpdateController extends Controller
{
    //เอาข้อมูลไปแสดงในหน้ารายการคำขอใบลาพนักงาน[Project manager]
    public function PM_req()
    {
        $leave_forms_rep = DB::table('leave_forms')
            ->join('users', 'leave_forms.user_id', '=', 'users.id')
            ->where('leave_forms.approve_pm', '!=', '-')
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
            )->get();
//        dd($leave_forms_rep->all());
        return view('req_list_emp', compact('leave_forms_rep'));
    }

// เอาข้อมูลไปแสดงในหน้ารายการคำขอใบลาพนักงานคนนั้น[Project manager]
    public function req_list_emp_detail($id)
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


// ทำการอัปเดทข้อมูลการอนุมัติของ Project manager
    public function req_list_emp_detail_update(Request $request, $id)
    {
//         dd($request->all());

        $request->validate([
            'approve_pm' => 'required',
            'reason_pm' => 'nullable|max:255',
            'allowed_pm' => 'nullable',
            'not_allowed_pm' => 'nullable|max:255',
            'day' => 'nullable|numeric|between:0,150',
            'hour' => 'nullable|numeric|between:0,8',
            'minutes' => 'nullable|numeric|between:0,60',
        ], [
            'approve_pm.required' => 'no requ', // 'allowed_pm.required' => 'โปรดเลือก',
            'reason_pm.max' => 'ป้อนเกิน 255',
            'not_allowed_pm' => 'ป้อนเกิน 255',
            'day.numeric' => 'ป้อนตัวเลขเท่านั้น',
            'hour.numeric' => 'ป้อนตัวเลขเท่านั้น',
            'minutes.numeric' => 'ป้อนตัวเลขเท่านั้น',
            'day.between' => 'ป้อนเลข 2 ตัว',
            'hour.between' => 'ป้อนเลข 2 ตัว',
            'minutes.between' => 'ป้อนเลข 2 ตัว',
        ]);

        $leave_form = LeaveForm::find($id);
        if ($request->approve_pm == 'ไม่อนุมัติ'){
            if (!$request->not_allowed_pm){
                $leave_form->reason_pm = 'ไม่มีความคิดเห็น';
            }
            $leave_form->reason_pm = $request->not_allowed_pm;
            $leave_form->approve_pm = 'ไม่อนุมัติ';
            $leave_form->approve_hr = '-';
            $leave_form->status = 'ไม่อนุมัติ';
        }else{

            if (!$request->reason_pm){
                $request->reason_pm = 'ไม่มีความคิดเห็น';
            }
            if ($request->allowed_pm == 'ทำงานชดเชยเป็นจำนวน'){
                $request->allowed_pm = $request->allowed_pm.' '.$request->day.' วัน '.$request->day.' ชั่วโมง '.$request->day.' นาที ';
            }elseif ($request->allowed_pm == 'อื่นๆ...'){
                if (!$request->other){
                    $request->other = 'ไม่ได้ใส่ความเห็น';
                }
                $request->allowed_pm = $request->allowed_pm.' '.$request->other;
            }
            $leave_form->reason_pm = $request->reason_pm.' โดย '.$request->allowed_pm;
            $leave_form->approve_pm = 'อนุมัติ';
            $leave_form->approve_hr = 'กำลังดำเนินการ';
            $leave_form->status = 'กำลังดำเนินการ';
        }
//        dd($leave_form->all());
        $leave_form->save();
        return back()->with('success', 'บันทึกข้อมูลสำเร็จ');
    }
}
