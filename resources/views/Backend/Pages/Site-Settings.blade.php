@extends('Backend.Layout.MasterLayout')

@section('Content')

    <!-- ব্র্যান্ডিং সেকশন -->
    <div class="site-settings-section mt-3">
        <div class="card shadow-sm">
            <div class="card-header text-white bg-success text-center">
                <i class="fa-solid fa-palette me-2"></i>ব্র্যান্ডিং
            </div>
            <div class="card-body">
                <form action="{{ route('branding.update') }}" method="POST" id="brandingForm" data-fake enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label @error('site_title') text-danger @enderror">
                                @error('site_title')
                                    {{ $message }}
                                @else
                                    সাইট টাইটেল
                                @enderror
                            </label>
                            <input type="text" name="site_title" value="{{ old('site_title', $settings->site_title) }}" class="form-control" placeholder="মণিপুরী যুব কল্যাণ সমিতি" >
                        </div>

                        <div class="col-md-6">
                            <label class="form-label @error('tagline') text-danger @enderror">
                                @error('tagline')
                                    {{ $message }}
                                @else
                                    ট্যাগলাইন
                                @enderror
                            </label>
                            <input type="text" name="tagline" value="{{ old('tagline', $settings->tagline) }}" class="form-control" placeholder="বামযুক টেগ লাইন">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label @error('logo') text-danger @enderror">
                                @error('logo')
                                    {{ $message }}
                                @else
                                    লোগো (Logo)
                                @enderror
                            </label>
                            <input type="file" name="logo" class="form-control" accept="image/*">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label @error('favicon') text-danger @enderror">
                                @error('favicon')
                                    {{ $message }}
                                @else
                                    ফ্যাভিকন (Favicon)
                                @enderror
                            </label>
                            <input type="file" name="favicon" class="form-control" accept="image/x-icon,image/png">
                        </div>

                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" name="submit" class="btn btn-success">
                            <i class="fa-solid fa-save me-1"></i>ব্র্যান্ডিং আপডেট
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SEO সেকশন -->
    <div class="site-settings-section">
        <div class="card shadow-sm">
            <div class="card-header text-white bg-info text-center">
                <i class="fa-solid fa-search me-2"></i>SEO সেটিংস
            </div>
            <div class="card-body">
                <form action="{{ route('seo.update') }}" method="POST" id="seoForm" data-fake>
                    @csrf
                    @method('PUT')
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label @error('meta_title') text-danger @enderror">
                                @error('meta_title')
                                    {{ $message }}
                                @else
                                    মেটা টাইটেল (Meta Title)
                                @enderror
                            </label>
                            <input type="text" name="meta_title" value="{{ old('meta_title', $settings->meta_title) }}" class="form-control" placeholder="পাতার শিরোনাম">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label @error('meta_description') text-danger @enderror">
                                @error('meta_description')
                                    {{ $message }}
                                @else
                                    মেটা বিবরণ (Meta Description)
                                @enderror
                            </label>
                            <textarea class="form-control" name="meta_description" rows="1"
                                placeholder="পেজের সংক্ষিপ্ত বিবরণ (১৫০-১৬০ অক্ষর)">{{ old('meta_description', $settings->meta_description) }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label @error('meta_keywords') text-danger @enderror">
                                @error('meta_keywords')
                                    {{ $message }}
                                @else
                                    মেটা কীওয়ার্ড (Meta Keywords)
                                @enderror
                            </label>
                            <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $settings->meta_keywords) }}" class="form-control" placeholder="কীওয়ার্ড, কমা দিয়ে আলাদা করুন">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label @error('google_search_console') text-danger @enderror">
                                @error('google_search_console')
                                    {{ $message }}
                                @else
                                    Google Search Console
                                @enderror
                            </label>
                            <input type="text" name="google_search_console" value="{{ old('google_search_console', $settings->google_search_console) }}" class="form-control" placeholder="Google Search Console Code">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label @error('google_analytics') text-danger @enderror">
                                @error('google_analytics')
                                    {{ $message }}
                                @else
                                    Google Analytics
                                @enderror
                            </label>
                            <input type="text" name="google_analytics" value="{{ old('google_analytics', $settings->google_analytics) }}" class="form-control" placeholder="Google Analytics Code">
                        </div>

                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" name="submit" class="btn btn-info text-white">
                            <i class="fa-solid fa-save me-1"></i>SEO সেটিংস আপডেট
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ছবি স্লাইড সেকশন -->
    <div class="site-settings-section">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <i class="fa-solid fa-images me-2"></i>ছবি স্লাইড সেটিংস
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <!-- স্লাইড ১ -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('storage/'.$settings->slide_image_1_path) }}" class="card-img-top" alt="স্লাইড ১"
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <form action="{{ route('slide.one.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-2">
                                        <label class="form-label @error('slide_title') text-danger @enderror">
                                            @error('slide_title')
                                                {{ $message }}
                                            @else
                                                শিরোনাম
                                            @enderror
                                        </label>
                                        <input type="text" name="slide_title" value="{{ old('slide_title', $settings->slide_title_1) }}" class="form-control" placeholder="স্লাইড ১ শিরোনাম">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label @error('slide_description') text-danger @enderror">
                                            @error('slide_description')
                                                {{ $message }}
                                            @else
                                                বিবরণ
                                            @enderror
                                        </label>
                                        <textarea class="form-control" name="slide_description" rows="2" placeholder="স্লাইড ১ বিবরণ">{{ old('slide_description', $settings->slide_description_1) }}</textarea>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label @error('slide_image') text-danger @enderror">
                                            @error('slide_image')
                                                {{ $message }}
                                            @else
                                                ছবি আপলোড
                                            @enderror
                                        </label>
                                        <input type="file" name="slide_image" class="form-control" accept="image/*">
                                    </div>
                                    <div class="text-center mt-3">
                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-save me-1"></i>আপডেট
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- স্লাইড ২ -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('storage/'.$settings->slide_image_2_path) }}" class="card-img-top" alt="স্লাইড ২"
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <form action="{{ route('slide.two.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-2">
                                        <label class="form-label @error('slide_title_2') text-danger @enderror">
                                            @error('slide_title_2')
                                                {{ $message }}
                                            @else
                                                শিরোনাম
                                            @enderror
                                        </label>
                                        <input type="text" name="slide_title_2" value="{{ old('slide_title_2', $settings->slide_title_2) }}" class="form-control" placeholder="স্লাইড ২ শিরোনাম">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label @error('slide_description_2') text-danger @enderror">
                                            @error('slide_description_2')
                                                {{ $message }}
                                            @else
                                                বিবরণ
                                            @enderror
                                            </label>
                                        <textarea class="form-control" name="slide_description_2" rows="2" placeholder="স্লাইড ২ বিবরণ">{{ old('slide_description_2', $settings->slide_description_2) }}</textarea>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label @error('slide_image_2') text-danger @enderror">
                                            @error('slide_image_2')
                                                {{ $message }}
                                            @else
                                                ছবি আপলোড
                                            @enderror
                                        </label>
                                        <input type="file" name="slide_image_2" class="form-control" accept="image/*">
                                    </div>
                                    <div class="text-center mt-3">
                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-save me-1"></i>আপডেট
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- স্লাইড ৩ -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('storage/'.$settings->slide_image_3_path) }}" class="card-img-top" alt="স্লাইড ৩"
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <form action="{{ route('slide.three.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-2">
                                        <label class="form-label @error('slide_title_3') text-danger @enderror">
                                            @error('slide_title_3')
                                                {{ $message }}
                                            @else
                                                শিরোনাম
                                            @enderror
                                        </label>
                                        <input type="text" name="slide_title_3" value="{{ old('slide_title_3', $settings->slide_title_3) }}" class="form-control" placeholder="স্লাইড ৩ শিরোনাম">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label @error('slide_description_3') text-danger @enderror">
                                            @error('slide_description_3')
                                                {{ $message }}
                                            @else
                                                বিবরণ
                                            @enderror
                                        </label>
                                        <textarea class="form-control" name="slide_description_3" rows="2" placeholder="স্লাইড ৩ বিবরণ">{{ old('slide_description_3', $settings->slide_description_3) }}</textarea>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label @error('slide_image_3') text-danger @enderror">
                                            @error('slide_image_3')
                                                {{ $message }}
                                            @else
                                                ছবি আপলোড
                                            @enderror
                                        </label>
                                        <input type="file" name="slide_image_3" class="form-control" accept="image/*">
                                    </div>
                                    <div class="text-center mt-3">
                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-save me-1"></i>আপডেট
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <!-- স্লাইড ৪ -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('storage/'.$settings->slide_image_4_path) }}" class="card-img-top" alt="স্লাইড ৪"
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <form action="{{ route('slide.four.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-2">
                                        <label class="form-label @error('slide_title_4') text-danger @enderror">
                                            @error('slide_title_4')
                                                {{ $message }}
                                            @else
                                                শিরোনাম
                                            @enderror
                                        </label>
                                        <input type="text" name="slide_title_4" value="{{ old('slide_title_4', $settings->slide_title_4) }}" class="form-control" placeholder="স্লাইড ১ শিরোনাম">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label @error('slide_description_4') text-danger @enderror">
                                            @error('slide_description_4')
                                                {{ $message }}
                                            @else
                                                বিবরণ
                                            @enderror
                                        </label>
                                        <textarea class="form-control" name="slide_description_4" rows="2" placeholder="স্লাইড ১ বিবরণ">{{ old('slide_description_4', $settings->slide_description_4) }}</textarea>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label @error('slide_image_4') text-danger @enderror">
                                            @error('slide_image_4')
                                                {{ $message }}
                                            @else
                                                ছবি আপলোড
                                            @enderror
                                        </label>
                                        <input type="file" name="slide_image_4" class="form-control" accept="image/*">
                                    </div>
                                    <div class="text-center mt-3">
                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-save me-1"></i>আপডেট
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- স্লাইড ৫ -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('storage/'.$settings->slide_image_5_path) }}" class="card-img-top" alt="স্লাইড ৫"
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <form action="{{ route('slide.five.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-2">
                                        <label class="form-label @error('slide_title_5') text-danger @enderror">
                                            @error('slide_title_5')
                                                {{ $message }}
                                            @else
                                                শিরোনাম
                                            @enderror
                                        </label>
                                        <input type="text" name="slide_title_5" value="{{ old('slide_title_5', $settings->slide_title_5) }}" class="form-control" placeholder="স্লাইড ২ শিরোনাম">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label @error('slide_description_5') text-danger @enderror">
                                            @error('slide_description_5')
                                                {{ $message }}
                                            @else
                                                বিবরণ
                                            @enderror
                                            </label>
                                        <textarea class="form-control" name="slide_description_5" rows="2" placeholder="স্লাইড ২ বিবরণ">{{ old('slide_description_5', $settings->slide_description_5) }}</textarea>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label @error('slide_image_5') text-danger @enderror">
                                            @error('slide_image_5')
                                                {{ $message }}
                                            @else
                                                ছবি আপলোড
                                            @enderror
                                        </label>
                                        <input type="file" name="slide_image_5" class="form-control" accept="image/*">
                                    </div>
                                    <div class="text-center mt-3">
                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-save me-1"></i>আপডেট
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- স্লাইড ৬ -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('storage/'.$settings->slide_image_6_path) }}" class="card-img-top" alt="স্লাইড ৬"
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <form action="{{ route('slide.six.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-2">
                                        <label class="form-label @error('slide_title_6') text-danger @enderror">
                                            @error('slide_title_6')
                                                {{ $message }}
                                            @else
                                                শিরোনাম
                                            @enderror
                                        </label>
                                        <input type="text" name="slide_title_6" value="{{ old('slide_title_6', $settings->slide_title_6) }}" class="form-control" placeholder="স্লাইড ৩ শিরোনাম">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label @error('slide_description_6') text-danger @enderror">
                                            @error('slide_description_6')
                                                {{ $message }}
                                            @else
                                                বিবরণ
                                            @enderror
                                        </label>
                                        <textarea class="form-control" name="slide_description_6" rows="2" placeholder="স্লাইড ৩ বিবরণ">{{ old('slide_description_6', $settings->slide_description_6) }}</textarea>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label @error('slide_image_6') text-danger @enderror">
                                            @error('slide_image_6')
                                                {{ $message }}
                                            @else
                                                ছবি আপলোড
                                            @enderror
                                        </label>
                                        <input type="file" name="slide_image_6" class="form-control" accept="image/*">
                                    </div>
                                    <div class="text-center mt-3">
                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-save me-1"></i>আপডেট
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- গুরুত্বপূর্ণ লিংক -->
    <div class="site-settings-section mt-3">
        <div class="card shadow-sm">
            <div class="card-header text-white bg-success text-center">
                <i class="fa-solid fa-link me-2"></i>গুরুত্বপূর্ণ লিংক
            </div>
            <div class="card-body">
                <form action="{{ route('footer.link.update') }}" method="POST" id="brandingForm" data-fake>
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label @error('link_name_1') text-danger @enderror">
                                @error('link_name_1')
                                    {{ $message }}
                                @else
                                    লিংক নাম ১
                                @enderror
                            </label>
                            <input type="text" name="link_name_1" value="{{ old('link_name_1', $settings->link_name_1) }}" class="form-control" placeholder="লিংকের নাম লিখুন">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label @error('link_1') text-danger @enderror">
                                @error('link_1')
                                    {{ $message }}
                                @else
                                    লিংক
                                @enderror
                            </label>
                            <input type="url" name="link_1" value="{{ old('link_1', $settings->link_1) }}" class="form-control" placeholder="https://example.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label @error('link_name_2') text-danger @enderror">
                                @error('link_name_2')
                                    {{ $message }}
                                @else
                                    লিংক নাম ২
                                @enderror
                            </label>
                            <input type="text" name="link_name_2" value="{{ old('link_name_2', $settings->link_name_2) }}" class="form-control" placeholder="লিংকের নাম লিখুন">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label @error('link_2') text-danger @enderror">
                                @error('link_2')
                                    {{ $message }}
                                @else
                                    লিংক
                                @enderror
                            </label>
                            <input type="url" name="link_2" value="{{ old('link_2', $settings->link_2) }}" class="form-control" placeholder="https://example.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label @error('link_name_3') text-danger @enderror">
                                @error('link_name_3')
                                    {{ $message }}
                                @else
                                    লিংক নাম ৩
                                @enderror
                            </label>
                            <input type="text" name="link_name_3" value="{{ old('link_name_3', $settings->link_name_3) }}" class="form-control" placeholder="লিংকের নাম লিখুন">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label @error('link_3') text-danger @enderror">
                                @error('link_3')
                                    {{ $message }}
                                @else
                                    লিংক
                                @enderror
                            </label>
                            <input type="url" name="link_3" value="{{ old('link_3', $settings->link_3) }}" class="form-control" placeholder="https://example.com">
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" name="submit" class="btn btn-success">
                            <i class="fa-solid fa-save me-1"></i>লিংক আপডেট
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- সোশ্যাল মিডিয়া লিংক সেকশন -->
    <div class="site-settings-section">
        <div class="card shadow-sm">
            <div class="card-header text-white bg-danger text-center">
                <i class="fa-solid fa-share-nodes me-2"></i>সোশ্যাল মিডিয়া লিংক
            </div>
            <div class="card-body">
                <form action="{{ route('social.update') }}" method="POST" id="socialMediaForm" data-fake>
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label @error('facebook_url') text-danger @enderror">
                                <i class="fa-brands fa-facebook text-primary me-1"></i>
                                @error('facebook_url')
                                    {{ $message }}
                                @else
                                    Facebook
                                @enderror
                            </label>
                            <input type="url" name="facebook_url" value="{{ old('facebook_url', $settings->facebook_url) }}" class="form-control" placeholder="https://facebook.com/yourpage">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label @error('youtube_url') text-danger @enderror">
                                <i class="fa-brands fa-youtube text-danger me-1"></i>
                                @error('youtube_url')
                                    {{ $message }}
                                @else
                                    YouTube
                                @enderror
                            </label>
                            <input type="url" name="youtube_url" value="{{ old('youtube_url', $settings->youtube_url) }}" class="form-control" placeholder="https://youtube.com/@yourchannel">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label @error('twitter_url') text-danger @enderror">
                                <i class="fa-brands fa-twitter text-info me-1"></i>
                                @error('twitter_url')
                                    {{ $message }}
                                @else
                                    Twitter
                                @enderror
                            </label>
                            <input type="url" name="twitter_url" value="{{ old('twitter_url', $settings->twitter_url) }}" class="form-control" placeholder="https://twitter.com/yourhandle">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label @error('instagram_url') text-danger @enderror">
                                <i class="fa-brands fa-instagram text-warning me-1"></i>
                                @error('instagram_url')
                                    {{ $message }}
                                @else
                                    Instagram
                                @enderror
                            </label>
                            <input type="url" name="instagram_url" value="{{ old('instagram_url', $settings->instagram_url) }}" class="form-control" placeholder="https://instagram.com/yourprofile">
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" name="submit" class="btn btn-danger">
                            <i class="fa-solid fa-save me-1"></i>সোশ্যাল মিডিয়া আপডেট
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- যোগাযোগের তথ্য সেকশন -->
    <div class="site-settings-section">
        <div class="card shadow-sm">
            <div class="card-header text-dark bg-warning text-center">
                <i class="fa-solid fa-address-book me-2"></i>যোগাযোগের তথ্য
            </div>
            <div class="card-body">
                <form action="{{ route('contact.update') }}" method="POST" id="contactForm" data-fake>
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label @error('email') text-danger @enderror">
                                <i class="fa-solid fa-envelope me-1"></i>
                                @error('email')
                                    {{ $message }}
                                @else
                                    ইমেইল
                                @enderror
                            </label>
                            <input type="email" name="email" value="{{ old('email', $settings->email) }}" class="form-control" placeholder="info@example.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label @error('phone_no') text-danger @enderror">
                                <i class="fa-solid fa-mobile me-1"></i>
                                @error('phone_no')
                                    {{ $message }}
                                @else
                                    মোবাইল
                                @enderror
                            </label>
                            <input type="text" name="phone_no" value="{{ old('phone_no', $settings->phone_no) }}" class="form-control" placeholder="01XXXXXXXXX">
                        </div>
                        <div class="col-12">
                            <label class="form-label @error('address') text-danger @enderror">
                                <i class="fa-solid fa-location-dot me-1"></i>
                                @error('address')
                                    {{ $message }}
                                @else
                                    ঠিকানা
                                @enderror
                            </label>
                            <textarea class="form-control" name="address" rows="3" placeholder="সম্পূর্ণ ঠিকানা লিখুন">{{ old('address', $settings->address) }}</textarea>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" name="submit" class="btn btn-warning">
                            <i class="fa-solid fa-save me-1"></i>যোগাযোগের তথ্য আপডেট
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection