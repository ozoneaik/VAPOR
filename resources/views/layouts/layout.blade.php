<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    @yield('style')

    {{-- Google Font: Source Sans Pro --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    {{-- Google Font: TH sarabun --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;300;400;500;700&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    {{--    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('icon/css/all.min.css') }}">

    {{-- Sidebar Scrollbars (เวลามี เมนูในไซด์บาร์มีเยอะ จะเลื่อนสกอร์เมาส์ได้) --}}
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    {{-- Data tables --}}
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">



    {{-- Tempusdominus Bootstrap 4 --}}
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    {{-- iCheck (checkboxes and radio inputs) --}}
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    {{-- Theme style --}}
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
{{--     <link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css?v=3.2.0">--}}


    <style>
        * {
            font-family: 'Sarabun', sans-serif;
        }

        .inner h3 {
            white-space: pre-wrap;
        }

        @media (max-width: 1100px) {
            .text-hide-md {
                display: none;
            }
        }
    </style>




</head>
{{-- sidebar-mini layout-fixed control-sidebar-slide-open layout-navbar-fixed --}}
{{-- [backup] hold-transition layout-fixed layout-navbar-fixed sidebar-mini --}}



<body class="hold-transition layout-fixed layout-navbar-fixed sidebar-mini">


    {{-- Main Wrapper --}}
    <div class="wrapper">

        {{-- Nav bar --}}
        <nav class="main-header navbar navbar-expand navbar-light">
            {{-- Left Navbar --}}
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block ">
                    <a href="{{ route('home') }}" class="nav-link font-weight-bold text-black">
                        ระบบการลาบริษัท บิ๊ก ดาต้า เอเจนซี่ จำกัด (สาขาเชียงใหม่)
                    </a>
                </li>
            </ul>
            {{-- Left Navbar --}}

            {{-- Right Navbar --}}
            <ul class="navbar-nav ml-auto">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('profile', Auth::user()->id) }}">
                            <img src="{{ asset(Auth::user()->profile_img) }}" class="rounded-circle" width="40px" height="40px" onerror="this.src='https://sv1.picz.in.th/images/2023/05/29/FnkTRn.png'">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('profile', Auth::user()->id) }}" class="nav-link text-hide-md">
                            [ID : {{ Auth::user()->id }}] {{ Auth::user()->name }}
                        </a>
                    </li>
                    <li class="nav-item ml-3">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn bg-danger">
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </button>
                        </form>
                    </li>
                </ul>

            </ul>
            {{-- end Right navbar --}}
        </nav>
        {{-- end navbar --}}

        {{-- Main Sidebar --}}
        <aside class="main-sidebar sidebar-dark-primary elevation-4 text-sm"  style="background: #263544">

            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-link text-center">
                <span class="brand-text font-weight-bold mx-auto">
                    <img src="{{ asset('img/logosidebar1.png') }}" height="54px" width="184px" alt="no picture">
                </span>
            </a>
            <!-- end Brand Logo -->

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <br>
                    <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
                        {{-- เมนูหลัก --}}
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link pt-3 pb-3 {{ Request::routeIs('home') ? 'active' : '' }}">
                                <i class="nav-icon fa-solid fa-house"></i>
                                <p>เมนูหลัก</p>
                            </a>
                        </li>

                        {{-- รายการคำขอ --}}
                        @if (Auth::user()->type != 'ceo')
                            <li class="nav-item">
                                <a href="{{ route('req') }}" class="nav-link pt-3 pb-3 {{ Request::routeIs('req', 'req.detail', 'create') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>รายการคำขอใบลา</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('rep') }}" class="nav-link pt-3 pb-3 {{ Request::routeIs('rep', 'rep.detail') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-file-signature"></i>
                                    <p>รายการคำขอปฏิบัติแทน</p>
                                </a>
                            </li>
                        @endif


                        {{-- Project manager --}}
                        @if (Auth::user()->type == 'pm')
                            <li class="nav-item">
                                <a href="{{ route('pm.req.emp') }}" class="nav-link pt-3 pb-3 {{ Request::routeIs('pm.req.emp', 'pm.req.emp.detail') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-tie"></i>
                                    <p>รายการคำขอใบลาพนักงาน</p>
                                </a>
                            </li>
                        @endif

                        {{-- HR --}}
                        @if (Auth::user()->type == 'hr(admin)')
                            <li class="nav-item">
                                <a href="{{ route('hr.req.emp') }}" class="nav-link pt-3 pb-3 {{ Request::routeIs('hr.req.emp', 'hr.req.emp.detail') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-cog"></i>
                                    <p>รายการคำขอใบลาพนักงาน</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('hr.switch.per') }}" class="nav-link pt-3 pb-3 {{ Request::routeIs('hr.switch.per') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-exchange-alt"></i>
                                    <p>โอนสิทธิ์อนุมัติใบลาพนักงาน</p>
                                </a>
                            </li>
                        @endif

                        {{-- CEO --}}
                        @if (Auth::user()->type == 'ceo')
                            <li class="nav-item">
                                <a href="{{ route('ceo.req.emp') }}" class="nav-link pt-3 pb-3 {{ Request::routeIs('ceo.req.emp', 'ceo.req.emp.detail') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-lock"></i>
                                    <p>รายการคำขอใบลาพนักงาน</p>
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->type == 'ceo' || Auth::user()->type == 'hr(admin)' || Auth::user()->type == 'pm')
                            <li class="nav-item">
                                <a href="{{ route('data.users') }}" class="nav-link pt-3 pb-3 {{ Request::routeIs('data.users', 'data.user.detail', 'data.user.history') ? 'active' : '' }}">
                                    <i class="fa-solid fa-users nav-icon"></i>
                                    <p>ข้อมูลพนักงาน</p>
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a href="{{route('profile',Auth::user()->id)}}" class="nav-link pt-3 pb-3 {{Request::routeIs('profile') ? 'active' :''}}">
                                <i class="fa-solid fa-users nav-icon"></i>
                                <p>โปรไฟล์ส่วนตัว</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- end sidebar-menu -->
            </div>
            <!-- end sidebar -->
        </aside>
        {{-- end main sidebar --}}

        {{-- Content Wrapper --}}
        <section class="content-wrapper">
            @yield('content')
        </section>
        {{-- end content-wrapper --}}

    </div>
    {{-- end Main Wrapper --}}


    {{-- jQuery --}}
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    {{-- Bootstrap 4 --}}
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    {{-- overlayScrollbars --}}
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    {{-- Font Awesome script cdn --}}
    <script src="{{ asset('icon/js/all.min.js') }}"></script>


    {{-- DataTables & Plugins --}}
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>

    <script>
        $(document).ready(function() {


            function initDataTable(tableId) {
                var table = $("#" + tableId).DataTable({
                    "responsive": true,
                    "lengthChange": true,
                    "autoWidth": false,
                    "order": false,
                    "pageLength": 25,


                });
            }

            $(function() {

                initDataTable("data_emp_table");
            });
        });
    </script>
    <script>
        $("#data-table").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "searching": false,
            "paging": false,
            "info": false,
            "order": [
                [0, "desc"]
            ],
        });
    </script>
    <script>
        $("#data-table1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "searching": false,
            "paging": false,
            "info": false,
            "order": [
                [0, "desc"]
            ],
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#1').DataTable({
                "scrollX": true,
            });
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
    {{-- end DataTables & Plugins --}}


    {{-- modal HR --}}
    <script>
        $(document).ready(function() {
            $('button[name=approve_hr]').click(function() {
                var value = $(this).val();
                var confirmModal = $('#confirmModal_hr');
                console.log(value);
                confirmModal.find('input[name=approve_hr]').val(value);
                if (value === 'disapproval') {
                    confirmModal.find('.modal-body .content').text('ยืนยันที่จะไม่อนุมัติ[❌]หรือไม่?');
                    confirmModal.find('.reason_hr').hide();
                    confirmModal.find('#not_allowed_hr').show();
                    // Disable all input elements within elements with class "allowed"
                    confirmModal.find('.allowed input').prop('disabled', true);

                } else if (value === 'approve') {
                    confirmModal.find('.modal-body .content').text('ยืนยันที่จะอนุมัติ[✔️]หรือไม่?');
                    confirmModal.find('.modal-body .form-group').show();
                    confirmModal.find('.allowed').show();
                    confirmModal.find('#not_allowed_hr').hide();
                    confirmModal.find('.allowed input').prop('disabled', false);
                }
                confirmModal.modal('show');

            });
            console.log($("form").serialize());
            $('#confirmModal form').submit(function(e) {
                console.log("Form submitted");
                $('#confirmModal').modal('hide');
            });
        });
    </script>

    {{-- modal CEO --}}
    <script>
        $(document).ready(function() {
            $('button[name=approve_ceo]').click(function() {
                var value = $(this).val();
                var confirmModal = $('#confirmModal_ceo');
                console.log(value);
                confirmModal.find('input[name=approve_ceo]').val(value);
                if (value === 'disapproval') {
                    confirmModal.find('.modal-body .content').text('ยืนยันที่จะไม่อนุมัติ[❌]หรือไม่?');
                    confirmModal.find('.reason_ceo').hide();
                    confirmModal.find('#not_allowed_ceo').show();
                } else if (value === 'approve') {
                    confirmModal.find('.modal-body .content').text('ยืนยันที่จะอนุมัติ[✔️]หรือไม่?');
                    confirmModal.find('.modal-body .form-group').show();
                    confirmModal.find('#not_allowed_ceo').hide();
                }
                confirmModal.modal('show');

            });
            console.log($("form").serialize());
            $('#confirmModal form').submit(function(e) {
                console.log("Form submitted");
                $('#confirmModal').modal('hide');
            });
        });
    </script>
    <script>
        function calculate_data() {

        }
    </script>



    {{-- Theme App --}}
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>

    @yield('scripts') <!-- เพิ่มส่วนนี้ -->

</body>

</html>
