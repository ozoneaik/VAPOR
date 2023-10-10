<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ลงทะเบียน</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    {{-- Date Picker --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>



</head>

<body>
    <section class="vh-100">
        <div class="container py-4 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card"
                        style="border-radius: 1rem;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                        <div class="card-body px-5 py-4 text-start">
                            <h3 class="mb-3 fw-bold text-center">ลงทะเบียน</h3>
                            @if ($errors->any())
                                <div class="alert alert-danger mb-2" role="alert">
                                    {{ $error }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate
                                oninput='password_confirmation.setCustomValidity(password_confirmation.value != password.value ? "Passwords do not match." : "")'>
                                @csrf
                                <div class="row">
                                    <div class="col-md-2">
                                        <img id="Preview_Profile" width="100px" height="100px"
                                            class="border border-dark rounded-circle" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="profile_photo_path" class="form-label">อัปโหลดรูปประจำตัว</label>
                                        <input type="file" id="profile_photo_path" name="profile_img"
                                            class="form-control" accept="image/*">
                                    </div>

                                    <div class="col-md-2">
                                        <img id="Preview_Signature" width="170px" height="100px"
                                            class="border border-dark rounded" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="signature" class="form-label">ลายเซ็น</label>
                                        <input type="file" id="signature" name="signature" class="form-control"
                                            accept="image/*">
                                    </div>
                                    <hr class="mt-4">
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label" for="name">ชื่อ-นามสกุล</label>
                                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                                            class="form-control" placeholder="ชื่อ-นามสกุล" required
                                            autocomplete="name" />
                                        <div class="invalid-feedback text-start">กรุณากรอกชื่อ-นามสกุล</div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label" for="nick_name">ชื่อเล่น</label>
                                        <input type="text" id="nick_name" name="nick_name"
                                            value="{{ old('nick_name') }}" class="form-control" placeholder="ชื่อเล่น"
                                            required />
                                        <div class="invalid-feedback text-start">กรุณากรอกชื่อเล่น</div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label" for="position">ตำแหน่ง</label>
                                        <select class="form-select select2" aria-label="Default select example" name="position">
                                            <option value="Developer [Frontend]">Developer [Frontend]</option>
                                            <option value="Developer [Backend]">Developer [Backend]</option>
                                            <option value="Developer [Fullstack]">Developer [Fullstack]</option>
                                            <option value="Tester">Tester</option>
                                            <option value="UI/UX Designer">UI/UX Designer</option>
                                            <option value="Graphic Designer">Graphic Designer</option>
                                            <option value="PM (Project Manager)">PM (Project Manager)</option>
                                            <option value="HR (Human Resources)">HR (Human Resources)</option>
                                            <option value="BA (Business Analyst)">BA (Business Analyst)</option>
                                            <option value="Quality Assurance (QA) Engineer">Quality Assurance (QA)Engineer</option>
                                            <option value="Data Scientist">Data Scientist</option>
                                            <option value="Data Analyst">Data Analyst</option>
                                            <option value="System Administrator">System Administrator</option>
                                            <option value="Database Administrator">Database Administrator</option>
                                            <option value="Marketing Specialist">Marketing Specialist</option>
                                            <option value="Sales Representative">Sales Representative</option>
                                            <option value="Customer Support Representative">Customer SupportRepresentative</option>
                                            <option value="Content Writer">Content Writer</option>
                                            <option value="Legal Counsel">Legal Counsel</option>
                                            <option value="Financial Analyst">Financial Analyst</option>
                                            <option value="Accountant">Accountant</option>

                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label for="address" class="form-label">ที่อยู่</label>
                                        <input type="text" id="address" name="address"
                                            value="{{ old('address') }}" class="form-control" placeholder="ที่อยู่">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label for="birthday" class="form-label">วันเดือนปีเกิด</label>
                                        <input type="date" id="birthday" name="birthday" class="form-control"
                                            placeholder="วันเดือนปีเกิด">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label for="phone_1" class="form-label">เบอร์โทรศัพท์</label>
                                        <input type="text" id="phone_1" name="phone_1" class="form-control"
                                            placeholder="เบอร์โทรศัพท์" value="{{ old('phone_1') }}" required>
                                        <div class="invalid-feedback text-start">กรุณากรอกเบอร์โทรศัพท์</div>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label for="phone_2" class="form-label">เบอร์โทรศัพท์สำรอง(ถ้ามี)</label>
                                        <input type="text" id="phone_2" name="phone_2"
                                            value="{{ old('phone_2') }}" class="form-control"
                                            placeholder="เบอร์โทรศัพท์">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label" for="email">อีเมล</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            placeholder="อีเมล" value="{{ old('email') }}" required
                                            pattern=".+@bda.co.th" />
                                        <div class="invalid-feedback text-start">กรุณากรอกอีเมล(@bda.co.th)</div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label" for="password">รหัสผ่าน</label>
                                        <input type="password" id="password" name="password" class="form-control"
                                            placeholder="รหัสผ่าน" required />
                                        <div class="invalid-feedback text-start">กรุณากรอกรหัสผ่าน</div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label" for="password_confirmation">ยืนยันรหัสผ่าน</label>
                                        <input type="password" id="password_confirmation"
                                            name="password_confirmation" class="form-control"
                                            placeholder="ยืนยันรหัสผ่าน" required />
                                        <div class="invalid-feedback text-start">
                                            กรุณากรอกรหัสผ่าน(หรือรหัสผ่านไม่ตรงกัน)</div>
                                    </div>
                                </div>
                                <div class="d-grid gap-2 mt-2">
                                    <button class="btn btn-info text-white" type="submit">ลงทะเบียน</button>
                                </div>

                            </form>
                            <hr>
                            <div class="d-grid gap-2 text-center">
                                <a href="{{ route('login') }}" class="">ลงทะเบียนเรียบร้อยแล้ว?</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>

    <script>
        const image = document.querySelector("img"),
            input = document.querySelector("input");

        input.addEventListener("change", () => {
            image.src = URL.createObjectURL(input.files[0]);
        });
    </script>


    {{-- UPLOAD PROFILE --}}
    <script>
        let imgInput = document.querySelector('#profile_photo_path');
        let Preview_Profile = document.querySelector('#Preview_Profile');
        imgInput.onchange = evt => {
            const [file] = imgInput.files;
            if (file) {
                Preview_Profile.src = URL.createObjectURL(file);
            }
        }
    </script>
    {{-- UPLOAD SIGNAGER --}}
    <script>
        let imgInput1 = document.querySelector('#signature');
        let Preview_Signature = document.querySelector('#Preview_Signature');
        imgInput1.onchange = evt => {
            const [file] = imgInput1.files;
            if (file) {
                Preview_Signature.src = URL.createObjectURL(file);
            }
        }
    </script>
    <script>
        flatpickr("#birthday", {});
    </script>

</body>

</html>
