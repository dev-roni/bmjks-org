@extends('Backend.Layout.MasterLayout')

@section('Content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-success text-white text-center">
                    <h4 class="mb-0"> <i class="fa-solid fa-sack-dollar"></i> মাসিক চাঁদা সেটিংস</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('chada.settings.store')}}" method="POST">
                        @csrf

                        <!-- central Chada Amount-->
                        <div class="mb-3">
                            @error('amount')
                            <label for="central_chada_amount" class="form-label text-danger">{{$message}}</label>
                            @else
                            <label for="central_chada_amount" class="form-label">কেন্দ্রীয় কমিটির মাসিক চাঁদার পরিমাণ (ইংরেজী)</label>
                            @enderror
                            <input type="number" id="central_chada_amount" name="central_chada_amount" class="form-control" placeholder="যেমন: 1000">
                        </div>

                        <!--branch Chada Amount -->
                        <div class="mb-3">
                            @error('amount')
                            <label for="branch_chada_amount" class="form-label text-danger">{{$message}}</label>
                            @else
                            <label for="branch_chada_amount" class="form-label">শাখা কমিটির মাসিক চাঁদার পরিমাণ (ইংরেজী)</label>
                            @enderror
                            <input type="number" id="branch_chada_amount" name="branch_chada_amount" class="form-control" placeholder="যেমন: 1000">
                        </div>

                        <!-- Submit -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success px-4">সেটিংস সাবমিট করুন</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection