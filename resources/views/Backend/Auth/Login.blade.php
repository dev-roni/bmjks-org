@include('Backend.Partials.Header')

    <div class="container py-5">
        <div class="row justify-content-center align-items-center" style="min-height: 90vh;">
            <div class="col-sm-10 col-md-8 col-lg-5">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-3"
                                style="background: linear-gradient(135deg, rgba(0,106,78,0.1), rgba(0,143,90,0.1));">
                            
                                <img src="{{asset('Frontend-Assets/images/header/logo.png')}}" alt="Logo" style="width:38px; height:38px; object-fit:contain;">
                                <strong class="text-success">বাংলাদেশ মণিপুরী যুব কল্যাণ সমিতি</strong>
                            </div>
                        </div>
                        <h5 class="text-center fw-bold mb-1">অ্যাডমিন লগইন</h5>
                        <p class="text-center text-muted mb-4">অনুগ্রহ করে আপনার লগইন তথ্য দিন</p>

                        @if(session('success'))
                            <div id="alert-message" class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3"
                                role="alert" style="z-index: 1050; min-width: 250px;">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div id="alert-message" class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-3"
                                role="alert" style="z-index: 1050; min-width: 250px;">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('login.submit') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <!-- Email Floating Label -->
                            <div class="form-floating mb-3">
                                <input type="text" name="username" class="form-control" id="text" placeholder="ইউজারনেম">
                                <label for="text">ইউজারনেম</label>
                                <!-- Email Error -->
                                @error('email')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password Floating Label -->
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="password" placeholder="পাসওয়ার্ড">
                                <label for="password">পাসওয়ার্ড</label>
                                <!-- Password Error -->
                                @error('password')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- <div class="d-flex justify-content-end align-items-center mb-3">
                                <a href="#" class="text-decoration-none text-success">পাসওয়ার্ড ভুলে গেছেন?</a>
                            </div> -->

                            <button type="submit" name="submit" class="btn btn-success w-100 mb-3">লগইন</button>

                            <div class="text-center">
                                <a class="btn btn-outline-secondary btn-sm" href="#"><i
                                        class="fa-solid fa-arrow-left-long me-1"></i>পাবলিক সাইটে ফিরুন</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@include('Backend.Partials.Footer')

    <script>
        (function () {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>