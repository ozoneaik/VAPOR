<?php

namespace App\Http\Controllers\UpdateLeaveForm\CEO;

use App\Http\Controllers\Controller;
use App\Models\LeaveForm;
use App\Models\User;
use App\Models\users_leave_data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CEO_REQ_UpdateController extends Controller
{
    // เอาข้อมูลไปแสดงในหน้ารายการคำขอใบลาพนักงาน [CEO]
    public function CEO_req()
    {
        $leave_forms_rep = DB::table('leave_forms')
            ->join('users', 'leave_forms.user_id', '=', 'users.id')
            ->where('leave_forms.approve_ceo', '!=', '-')
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

// เอาข้อมูลไปแสดงในหน้ารายการคำขอใบลาพนักงานคนนั้น [CEO]
    public function ceo_req_list_emp_detail($id)
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


// ทำการอัปเดทข้อมูลการอนุมัติของ CEO
    public function ceo_req_list_emp_detail_update(Request $request, $id)
    {
        $request->validate([
            'approve_ceo' => 'required',
            'reason_ceo' => 'nullable|max:255',
            'not_allowed_ceo' => 'nullable|max:255',
        ], [
            'approve_ceo.required' => 'no requ',
            'reason_ceo.max' => 'ป้อนเกิน 255',
            'not_allowed_ceo.max' => 'ป้อนเกิน 255',
        ]);
        $leaveForm = LeaveForm::find($id);
        $item = users_leave_data::all();
        if ($request->approve_ceo == 'ไม่อนุมัติ') {
            $status = 'ไม่อนุมัติ';
        } else {
            $status = 'อนุมัติ';

            foreach ($item as $time) {

                if ($leaveForm->leave_type == $time->leave_type_name && $leaveForm->id >= $id && $time->user_id == $leaveForm->user_id) {
                    // Calculate remaining time
                    $parts = explode(' ', $time->time_remain);
                    $D = (int)$parts[0];
                    $H = (int)$parts[2];
                    $M = (int)$parts[4];
                    $totalMinutes = ($D * 8 * 60) + ($H * 60) + $M;

                    // Calculate used time
                    $parts1 = explode(' ', $time->time_already_used);
                    $D1 = (int)$parts1[0];
                    $H1 = (int)$parts1[2];
                    $M1 = (int)$parts1[4];
                    $totalMinutes1 = ($D1 * 8 * 60) + ($H1 * 60) + $M1;

                    // Calculate total leave time
                    $parts2 = explode(' ', $leaveForm->leave_total);
                    $D2 = (int)$parts2[0];
                    $H2 = (int)$parts2[2];
                    $M2 = (int)$parts2[4];
                    $totalMinutes2 = ($D2 * 8 * 60) + ($H2 * 60) + $M2;

                    // Subtract leave time from remaining time
                    $difference = $totalMinutes - $totalMinutes2;
                    $D = floor($difference / (8 * 60));
                    $H = floor(($difference % (8 * 60)) / 60);
                    $M = $difference % 60;

                    // Add leave time to used time
                    $sum = $totalMinutes1 + $totalMinutes2;
                    $D1 = floor($sum / (8 * 60));
                    $H1 = floor(($sum % (8 * 60)) / 60);
                    $M1 = $sum % 60;

                    // Update time remaining and used
                    $parts[0] = $D;
                    $parts[2] = $H;
                    $parts[4] = $M;
                    $parts1[0] = $D1;
                    $parts1[2] = $H1;
                    $parts1[4] = $M1;

                    $time_remain = implode(' ', $parts);
                    $time_already_used = implode(' ', $parts1);
                    $time->time_remain = $time_remain;
                    $time->time_already_used = $time_already_used;
                    $time->save();
                }
            }
        }
        LeaveForm::find($id)->update([
            'reason_ceo' => $request->reason_ceo,
            'approve_ceo' => $request->approve_ceo,
            'not_allowed_ceo' => $request->not_allowed_ceo,
            'status' => $status,
        ]);
        // dd(LeaveForm::find($id)->not_allowed_ceo);

        return back()->with('success', 'บันทึกข้อมูลสำเร็จ');
    }
}
