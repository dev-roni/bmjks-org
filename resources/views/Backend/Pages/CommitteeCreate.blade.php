@extends('Backend.Layout.MasterLayout')

@section('Content')

    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0 text-center">নতুন কমিটি তৈরি করুন</h5>
                    </div>
                    <div class="card-body px-4 py-3">
                        <form action="{{route('committee.year.create')}}" method="POST">
                            @csrf
                            <div class="row g-3">

                                <!-- কমিটি বাছাই করুন -->
                                <div class="col-12">
                                    @error('committee_id')
                                    <label for="committee_type" class="form-label text-danger">{{$message}}</label>
                                    @else
                                    <label for="committee_type" class="form-label">কমিটি নির্বাচন করুন</label>
                                    @enderror
                                    <select name="committee_id" id="committee_type" class="form-select">
                                        <option value="" selected disabled>একটি নির্বাচন করুন</option>
                                        @foreach($committees as $committee)
                                        <option value="{{ $committee->id }}">{{ $committee->committee_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- কমিটির বছরের নাম -->
                                <div class="col-12">
                                    @error('committee_year_name')
                                    <label for="branch_name" class="form-label text-danger">{{$message}}</label>
                                    @else
                                    <label for="branch_name" class="form-label">কমিটির নাম এবং সাল ( বাংলা )</label>
                                    @enderror
                                    <input type="text" name="committee_year_name" id="branch_name" class="form-control"  placeholder="কার্যনির্বাহী কমিটি ২০২৫">
                                </div>

                                <!-- দায়িত্বকাল (শুরুর তারিখ) -->
                                <div class="col-12">
                                    @error('start_date')
                                    <label for="start_date" class="form-label text-danger">{{$message}}</label>
                                    @else
                                    <label for="start_date" class="form-label">দায়িত্ব গ্রহণের তারিখ</label>
                                    @enderror
                                    <input type="date" name="start_date" id="start_date" class="form-control">
                                </div>
                            </div>

                            <div class="mt-4 text-center">
                                <button type="submit" class="btn btn-success">সংরক্ষণ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection