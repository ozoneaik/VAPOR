<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบการลาบริษัท บิ๊ก ดาต้า เอเจนซี่ จำกัด (สาขาเชียงใหม่)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <style>
        * {
            font-size: 8px;
            font-family: 'Sarabun', sans-serif;
            margin-bottom: 0.65rem;
            padding: 0;
            box-sizing: border-box;
        }

        span {
            font-weight: bold;
        }

        th,
        td {
            border: solid black 1px;
        }

        thead,
        tr {
            height: 22px;
            max-width: 80px;
        }

        table {
            width: 100%;
        }
    </style>
    <style type="text/css" media="print">
        @media print {
            @page {
                margin-top: 0;
                margin-bottom: 0;
            }

            body {
                padding-top: 20px;
                padding-bottom: 20px;
            }
        }
    </style>
</head>

<body>
{{--<script>--}}
{{--    window.onload = function () {--}}
{{--        window.print();--}}
{{--    };--}}
{{--</script>--}}

<script>
    window.onload = function () {
        window.print();
    };

    window.addEventListener('afterprint', function () {
        closeTab();
    });

    window.onbeforeunload = function () {
        closeTab();
    };

    function closeTab() {
        window.open('', '_self', '');
        window.close();
    }
</script>


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="d-flex justify-content-start align-items-center mb-0">
                <div class="col-md-3">
                    <div class="bg-dark">
                        <img src="{{asset('img/logo.png')}}" alt="" width="140px" height="140px">
                    </div>
                </div>
                <div class="col-md-3">
                    <span style="line-height:24px">
                    บริษัท บิ๊ก ดาต้า เอเจนซี่ จำกัด (สาขาเชียงใหม่)
                    <br>
                    333 หมู่ 4 ต.ท่าศาลา อ.เมืองเชียงใหม่ จ.เชียงใหม่ 50000
                    <br>
                    โทร. 05 2005 213 / 089 866 7679
                    </span>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <span>ใบลา</span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-end ">
                <?php
                setlocale(LC_TIME, 'French');
                ?>

                <span>วันที่</span>__________________________________{{ Carbon\Carbon::parse($leaveforms->created_at)->addYears(543)->locale('th')->translatedFormat('jS F Y') }}
                __________________________________
            </div>
            <div class="col-md-12 d-flex justify-content-between">

                <div><span>ชื่อ - สกุล</span> __________________________{{$my_user->name}}
                    ({{$my_user->nick_name}}) ___________________________
                </div>
                <div><span>ตำแหน่ง</span> __________________________________{{$my_user->position}}
                    __________________________________
                </div>
            </div>


            <!--  -->

            <div class="col-md-12 d-flex justify-content-between">
                <div><span>ลาในทำงานตั้งแต่เวลา</span>
                    ____________{{ Carbon\Carbon::parse($leaveforms->leave_start)->locale('th')->translatedFormat('jS F Y') }}
                    ____________<span>ถึงเวลา</span>
                    ____________{{ Carbon\Carbon::parse($leaveforms->leave_start)->locale('th')->translatedFormat('jS F Y') }}
                    ____________
                </div>
            </div>
            <div></div>
            <!--  -->

            <div class="col-md-12 d-flex justify-content-between">
                <div><span>ขอลาหยุดตั้งแต่วันที่</span>
                    ________{{ Carbon\Carbon::parse($leaveforms->leave_start)->addYears(543)->locale('th')->translatedFormat('jS F Y') }}
                    ________<span>และวันที่</span>
                    ________{{ Carbon\Carbon::parse($leaveforms->leave_start)->addYears(543)->locale('th')->translatedFormat('jS F Y') }}
                    ________

                </div>
            </div>

            <!--  -->

            <div class="col-md-6">
                <span>รวมเป็นเวลา</span> __________________________________{{$leaveforms->leave_total}}
                __________________________________
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <table>
                    <thead>
                    <tr>
                        <th>ประเภทการลา</th>
                        <th>เหตุผลการลา</th>
                        <th>หมายเหตุ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="width: 100px">{{$leaveforms->leave_type}}</td>
                        @if($leaveforms->reason)
                            <td style="width: 300px">{{$leaveforms->reason}}</td>
                        @else
                            <td style="width: 300px">ไม่มีเหตุผลการลา</td>
                        @endif
                        @if($leaveforms->reason_hr)
                            <td style="width: 300px">{{$leaveforms->reason_hr}}</td>
                        @else
                            <td style="width: 300px">ไม่มีเหตุผลการลา</td>
                        @endif
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 d-flex justify-content-between mb-0">
                <div><span>เอกสารประกอบการลา</span>
                    __________________________________________ อื่นๆ __________________________________
                </div>
                <div>
                    <span>ลงชื่อ</span>
                    @if($my_user->signature)
                        <img src="{{asset($my_user->signature)}}" alt="" height="50px" width="100px">
                    @else
                        ______________________________________________________________________________________________
                    @endif


                    <div class="text-center mb-3">{{$my_user->name}} ({{$my_user->nick_name}})</div>
                    <div class="text-center mt-2">
                        (
                        วันที่ {{ Carbon\Carbon::parse($leaveforms->created_at)->addYears(543)->locale('th')->translatedFormat('jS F Y') }}
                        )

                    </div>
                </div>
            </div>

        </div>
        <div class="row">

        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <table>
                    <thead>
                    <tr>
                        <th>ประเภทการลา</th>
                        <th>ลามาแล้ว</th>
                        <th>ลาครั้งนี้</th>
                        <th>คงเหลือ</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $i = 0;
                    ?>
                    @foreach($data_leaves as $data_leave)
                        @php
                            $minutes_d1 = ($days = (int)explode(' ', $data_leave->time_already_used)[0]) * 8 * 60 + ($hours = (int)explode(' ', $data_leave->time_already_used)[2]) * 60 + (int)explode(' ', $data_leave->time_already_used)[4];
                            $minutes_d2 = ($days = (int)explode(' ', $leaveforms->leave_total)[0]) * 8 * 60 + ($hours = (int)explode(' ', $leaveforms->leave_total)[2]) * 60 + (int)explode(' ', $leaveforms->leave_total)[4];

                            $diff_minutes = $minutes_d1 - $minutes_d2;

                            $result = floor($diff_minutes / (8 * 60)) . ' วัน ' . floor(($diff_minutes % (8 * 60)) / 60) . ' ชั่วโมง ' . ($diff_minutes % 60) . ' นาที';
                        @endphp

                        <tr>
                            <td>{{$data_leave->leave_type_name}}</td>

                            @if($leaveforms->leave_type == $data_leave->leave_type_name)
                                <td>{{$result}}</td>
                                <td>{{$leaveforms->leave_total}}</td>
                            @else
                                <td>{{ $data_leave->time_already_used }}</td>
                                <td>0 วัน 0 ชั่วโมง 0 นาที</td>
                            @endif
                            <td>{{$data_leave->time_remain}}</td>
                        </tr>
                            <?php
                            $i++;
                            ?>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 d-flex justify-content-start">
                @if($leaveforms->reason_pm)
                    <div>
                        <span>ความคิดเห็น Leader/PM</span>
                        _______________________{{$leaveforms->reason_pm}} _______________________
                    </div>
                @else
                    <div>
                        <span>ความคิดเห็น Leader/PM</span>
                        _______________________ไม่มีความคิดเห็น_______________________
                    </div>
                @endif

            </div>
            <div class="col-md-12 d-flex justify-content-start">
                @if($leaveforms->reason_ceo)
                    <div><span>ความคิดเห็น Sulution Architext Director</span>
                        _______________________{{$leaveforms->reason_ceo}}
                        _______________________
                    </div>
                @else
                    <div><span>ความคิดเห็น Sulution Architext Director</span>
                        _______________________ไม่มีความคิดเห็น_______________________
                    </div>
                @endif

            </div>
        </div>
        <div class="col-md-12 d-flex justify-content-start">
            @if($user_rep)
                @if($leaveforms->approve_rep == '❌')
                    <div>
                        <span>ระหว่างการลามอบหมายให้</span>
                        _______________________ผู้ทำหน้าที่แทนปฏิเสธการทำงานแทน_______________________
                    </div>
                @else
                    <div>
                        <span>ระหว่างการลามอบหมายให้</span>
                        _______________________{{$user_rep->name}} ({{$user_rep->nick_name}})_______________________
                        <span>เป็นผู้ปฏิบัติงานแทน</span>
                    </div>
                @endif

            @else
                <div>
                    <span>ระหว่างการลามอบหมายให้</span>
                    _______________________ไม่มีผู้ปฏิบัติงานแทน_______________________
                    <span>เป็นผู้ปฏิบัติงานแทน</span>
                </div>
            @endif

        </div>
        <div class="col-md-12 d-flex justify-content-start">
            <div><span>หมายเหตุ : กรณีไม่มีผู้ปฏิบัติงานแทน สามารถ (ติดต่อ)</span>
                _______________________{{$my_user->phone_no_1}} , {{$my_user->phone_no_2}}
                _______________________
            </div>
        </div>
        @if($leaveforms->allowed_pm)
            <div class="col-md-12 d-flex justify-content-start">
                <div><span>อนุญาตตามสิทธิ์พนักงาน โดย</span> _______________________{{$leaveforms->allowed_pm}}
                    _______________________
                </div>
            </div>
        @endif
        @if($leaveforms->not_allowed_pm)
            <div class="col-md-12 d-flex justify-content-start">
                <div>ไม่อนุญาตเนื่องจาก ______________________{{$leaveforms->not_allowed_pm}}________________________
                </div>
            </div>
        @endif
    </div>

    <div class="row mt-2">
        <div class="col-md-12 d-flex justify-content-between">
            @if($user_pm)
                <div class="">
                    <span>ลงชื่อ</span> __________
                    <img src="{{asset($user_pm->signature)}}" alt="" height="50px" width="100px">
                    __________<span>leader/PM</span>
                </div>
            @endif
            <div class="">
                <span>ลงชื่อ</span> __________
                <img src="{{asset($user_ceo->signature)}}" alt="" height="50px" width="100px">
                __________ <span>ผู้อนุมัติ</span>
                <div class="text-center">
                    นายณัฐดนัย หอมดง
                    <br>
                    (Solution Architect Director)
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>
