@extends('Backend.Layout.MasterLayout')

@section('Content')

    <div class="card table-card shadow-sm my-3">
        <div class="card-header text-white text-center bg-success">
            <i class="fa-solid fa-hand-holding-dollar"></i> কমিটি সমূহের মাসিক চাঁদার তালিকা
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr class="text-center">
                            <th>ক্রমিক</th>
                            <th>কমিটির নাম</th>
                            <th>মোট চাঁদার পরিমাণ</th>
                            @if(Auth::user()->account_type == 'admin')
                                <th>পরিশোধিত চাঁদা</th>
                            @else
                                <th>আদায়কৃত চাঁদা</th>
                            @endif
                            <th>বকেয়া চাঁদার পরিমাণ</th>
                            <th>চাঁদার তালিকা</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contributions as $contribution)
                            <tr class="text-center">
                                <td data-label="ক্রমিক">@bn($loop->iteration)</td>
                                <td data-label="কমিটির নাম">{{ $contribution->committee->committee_name ?? 'N/A' }}</td>
                                <td data-label="মোট চাঁদার পরিমাণ">
                                    ৳ @bn($contribution->total_paid_amount + $contribution->total_not_paid_amount)
                                </td>

                                @if(Auth::user()->account_type == 'admin')
                                    <td data-label="পরিশোধিত">
                                        ৳ @bn($contribution->total_paid_amount)
                                        <span class="badge bg-success rounded-circle">@bn($contribution->total_paid_count)টি</span>
                                    </td>
                                @else
                                    <td data-label="আদায়কৃত চাঁদা">
                                        ৳ @bn($contribution->total_paid_amount)
                                        <span class="badge bg-success rounded-circle">@bn($contribution->total_paid_count)টি</span>
                                    </td>
                                @endif

                                <td data-label="বকেয়া চাঁদার পরিমাণ">
                                    ৳ @bn($contribution->total_not_paid_amount)
                                    <span class="badge rounded-circle" style="background-color: #ff6b35;">@bn($contribution->total_not_paid_count)টি</span>
                                </td>
                                <td data-label="চাঁদার তালিকা">
                                    <a href="{{ route('monthly.contribution.list', $contribution->committee_id) }}" class="btn btn-outline-success"
                                        title="View">
                                        <i class="fa-solid fa-hand-point-right"></i> বিস্তারিত দেখুন
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection