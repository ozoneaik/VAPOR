<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;

class GoogleAuthController extends Controller
{
    //
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        try {
            $google_user = Socialite::driver('google')->user();
            $user = User::where('google_id', $google_user->getId())->first();

            if (strpos($google_user->getEmail(), '@gmail.com') !== false) {
                if (!$user) {

                    $existingUser = User::where('email', $google_user->getEmail())->first();

                    if ($existingUser) {
                        // เข้าสู่ระบบกับผู้ใช้ที่มีอยู่แล้ว
                        Auth::login($existingUser);
                        return redirect()->intended('home');
                    }
                    $user_id = uniqid();
                    // dd($user_id);


                    $new_user = User::create([
                        'name' => $google_user->getName(),
                        'email' => $google_user->getEmail(),
                        'google_id' => $google_user->getId(),
                        'user_id' => $user_id,
                        'type' => 0,
                        'email_verified_at' => Carbon::now()
                    ]);
                    if($new_user){
                        $users_leave_datas = [
                            [
                                'leave_type_id' => 1,
                                'leave_type_name' => 'ลาป่วย',
                                'time_remain' => '30 วัน 0 ชั่วโมง 0 นาที',
                                'time_already_used' => '0 วัน 0 ชั่วโมง 0 นาที',
                            ],
                            [
                                'leave_type_id' => 2,
                                'leave_type_name' => 'ลากิจ',
                                'time_remain' => '5 วัน 0 ชั่วโมง 0 นาที',
                                'time_already_used' => '0 วัน 0 ชั่วโมง 0 นาที',
                            ],
                            [
                                'leave_type_id' => 3,
                                'leave_type_name' => 'ลาพักผ่อนประจำปี',
                                'time_remain' => '6 วัน 0 ชั่วโมง 0 นาที',
                                'time_already_used' => '0 วัน 0 ชั่วโมง 0 นาที',
                            ],
                            [
                                'leave_type_id' => 4,
                                'leave_type_name' => 'ลาเพื่อฝึกอบรม',
                                'time_remain' => '7 วัน 0 ชั่วโมง 0 นาที',
                                'time_already_used' => '0 วัน 0 ชั่วโมง 0 นาที',
                            ],
                            [
                                'leave_type_id' => 5,
                                'leave_type_name' => 'ลาคลอดบุตร',
                                'time_remain' => '98 วัน 0 ชั่วโมง 0 นาที',
                                'time_already_used' => '0 วัน 0 ชั่วโมง 0 นาที',
                            ],
                            [
                                'leave_type_id' => 6,
                                'leave_type_name' => 'ลาเพื่อสมรส',
                                'time_remain' => '7 วัน 0 ชั่วโมง 0 นาที',
                                'time_already_used' => '0 วัน 0 ชั่วโมง 0 นาที',
                            ],
                            [
                                'leave_type_id' => 7,
                                'leave_type_name' => 'ลาเพื่อทำหมัน',
                                'time_remain' => '5 วัน 0 ชั่วโมง 0 นาที',
                                'time_already_used' => '0 วัน 0 ชั่วโมง 0 นาที',
                            ],
                            [
                                'leave_type_id' => 8,
                                'leave_type_name' => 'ลารับราชการทหาร',
                                'time_remain' => '60 วัน 0 ชั่วโมง 0 นาที',
                                'time_already_used' => '0 วัน 0 ชั่วโมง 0 นาที',
                            ],
                            [
                                'leave_type_id' => 9,
                                'leave_type_name' => 'ลาอุปสมบท',
                                'time_remain' => '5 วัน 0 ชั่วโมง 0 นาที',
                                'time_already_used' => '0 วัน 0 ชั่วโมง 0 นาที',
                            ]
                        ];
                        foreach ($users_leave_datas as $type) {
                            DB::table('users_leave_datas')->insert([
                                'user_id' => $new_user->id,
                                'leave_type_id' => $type['leave_type_id'],
                                'leave_type_name' => $type['leave_type_name'],
                                'time_remain' => $type['time_remain'],
                                'time_already_used' => $type['time_already_used'],
                            ]);
                        }
                    }else{
                        return response()->json(['message' => 'User creation failed'], 500);
                    }


                    Auth::login($new_user);
                    return redirect()->intended('home');
                } else {
                    Auth::login($user);
                    return redirect()->intended('home');
                }
            } else {
                // ไม่อนุญาตให้ผู้ใช้ที่มีอีเมลไม่ใช่ @bda.co.th เข้าสู่ระบบ
                return response()->json(['message' => 'ไม่อนุญาตให้ผู้ใช้ที่มีอีเมลไม่ใช่ @bda.co.th เข้าสู่ระบบ']);
            }
        } catch (\Throwable $th) {
            //throw $th;
            dd('Somthing went wrong!', $th->getMessage());
        }
    }
}
