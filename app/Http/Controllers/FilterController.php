<?php

namespace App\Http\Controllers;

use App\Models\LeaveForm;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilterController extends Controller
{
    //
    public function filter(Request $request)
    {

        // dd($request->all());
        if ($request->start && $request->end) {
            $start = Carbon::createFromFormat('d/m/Y H:i', $request->start)->format('Y-m-d H:i:s');
            $end = Carbon::createFromFormat('d/m/Y H:i', $request->end)->format('Y-m-d H:i:s');
            // dd($start,$end);

            $leaves = LeaveForm::where('user_id', Auth::user()->id)
                ->whereBetween('created_at', [$start, $end])
                ->get();
            $users = User::all();

            // dd($start,$end,$leaves->all(),$start);
            $start_format = Carbon::createFromFormat('d/m/Y H:i', $request->start)->addYears(543)->format('d/m/Y H:i');
            $end_format = Carbon::createFromFormat('d/m/Y H:i', $request->end)->addYears(543)->format('d/m/Y H:i');
            return view('req_list', compact('leaves', 'users', 'start_format', 'end_format'));
        } else {
            return redirect()->route('req');
        }
    }
}
