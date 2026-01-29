@extends('frontend.layouts.master_layout')
@section('content') 

<!-- Contact Section -->
<div class="container py-5">

    <!-- Page Header -->
    <section class="page-header mb-4">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="fw-bold">যোগাযোগ করুন</h1>
                    <div class="border-bottom border-white border-3 mx-auto" style="width: 100px; background-color:#1A9B9F;"></div>
                    <p class="mt-2 lead">আপনার মতামত ও পরামর্শ আমাদের কাছে গুরুত্বপূর্ণ</p>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row g-4">

            <!-- Contact Info -->
            <div class="col-12 col-md-6 col-lg-5">
                <div class="card shadow-sm border-0 custom-card">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">ঠিকানা ও যোগাযোগ</h5>
                        <p><i class="fas fa-map-marker-alt text-secondary me-2"></i> {{ $setting->address }}</p>
                        <p><i class="fas fa-phone text-secondary me-2"></i> {{ $setting->phone_no }}</p>
                        <p><i class="fas fa-envelope text-secondary me-2"></i> {{ $setting->email }}</p>

                        <h6 class="fw-bold mt-4 mb-3">সামাজিক মাধ্যম</h6>

                        <div class="d-flex flex-nowrap overflow-auto justify-content-center justify-content-lg-start gap-2 p-2">
                            <a href="{{ $setting->facebook_url }}" class="btn btn-outline-secondary rounded-circle flex-shrink-0">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="{{ $setting->twitter_url }}" class="btn btn-outline-secondary rounded-circle flex-shrink-0">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="{{ $setting->youtube_url }}" class="btn btn-outline-secondary rounded-circle flex-shrink-0">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="{{ $setting->instagram_url }}" class="btn btn-outline-secondary rounded-circle flex-shrink-0">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-1"></div>

            <!-- Contact Form -->
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card shadow-sm border-0 custom-card">
                    <div class="p-5">
                        <h5 class="fw-bold mb-4 text-center">বার্তা পাঠান</h5>
                        <form action="{{ route('message.store') }}" method="POST">
							@csrf
                            <!-- নাম -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold @error('name') text-danger @enderror">
									@error('name')
										{{ $message }}
									@else
										আপনার নাম
									@enderror
								</label>
                                <input type="text" name="name" class="form-control form-control-lg" value="{{ old('name') }}" placeholder="পুরো নাম লিখুন">
                            </div>

                            <!-- মোবাইল -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold @error('phone') text-danger @enderror">
									@error('phone')
										{{ $message }}
									@else
										মোবাইল
									@enderror
								</label>
                                <input type="text" name="phone" class="form-control form-control-lg" value="{{ old('phone') }}" placeholder="মোবাইল">
                            </div>

                            <!-- ইমেইল -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold @error('email') text-danger @enderror">
									@error('email')
										{{ $message }}
									@else
										ইমেইল
									@enderror	
								</label>
                                <input type="email" name="email" class="form-control form-control-lg" value="{{ old('email') }}" placeholder="ইমেইল">
                            </div>

                            <!-- বিষয় -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold @error('subject') text-danger @enderror">
									@error('subject')
										{{ $message }}
									@else
										বিষয়
									@enderror
								</label>
                                <input type="text" name="subject" class="form-control form-control-lg" value="{{ old('subject') }}" placeholder="বার্তার বিষয় লিখুন">
                            </div>

                            <!-- বার্তা -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold @error('message') text-danger @enderror">
									@error('message')
										{{ $message }}
									@else
										বার্তা
									@enderror
								</label>
                                <textarea class="form-control form-control-lg" name="message" rows="6" placeholder="আপনার বার্তা লিখুন">{{ old('message') }}</textarea>
                            </div>

                            <!-- বাটন -->
                            <div>
                                <button type="submit" name="submit" class="btn btn-primary px-5 py-2 d-flex mx-auto">পাঠান</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection