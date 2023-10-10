<?php

namespace App\Http\Controllers;

use App\Models\LeaveForm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;

use Illuminate\Support\Facades\Response;


class LeaveFormController extends Controller
{
// ฟังก์ชั่นใสหารส่งเมล
    function send_email(){

    }

    //-----------------------------------------เข้าสู่หน้ากรอกแบบฟอร์ม-----------------------------------------
    public function create()
    {
        //เลือก ผู้ปฏิบัติงานแทน
        $type_users = Auth::user()->type;
        if ($type_users == 'emp')
            $type_users = 0;
        elseif ($type_users == 'pm')
            $type_users = 1;
        elseif ($type_users == 'hr' || $type_users == 'hr(admin)')
            $type_users = 2;
        else{
            print('ไม่มีไร');
        }
        $users_reps = DB::table('users')
            ->where('type','=',$type_users)
            ->select('id','name','position','type')
            ->get();

        //เลือก PM
        $users_pms = DB::table('users')
            ->where('type','=',1)
            ->select('id','name','position','type')
            ->get();

        //ประเภทการลา่
        $leave_types = DB::table('users_leave_datas')
            ->where('users_leave_datas.user_id','=',Auth::user()->id)
            ->select('time_remain', 'time_already_used', 'leave_type_name')
            ->get();

        //เช็คว่า HR(admin)จะยื่นใบลาใช่มั้ย
        if (auth()->user()->type == 'hr(admin)') {
            return response()->json(['message' => 'ไม่สามารถยื่นแบบฟอร์มการลาได้ ต้องโอนย้ายสิทธ์หน้าที่การลาให้ HR คนอื่นก่อน']);
        }
        return view('form', compact('users_reps','users_pms','leave_types'));
    }
    //---------------------------------------------------------------------------------------------------

    //----------------------------------------------สร้างใบลา----------------------------------------------
    public function store(Request $request)
    {
//        dd($request->all());
        //ตรวจสอบว่ามีใบลาที่เคยยื่นแล้วหรือยัง
        $status = DB::table('leave_forms')
            ->where('user_id', Auth::user()->id)->where('status','กำลังดำเนินการ')
            ->select('status')
            ->first();
        if($status){
            return back()->with('error','ไม่สามารถลาได้เนื่องจากมีใบลาที่กำลังดำเนินการอยู่');
        }
        //ตรวจสอบข้อมูล
        $request->validate(
            [
                'leave_type' => 'required',
                'leave_start' => 'required',
                'leave_end' => 'required',
                'reason' => 'nullable|max:255',
                'file1' => 'nullable|mimes:pdf,png,jpg|max:10240',
                'file2' => 'nullable|mimes:pdf,png,jpg|max:10240',
                'sel_rep' => 'nullable', 'sel_pm' => 'nullable',
                'case_no_rep' => 'nullable|numeric|digits:10',
            ],
            [
                'reason.max' => 'ข้อความต้องไม่เกิน 255 ตัวอักษร',
                'case_no_rep.required' => 'กรุณากรอกเบอร์โทร',
                'case_no_rep.numeric' => 'กรุณากรอกเบอร์โทรศัพท์เป็นตัวเลขเท่านั้น',
                'case_no_rep.digits' => 'กรุณากรอกเบอร์โทรศัพท์ที่มีความยาว 10 หลัก',
                'leave_start.required' => 'กรุณากรอกวันที่เริ่มต้นการลา',
                'leave_end.required' => 'กรุณากรอกวันที่สิ้นสุดการลา',
                'file1.mimes' => 'ไฟล์ที่อัพโหลดต้องเป็นไฟล์ PDF, PNG, หรือ JPG เท่านั้น',
                'file2.mimes' => 'ไฟล์ที่อัพโหลดต้องเป็นไฟล์ PDF, PNG, หรือ JPG เท่านั้น',
                'file1.max' => 'อัปโหลดไฟล์ได้ไม่เกิน 10MB',
                'file2.max' => 'อัปโหลดไฟล์ได้ไม่เกิน 10MB',
            ]
        );

        //เอาข้อมูลไปใส่ใบลา
        $leaveform = new LeaveForm();
        $leaveform->user_id = Auth::user()->id;
        $leaveform->leave_type = $request->input('leave_type');
        $startDate = Carbon::createFromFormat('d/m/Y H:i', $request->input('leave_start'));
        $endDate = Carbon::createFromFormat('d/m/Y H:i', $request->input('leave_end'));
        $leaveform->leave_start = $startDate;
        $leaveform->leave_end = $endDate;
        $leaveform->leave_total = $request->leave_total;
        //เช็คว่าผู้ลาได้เพิ่มเหตุผลการลาหรือไม่
        if($request->reason){
            $leaveform->reason = $request->input('reason');
        }else{
            $leaveform->reason = 'ไม่มีเหตุผลการลา';
        }


        //generete file เก็บเป็นสตริง เป็นแบบ part เก็บไฟล์ไว้ที่ public/file1
        if ($request->hasFile('file1')) {
            $file = $request->file('file1');
            $file_name = uniqid() . uniqid() . '.' . strtolower($file->getClientOriginalExtension());
            $upload_location_file = 'file1/';
            $file->move($upload_location_file, $file_name);
            $leaveform->file1 = $upload_location_file . $file_name;
        }
        if ($request->hasFile('file2')) {
            $file = $request->file('file2');
            $file_name = uniqid() . '.' . strtolower($file->getClientOriginalExtension());
            $upload_location_file = 'file2/';
            $file->move($upload_location_file, $file_name);
            $leaveform->file2 = $upload_location_file . $file_name;
        }

        $leaveform->sel_rep = $request->input('sel_rep');
        //เช็คว่าผู้ลาได้เพิ่มเหตุผลการลาหรือไม่
        if($request->case_no_rep){
            $leaveform->case_no_rep = $request->input('case_no_rep');
        }else{
            $leaveform->case_no_rep = 'ไม่มีเบอร์โทรติดต่อ';
        }




        //ผู้ลามี type เป็นอะไร
        if (Auth::user()->type == 'emp'){
            if (!$request->sel_rep){
                $leaveform->approve_pm = 'กำลังดำเนินการ';
            }else{
                $leaveform->approve_rep = 'กำลังดำเนินการ';
            }
            $leaveform->sel_pm = $request->sel_pm;
        }elseif (Auth::user()->type == 'pm'){
            $leaveform->approve_hr = 'กำลังดำเนินการ';
        }elseif (Auth::user()->type == 'hr'){
            if (!$request->sel_rep){
                $leaveform->approve_ceo = 'กำลังดำเนินการ';
            }else{
                $leaveform->approve_rep = 'กำลังดำเนินการ';
            }
        }

        $leaveform->status = 'กำลังดำเนินการ';
//        dd($leaveform);

        $leaveform->save();
        return redirect()->route('req')->with('success', 'บันทึกข้อมูลใบลาเสร็จสมบูรณ์');
    }
    //---------------------------------------------------------------------------------------------------

    //---------------------------------------------ยกเลิกใบบลา---------------------------------------------
    public function cancel($id)
    {
        $leaveForm = LeaveForm::find($id);
        if (Carbon::now()->diffInHours($leaveForm->created_at) >= 24) {
            return redirect()->back()->with('error', 'ไม่สามารถยกเลิกใบลาได้เนื่องจากใบลามีอายุเกิน 3 ชั่วโมงแล้ว');
        }

        if ($leaveForm->status == 'อนุมัติ'){
            $parts = explode(' ', $leaveForm->leave_total);
            $D = (int)$parts[0];
            $H = (int)$parts[2];
            $M = (int)$parts[4];
            $totalMinutes = ($D * 8 * 60) + ($H * 60) + $M;
            //leaveForm->leave_type = ลาป่วย
            $userLeaveData = users_leave_data::where('leave_type_name', $leaveForm->leave_type)
                ->where('user_id', $leaveForm->user_id)
                ->first(); // Use first() to retrieve a single record

            $parts1 = explode(' ', $userLeaveData->time_remain);
            $D1 = (int)$parts1[0];
            $H1 = (int)$parts1[2];
            $M1 = (int)$parts1[4];
            $totalMinutes1 = ($D1 * 8 * 60) + ($H1 * 60) + $M1;
            $parts2 = explode(' ', $userLeaveData->time_already_used);
            $D2 = (int)$parts2[0];
            $H2 = (int)$parts2[2];
            $M2 = (int)$parts2[4];
            $totalMinutes2 = ($D2 * 8 * 60) + ($H2 * 60) + $M2;


            $difference = sqrt(pow($totalMinutes - $totalMinutes2,2));
            $D = floor($difference / (8 * 60));
            $H = floor(($difference % (8 * 60)) / 60);
            $M = $difference % 60;

            $parts[0] = $D;
            $parts[2] = $H;
            $parts[4] = $M;
            $time_already_used = implode(' ', $parts);


            $difference = $totalMinutes + $totalMinutes1;
            $D = floor($difference / (8 * 60));
            $H = floor(($difference % (8 * 60)) / 60);
            $M = $difference % 60;


            $parts[0] = $D;
            $parts[2] = $H;
            $parts[4] = $M;
            $time_remain = implode(' ', $parts);
//            dd($time_remain,$time_already_used);

            $userLeaveData->time_remain = $time_remain;
            $userLeaveData->time_already_used = $time_already_used;
            $userLeaveData->save();

        }
        $leaveForm->approve_rep = '-';
        $leaveForm->approve_pm = '-';
        $leaveForm->approve_hr = '-';
        $leaveForm->approve_ceo = '-';
        $leaveForm->status = 'ยกเลิกใบลา';
        $leaveForm->save();
        return redirect()->back()->with('success','ยกเลิกใบลาแล้ว');
    }
    //---------------------------------------------------------------------------------------------------
}

