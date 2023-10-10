<?php

namespace App\Http\Controllers\UpdateLeaveForm;

use App\Http\Controllers\Controller;
use App\Models\LeaveForm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class REP_UpdateController extends Controller
{
    //ตารางแสดงขอปฏิบัติแทน
    public function rep()
    {
        //ดึงใบลาที่ผู้ลาเลือกคุณทำแทน
        $userId = Auth::user()->id;
        $leave_forms_rep = DB::table('leave_forms')
            ->join('users', 'leave_forms.sel_rep', '=', 'users.id')
            ->where('leave_forms.sel_rep', '=', $userId)
            ->select(
                'leave_forms.id',
                'users.name',
                'leave_forms.created_at',
                'leave_forms.leave_type',
                'leave_forms.leave_start',
                'leave_forms.leave_end',
                'leave_forms.leave_total',
                'leave_forms.status',
                'leave_forms.user_id'
            )->get();
        $get_name_from = DB::table('users')
            ->Join('leave_forms', 'leave_forms.user_id', '=', 'users.id')
            ->where('leave_forms.sel_rep', '=', $userId)
            ->select('users.name')
            ->get();
        return view('rep_list', compact('leave_forms_rep', 'get_name_from'));
    }

// เอาข้อมูลไปแสดงในหน้ารายการคำขอปฎิบัติแทน
    public function rep_list_detail($id)
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

// ทำการอัปเดทข้อมูลการอนุมัติของผู้ปฏิบัติงานแทน
    public function rep_list_detail_update(Request $request, $id)
    {
        $get_user_type = DB::table('leave_forms')
            ->join('users', 'leave_forms.user_id', '=', 'users.id')
            ->where('leave_forms.user_id', '=', $request->user_id)
            ->select('users.type')
            ->first();
//        dd($request->all(),$id,$get_user_type);

        $request->validate([
            'approve_rep' => 'required',
        ], [
            'approve_rep.required' => 'ไม่มีข้อลอนุมัติ/ไม่อนุมัติจากผู้ปฏิบัติงานแทน'
        ]);

        $leave_form = LeaveForm::find($id);

        if ($get_user_type->type == 0){//ถ้า ผู้ลาเป็นพนักงานทั่วไป
            $leave_form->approve_rep = $request->approve_rep;
            $leave_form->approve_pm = 'กำลังดำเนินการ';
        }elseif ($get_user_type->type == 2){//ถ้า ผู้ลาเป็น HR
            $leave_form->approve_rep = $request->approve_rep;
            $leave_form->approve_pm = '-';
            $leave_form->approve_ceo = 'กำลังดำเนินการ';
        }
        $leave_form->save();
//        dd($leave_form->all()->all(),$request->all(),$id,$get_user_type);
        return redirect()->route('rep')->with('success', 'บันทึกข้อมูลสำเร็จ');
    }
}
