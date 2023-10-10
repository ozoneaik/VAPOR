<?php

namespace Database\Seeders;

use App\Models\users_leave_data;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class Users_data_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
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
        foreach (User::all() as $user) {
            foreach ($users_leave_datas as $type) {
                DB::table('users_leave_datas')->insert([
                    'user_id' => $user->id,
                    'leave_type_id' => $type['leave_type_id'],
                    'leave_type_name' => $type['leave_type_name'],
                    'time_remain' => $type['time_remain'],
                    'time_already_used' => $type['time_already_used'],
                ]);
            }
        }
    }
}
