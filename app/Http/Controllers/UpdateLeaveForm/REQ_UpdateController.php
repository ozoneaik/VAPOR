<?php

namespace App\Http\Controllers\UpdateLeaveForm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class REQ_UpdateController extends Controller
{
    //
    public function req(){
        //ดึงใบลาที่ยื่น
        $userId = Auth::user()->id;
        $leave_forms = DB::table('leave_forms')
            ->leftjoin('users', 'leave_forms.user_id', '=', 'users.id')
            ->where('users.id', '=', $userId)
            ->select(
                'leave_forms.id',
                'users.name',
                'leave_forms.created_at',
                'leave_forms.leave_type',
                'leave_forms.leave_start',
                'leave_forms.leave_end',
                'leave_forms.leave_total',
                'leave_forms.status'
            )->get();

        $sel_reps = DB::table('leave_forms')
            ->leftJoin('users','leave_forms.sel_rep', '=', 'users.id')
            ->where('leave_forms.user_id','=',$userId)
            ->select('users.name')->get();

        return view('req_list',compact('leave_forms','sel_reps'));
    }


    public function req_list_detail($id){
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
        return view('req_list_detail',compact('user','leave_form','sel_rep'));
    }
}
