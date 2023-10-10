@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ยืนยันที่อยู่อีเมลของคุณ</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            ลิงก์ยืนยันใหม่ได้ถูกส่งไปยังที่อยู่อีเมลของคุณแล้ว
                        </div>
                    @endif

                    ก่อนดำเนินการต่อ โปรดตรวจสอบอีเมลของคุณเพื่อดูลิงก์ยืนยัน หากคุณไม่ได้รับอีเมล ,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">คลิกที่นี่เพื่อขออีกครั้ง</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
