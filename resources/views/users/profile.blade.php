@extends('layouts.layout')

@section('title')
    {{ 'BDA Leave system' }}
@endsection

@section('content')
    {{-- Part --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb text-start">
                        <li class="breadcrumb-item">โปรฟายส่วนตัว</li>
                        <li class="breadcrumb-item active">รายละเอียด {{$user->name}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{-- end part --}}

    {{--  Mian Content  --}}
    <section class="content">
        {{-- Container Fluid --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <span>{{ $message }}</span>
                        </div>
                    @endif
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">
                                <i class="fas fa-file-medical mr-2"></i>
                                โปรฟายส่วนตัว </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body d-flex justify-content-center align-items-center flex-column">
                                            <div class="">
                                                <img class="rounded-circle d-flex justify-content-end" src="{{ asset($user->profile_img) }}" alt="" style="max-width: 200px; height: 200px;" onerror="this.src='https://sv1.picz.in.th/images/2023/05/29/FnkTRn.png'">
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <span>
                                                        <span class="font-weight-bold">รหัสพนักงาน : </span>
                                                        {{ $user->id }}
                                                </span>
                                                <br>
                                                <span>
                                                        <span class="font-weight-bold">ชื่อ-นามสกุล : </span>
                                                        {{ $user->name }} ({{$user->nick_name}})
                                                    </span>
                                                <br>
                                                <span>
                                                        <span class="font-weight-bold">ตำแหน่ง : </span>
                                                        {{ $user->position }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-outline-primary btn-block" style="float: right;max-width:100%" data-toggle="modal" data-target="#EditProfile">
                                                แก้ไขข้อมูลส่วนตัว
                                            </button>
                                        </div>
                                    </div>

                                    {{-- Modal แก้ไขข้อมูลส่วนตัว --}}
                                    <div id="EditProfile" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">แก้ไขข้อมูลส่วนตัว</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{route('profile.update',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                                                    <div class="modal-body">

                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-12 d-flex justify-content-center align-items-center mb-3">
                                                                <img class="rounded-circle mr-4 img-fluid" id="previewImg" src="{{ asset($user->profile_img) }}" alt="no picture" style="max-width: 200px; height: 200px;" onerror="this.src='https://sv1.picz.in.th/images/2023/05/29/FnkTRn.png'">
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>อัปโหลดรูปประจำตัว</label>
                                                                    <div class="input-group">
                                                                        <div class="custom-file">

                                                                            <input type="file" class="custom-file-input" id="imageInput" name="profile_img" value="" accept="image/*">
                                                                            <label class="custom-file-label" for=""></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <hr>
                                                            </div>
                                                            <div class="col-md-3 ">
                                                                <div class="form-group">
                                                                    <label for="">รหัสพนักงาน</label>
                                                                    <input class="form-control" value="{{$user->id}}" type="text" readonly/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <label for="name">ชื่อ-นามสกุล</label>
                                                                    <input class="form-control" name="name" value="{{$user->name}}" type="text"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="nick_name">ชื่อเล่น</label>
                                                                    <input class="form-control" name="nick_name" value="{{$user->nick_name}}" type="text"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="position">ตำแหน่ง</label>
                                                                    <input class="form-control" name="position" value="{{$user->position}}" type="text"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="birthday">วันเดือนปีเกิด</label>
                                                                    <input class="form-control" type="date" name="birthday" placeholder="{{ \Carbon\Carbon::parse($user->birthday)->addYears(543)->format('d/m/Y') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="phone_no_1">เบอร์โทรศัพท์ (หลัก)</label>
                                                                    <input class="form-control" type="text" name="phone_no_1" value="{{$user->phone_no_1}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="phone_no_2">เบอร์โทรศัพท์ (รอง)</label>
                                                                    <input class="form-control" type="text" name="phone_no_2" value="{{$user->phone_no_2}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="address">ที่อยู่</label>
                                                                    <input class="form-control" type="text" name="address" value="{{$user->address}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 d-flex justify-content-center">
                                                                <img class="rounded" src="{{asset($user->signature)}}" alt="no picture" id="previewImg1" style="width: 235px; height: 85px;" onerror="this.src='https://sv1.picz.in.th/images/2023/05/29/FnfAyR.png'">
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>อัปโหลดลายเซ็น</label>
                                                                    <div class="input-group">
                                                                        <div class="custom-file">

                                                                            <input type="file" class="custom-file-input" id="imageInput_1" name="signature" value="" accept="image/*">
                                                                            <label class="custom-file-label" for=""></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                            ปิด
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">บันทึก</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Modal แก้ไขข้อมูลส่วนตัว --}}
                                </div>
                                {{-- ข้อมูลพนักงาน  --}}
                                <div class="col-md-6">
                                    {{-- รายละเอียด --}}
                                    <div class="card">

                                        <div class="card-body">
                                            <div class="row">

                                                {{-- วันเดือนปีเกิด --}}
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">วันเดือนปีเกิด</label>
                                                        <input class="form-control" value="{{ \Carbon\Carbon::parse($user->birthday)->addYears(543)->format('d/m/Y') }}" disabled>
                                                    </div>
                                                </div>
                                                {{-- email --}}
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">อีเมล</label>
                                                        <input class="form-control" value="{{ $user->email }}" disabled>
                                                    </div>
                                                </div>
                                                {{-- เบอร์โทรศัพท์ (หลัก) --}}
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">เบอร์โทรศัพท์ (หลัก)</label>
                                                        <input class="form-control" value="{{ $user->phone_no_1 }}" disabled>
                                                    </div>
                                                </div>
                                                {{-- เบอร์โทรศัพท์ (รอง) --}}
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">เบอร์โทรศัพท์ (รอง)</label>
                                                        <input class="form-control" value="{{ $user->phone_no_2 }}" disabled>
                                                    </div>
                                                </div>
                                                {{-- ที่อยู่ --}}
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">ที่อยู่</label>
                                                        <input class="form-control" value="{{ $user->address }}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- end container fluid --}}
    </section>
    <script>
        let imgInput = document.querySelector("#imageInput");
        let previewImg = document.querySelector("#previewImg");

        imgInput.onchange = evt => {
            const [file] = imgInput.files;
            if (file) {
                previewImg.src = URL.createObjectURL(file);
            }
        }
    </script>
    <script>
        let imgInput1 = document.querySelector("#imageInput_1");
        let previewImg1 = document.querySelector("#previewImg1");

        imgInput1.onchange = evt => {
            const [file] = imgInput1.files;
            if (file) {
                previewImg1.src = URL.createObjectURL(file);
            }
        }
    </script>
    {{-- Upload Files --}}
    <script>
        document.querySelectorAll('input[type="file"]').forEach((fileInput, index) => {
            fileInput.addEventListener('change', () => {
                document.querySelectorAll('.custom-file-label')[index].innerText = fileInput.files[0]?.name || '';
            });
        });
    </script>
    {{--  end mian content  --}}
@endsection
