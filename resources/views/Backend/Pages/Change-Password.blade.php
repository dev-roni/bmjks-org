@extends('Backend.Layout.MasterLayout')

@section('Content')

    <div class="row d-flex justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header text-white text-center">পাসওয়ার্ড পরিবর্তন</div>
                <form class="card-body" data-fake>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">বর্তমান পাসওয়ার্ড</label>
                            <input type="password" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">নতুন পাসওয়ার্ড</label>
                            <input type="password" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">পাসওয়ার্ড নিশ্চিত</label>
                            <input type="password" class="form-control">
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <button class="btn btn-success" type="submit">সংরক্ষণ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection