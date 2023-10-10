<?php

namespace App\Http\Controllers;

use App\Models\LeaveForm;
use App\Models\User;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class PDFController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function generatePDF()

    {

        $dompdf = new Dompdf();
        $dompdf->loadHtml('myPDF');

// (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4');

// Render the HTML as PDF
        $dompdf->render();

// Output the generated PDF to Browser

        return $dompdf->stream();

    }

    public function pdf($id)
    {
        $leaveforms = LeaveForm::findOrFail($id);


        $my_user = DB::table('users')->where('id', Auth::user()->id)->first();
        $user_rep = DB::table('users')->where('id', $leaveforms->sel_rep)->first();
        $user_pm = DB::table('users')->where('id', $leaveforms->sel_pm)->first();
        $user_ceo = DB::table('users')->where('type', 3)->first();
        $data_leaves = DB::table('users_leave_datas')->where('user_id', $my_user->id)->get();


        $this_time = array('1', '2', '3', '4', '5', '6', '7', '8', '9');
        $i = 0;
        foreach ($data_leaves as $row) {
            if ($row->leave_type_name == $leaveforms->leave_type) {
                $this_time[$i] = $row->time_already_used;
            } else {
                $this_time[$i] = '0 วัน 0 ชั่วโมง 0 นาที';
            }
            $i++;
        }

        ;
//        $leaveform_created_at = Carbon::parse($leaveforms->created_at)->addYears(543)->locale('th')->translatedFormat('jS F Y');
//
//        dd($leaveform_created_at)

        return view('pdf', compact(
            'leaveforms',
            'user_rep',
            'my_user',
            'user_pm',
            'user_ceo',
            'data_leaves',
            'this_time',
        ));
    }

}
