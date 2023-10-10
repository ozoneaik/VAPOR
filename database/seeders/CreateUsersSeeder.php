<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'ภูวเดช พาณิชยโสภา',
                'nick_name' => 'ออฟ',
                'position' => 'Developer',
                'birthday' => '2023-10-21 09:31:56',
                'address' => '174 หมู่3 อ.เมือง จ.น่าน 55220',
                'phone_no_1' => '0895570655',
                'phone_no_2' => '0895570355',
                'email' => 'emp@bda.co.th',
                'type' => 0,
                'password' => bcrypt('1111'),
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'อรอุมา จันศรีเกิด',
                'nick_name' => 'แอ๋ม',
                'position' => 'Developer',
                'birthday' => '2023-04-28 09:31:56',
                'address' => '174 หมู่3 อ.เมือง จ.น่าน 55220',
                'phone_no_1' => '0909876543',
                'phone_no_2' => '0903456789',
                'email' => 'emp1@bda.co.th',
                'type' => 0,
                'password' => bcrypt('1111'),
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'สุดใจ ความสุข',
                'nick_name' => 'เจ๋ง',
                'position' => 'Developer',
                'birthday' => '2023-04-28 09:31:56',
                'address' => '174 หมู่3 อ.เมือง จ.น่าน 55220',
                'phone_no_1' => '0908765432',
                'phone_no_2' => '0905678901',
                'email' => 'emp2@bda.co.th',
                'type' => 0,
                'password' => bcrypt('1111'),
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'วิไล กิจวัฒนา',
                'nick_name' => 'ออม',
                'position' => 'Developer',
                'birthday' => '2023-04-28 09:31:56',
                'address' => '174 หมู่3 อ.เมือง จ.น่าน 55220',
                'phone_no_1' => '0902345678',
                'phone_no_2' => '0906789012',
                'email' => 'emp3@bda.co.th',
                'type' => 0,
                'password' => bcrypt('1111'),
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'ธนกฤต นักเตะ',
                'nick_name' => 'โต๊ะ',
                'position' => 'Project Manager',
                'birthday' => '2023-04-28 09:31:56',
                'address' => '56 หมู่4 อ.เมือง จ.น่าน 55220',
                'phone_no_1' => '0908901234',
                'phone_no_2' => '0904321098',
                'email' => 'pm@gbda.co.th',
                'type' => 1,
                'password' => bcrypt('1111'),
                'email_verified_at' => '2023-10-21 09:31:56',
            ],
            [
                'name' => 'ญาณิศา บู๊ม',
                'nick_name' => 'บู๊',
                'position' => 'Project Manager',
                'birthday' => '1990-02-14 10:00:00',
                'address' => '15 หมู่10 ต.หนองหญ้าปล้อง อ.บางใหญ่ จ.นนทบุรี 11140',
                'phone_no_1' => '0902109876',
                'phone_no_2' => '0907890123',
                'email' => 'pm1@bda.co.th',
                'type' => 1,
                'password' => bcrypt('1111'),
                'email_verified_at' => '2023-10-21 09:31:56',
            ],
            [
                'name' => 'รัฐพล แคร์',
                'nick_name' => 'พลอย',
                'position' => 'Project Manager',
                'birthday' => '1987-06-23 09:00:00',
                'address' => '157 หมู่6 ต.ท่าช้าง อ.เมือง จ.เชียงใหม่ 50000',
                'phone_no_1' => '0865472315',
                'phone_no_2' => '0532425687',
                'email' => 'pm2@bda.co.th',
                'type' => 1,
                'password' => bcrypt('1111'),
                'email_verified_at' => '2023-10-21 09:31:56',
            ],
            [
                'name' => 'สุภาพ จินต์พงศ์',
                'nick_name' => 'ฟอน',
                'position' => 'Human Resources',
                'birthday' => '1995-08-22 14:45:00',
                'address' => '123 ถ.สุขุมวิท กรุงเทพ 10110',
                'phone_no_1' => '0912345678',
                'phone_no_2' => '0812345678',
                'email' => 'hr@bda.co.th',
                'type' => 2,
                'password' => bcrypt('1111'),
                'email_verified_at' => '2023-10-21 09:31:56',
            ],
            [
                'name' => 'ณัฐพล คงไม่ลืม',
                'nick_name' => 'โบ',
                'position' => 'Human Resources',
                'birthday' => '1989-01-02 09:15:00',
                'address' => '789 ถ.เพชรเกษม นนทบุรี 11000',
                'phone_no_1' => '0923456789',
                'phone_no_2' => '0823456789',
                'email' => 'hr1@bda.co.th',
                'type' => 3,
                'password' => bcrypt('1111'),
                'email_verified_at' => '2023-10-21 09:31:56',
            ],
            [
                'name' => 'นายณัฐดนัย หอมดง',
                'nick_name' => 'เป้',
                'position' => 'Solution Architect Director (CEO)',
                'birthday' => '1990-01-02 09:15:00',
                'address' => '789 ถ.เพชรเกษม นนทบุรี 11111',
                'phone_no_1' => '0947856789',
                'phone_no_2' => '0562386951',
                'email' => 'ceo@bda.co.th',
                'type' => 4,
                'password' => bcrypt('1111'),
                'email_verified_at' => '2023-10-21 09:31:56',
            ],
        ];
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
