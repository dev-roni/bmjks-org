@extends('Backend.Layout.MasterLayout')

@section('Content')

    <div class="container my-4">
        <div class="card shadow-sm mx-auto" style="max-width: 70rem;">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">ডোনেশন ইভেন্ট তৈরি করুন </h5>
            </div>
            <form action="{{route('donation.event.store')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            @error('event_name')
                            <label class="form-label text-danger">{{$message}}</label>
                            @else
                            <label class="form-label" >ডোনেশনের নতুন ইভেন্টের নাম (বাংলা)</label>
                            @enderror
                            <input name="event_name" placeholder="ডোনেশনের নাম লিখুন (বাংলায়)" class="form-control" required>
                        </div>
                        <div class="col-md-12">
                            @error('description')
                            <label class="form-label text-danger">{{$message}}</label>
                            @else
                            <label class="form-label" >ডোনেশনের ডেসক্রিপশন (বাংলা)</label>
                            @enderror
                            <input name="description" placeholder="ডোনেশনের ডেসক্রিপশন লিখুন (বাংলায়)" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-success">সংরক্ষণ</button>
                </div>
            </form>
        </div>

    </div>
@endsection