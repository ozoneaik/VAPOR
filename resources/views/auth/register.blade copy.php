@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">สร้างบัญชีพนักงานใหม่</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                {{-- name --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">ชื่อ - นามสกุล</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', '') }}" required>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>ชื่อผิด</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- nick_name --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nick_name">ชื่อเล่น</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="nick_name" name="nick_name" value="{{ old('nick_name', '') }}" required>
                                            @error('nick_name')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>ชื่อเล่นผิด</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- possition --}}
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="possition">ตำแหน่ง</label>
                                        <input type="text" class="form-control" id="possition" name="possition" value="{{old('possition')}}" required>
                                        @error('possition')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>กรุณาระบุตำแหน่ง</strong>
                                                </span>
                                        @enderror
                                    </div>

                                </div>
                                {{-- birthday --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birthday">วันเดือนปีเกิด</label>
                                        <input type="date" class="form-control" id="birthday" name="birthday" value="{{old('birthday')}}">
                                        @error('birthday')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- address --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">ที่อยู่</label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}">
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                </div>
                                {{-- phone_no_1 --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_no_1">เบอร์โทรศัพท์</label>
                                        <input type="text" class="form-control" id="phone_no_1" name="phone_no_1" value="{{old('phone_no_1')}}">
                                        @error('phone_no_1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                </div>
                                {{-- phone_no_2 --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_no_2">เบอร์โทรศัพท์(สำรอง)</label>
                                        <input type="text" class="form-control" id="phone_no_2" name="phone_no_2" value="{{old('phone_no_2')}}">
                                        @error('phone_no_2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- email --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">อีเมล</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}" title="อีเมลต้องเป็น @bda.co.th เท่านั้น" pattern=".+@bda.co.th"
                                               autocomplete="email" required>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- password --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="password">รหัสผ่าน</label>
                                            <input id="password" type="password"
                                                   class="form-control @error('password') is-invalid @enderror" name="password"
                                                   required autocomplete="new-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>
                                {{-- comfirm password --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="password-confirm">ยืนยันรหัสผ่าน</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                {{-- type --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="type">สิทธิ์</label>
                                        <select id="type" class="form-control" name="type" required autocomplete="type">
                                            <option value="">-- Select Type --</option>
                                            <option value="0">พนักงานทั่วไป</option>
                                            <option value="1">Project Manager</option>
                                            <option value="2">HR (รับผิดชอบในส่วนของใบลา)</option>
                                            <option value="3">HR</option>
                                            <option value="4">CEO</option>
                                        </select>
                                    </div>

                                </div>

                            </div>
                            <div class="row mb-0">
                                <div class="col-md-12 offset-md-12 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">
                                        สร้างบัญชี
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
