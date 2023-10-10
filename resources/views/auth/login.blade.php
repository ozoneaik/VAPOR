{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">หน้าเข้าสู่ระบบ</div>
                <div class="card-body">

                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block" id="error-message">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <span>{{ $message }}</span>
                    </div>
                    <script>
                        // Add an event listener to the "x" button
                        document.querySelector('#error-message .close').addEventListener('click', function() {
                            // Hide the alert block
                            document.querySelector('#error-message').style.display = 'none';
                        });
                    </script>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">อีเมล</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">รหัสผ่าน</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{
                                        old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        จดจำฉัน
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    เข้าสู่ระบบ
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    ลืมรหัสผ่าน
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    <div class="d-grid gap-2 mt-2 mb-2">
                            <a href="{{ route('google-auth') }}" class="btn btn-danger">เข้าสู่ระบบด้วย @bda.co.th</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>เข้าสู่ระบบ</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <style>

    </style>
</head>
<body >
<section class="vh-100">
    <div class="container py-4 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card" style="border-radius: 1rem;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                    <div class="card-body px-5 py-4 text-center">
                        <img src="https://scontent.fbkk5-7.fna.fbcdn.net/v/t39.30808-6/298810071_567987751663058_9009200209719869804_n.png?_nc_cat=108&ccb=1-7&_nc_sid=a2f6c7&_nc_ohc=77K5md2enwoAX9ErcMi&_nc_oc=AQlqBWGc1AJ08xanNF4Wq3ckdmocQagnQdyRQddGy2fGQIJsfQ2L6sSh151J-VMmzWE&_nc_ht=scontent.fbkk5-7.fna&oh=00_AfDpL5qRECSf6aH7Jj9SRDhbRCDcrkr4hIKH2tOsWiHLaQ&oe=65124C0A" alt="" height="200px" width="200px">
                        <h3 class="mb-3">ระบบลางานบริษัท BDA</h3>
                        @if ($errors->any())
                            <div class="alert alert-danger mb-2" role="alert">
                                อีเมลหรือรหัสผ่านไม่ถูกต้อง
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                            @csrf
                            <div class="mb-2">
                                <label class="form-label" for="email" hidden=""></label>
                                <input type="email" id="email" name="email" class="form-control"  placeholder="อีเมล" required pattern=".+@bda.co.th"/>
                                <div class="invalid-feedback text-start">กรุณากรอกอีเมล example@bda.co.th</div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label" for="password" hidden=""></label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="รหัสผ่าน" required />
                                <div class="invalid-feedback text-start">กรุณากรอกรหัสผ่าน</div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <div class="form-check justify-content-start mb-4">
                                    <input class="form-check-input" type="checkbox" name="remember" value="" id="remember_me" />
                                    <label class="form-check-label" style="margin-left: 10px" for="remember_me"> {{ __('จดจำฉัน') }}</label>
                                </div>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="justify-content-end">
                                        {{ __('ลืมรหัสผ่าน??') }}
                                    </a>
                                @endif

                            </div>
                            <!-- Checkbox -->

                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="submit">เข้าสู่ระบบ</button>
                            </div>

                        </form>
                        <hr>
                        <div class="d-grid gap-2">
                            <a href="{{ route('register') }}" class="btn btn-info text-white">ลงทะเบียนด้วยอีเมล</a>
                        </div>
                        <div class="d-grid gap-2 mt-2 mb-2">
                            <a href="{{ route('google-auth') }}" class="btn btn-danger">เข้าสู่ระบบด้วย @bda.co.th</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
</body>
</html>