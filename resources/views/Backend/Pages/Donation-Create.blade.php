@extends('Backend.Layout.MasterLayout')

@section('Content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-success text-white text-center">
                    <h4 class="mb-0">ডোনেশন এন্ট্রি ফর্ম</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('donation.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">   
                        @error('people_id')
                            <label for="people_id" class="form-label text-danger">{{ $message }}</label>
                        @else
                            <label for="people_id" class="form-label">ডোনার এর মোবাইল নং</label>
                        @enderror
                        <input type="number" id="people_id" name="people_id" class="form-control" placeholder="ব্যাক্তির ফোন নং দাও ">
                        </div>

                        <!-- Event -->
                        <div class="mb-3">
                            @error('event_id')
                            <label for="event_id" class="form-label text-danger">{{$message}}</label>
                            @else
                            <label for="event_id" class="form-label">ইভেন্ট নির্বাচন করুন</label>
                            @enderror
                            <select id="event_id" name="event_id" class="form-select">
                                <option selected disabled>একটি ইভেন্ট নির্বাচন করুন</option>
                                @foreach($donationEvent as $event)
                                <option value="{{$event->id}}">{{$event->event_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Donate Amount -->
                        <div class="mb-3">
                            @error('donate_amount')
                            <label for="donate_amount" class="form-label text-danger">{{$message}}</label>
                            @else
                            <label for="donate_amount" class="form-label">ডোনেশনের পরিমাণ (ইংরেজী)</label>
                            @enderror
                            <input type="number" id="donate_amount" name="donate_amount" class="form-control" placeholder="যেমন: 1000">
                        </div>

                        <!-- Date -->
                        <div class="mb-3">
                            @error('date')
                            <label for="date" class="form-label text-danger">{{$message}}</label>
                            @else
                            <label for="date" class="form-label">ডোনেশনের তারিখ</label>
                            @enderror
                            <input type="date" id="date" name="date" class="form-control">
                        </div>

                        <!-- Submit -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success px-4">ডোনেশন জমা দিন</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection