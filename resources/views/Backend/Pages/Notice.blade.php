@extends('Backend.Layout.MasterLayout')

@section('Content')

<!-- Top Stats -->
<div class="row g-3">
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-dark">মোট নোটিশ</small>
                        <h4 class="mb-0">@bn($notice_data->total())</h4>
                    </div>
                    <div class="display-6 social-color">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-dark">এই মাসে প্রকাশিত</small>
                        <h4 class="mb-0">@bn($monthly_notice_count)</h4>
                    </div>
                    <div class="display-6 social-color">
                        <i class="fa-solid fa-calendar"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page Action Buttons -->
<div class="container mt-4">
    <div class="row g-3 align-items-center">

        <!-- Date Filter -->
        <div class="col-12 col-md-6 col-lg-6">
            <form method="GET" action="{{ route('notice.index') }}">
                <div class="input-group">
                    <input class="form-control" name="from_date" type="date" value="{{ request('from_date') }}" required>
                    <span class="input-group-text">থেকে</span>
                    <input class="form-control" name="to_date" type="date" value="{{ request('to_date') }}" required>
                    <button class="btn btn-outline-success" type="submit">বাছাই করুন</button>
                </div>
            </form>
        </div>

        <!-- Search -->
        <div class="col-12 col-md-6 col-lg-4">
            <form method="GET" action="{{ route('notice.index') }}">
                <div class="input-group">
                    <input class="form-control" type="text" name="title" placeholder="নোটিশের শিরোনাম দিন"
                        value="{{ request('title') }}" required>
                    <button class="btn btn-outline-success" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i> অনুসন্ধান
                    </button>
                </div>
            </form>
        </div>

        <!-- New Notice -->
        <div class="col-12 col-md-6 col-lg-2">
            <a class="btn btn-success w-100" data-bs-toggle="modal" href="#modalNotice">
                <i class="fa-solid fa-plus me-1"></i> নতুন নোটিশ
            </a>
        </div>

    </div>
</div>

<!-- Notices Table -->
<div class="card table-card shadow-sm my-3">

    <div class="card-header text-white text-center">
        @if($search || $from || $to)

            <strong>সার্চ রেজাল্ট:</strong>

            {{-- Search Text --}}
            @if($search)
                <em>{{ $search }}</em>
            @endif

            {{-- Date Range --}}
            @if($from && $to)
                {{ $from }} থেকে {{ $to }} পর্যন্ত
            @endif

        @else
            <i class="fa-solid fa-bullhorn"></i> নোটিশ তালিকা
        @endif

    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="text-center">
                        <th>ক্রমিক</th>
                        <th>শিরোনাম</th>
                        <th>তারিখ</th>
                        <th>অ্যাকশন</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($notice_data as $notice)
                    <tr class="text-center">
                        <td>@bn($loop->iteration + ($notice_data->currentPage() - 1) * $notice_data->perPage())</td>
                        <td>{{ $notice->title }}</td>
                        <td>@bn($notice->date)</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">

                                <!-- View -->
                                <button class="action-btn-info" title="বিস্তারিত"
                                    data-bs-toggle="modal" data-bs-target="#noticeViewModal{{$notice->id}}">
                                    <i class="fas fa-eye"></i>
                                </button>

                                <!-- Edit -->
                                <button class="action-btn-success" title="সম্পাদনা"
                                    data-bs-toggle="modal" data-bs-target="#editModal{{$notice->id}}">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <!-- Delete -->
                                <button class="action-btn-danger" title="Delete"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal{{$notice->id}}">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </div>
                        </td>
                    </tr>

                    <!-- View Modal -->
                    <div class="modal fade" id="noticeViewModal{{$notice->id}}">
                        <div class="modal-dialog modal-md modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info text-white">
                                    <h5 class="modal-title">নোটিশের বিস্তারিত</h5>
                                    <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <h5>{{ $notice->title }}</h5>
                                    <p class="text-muted">তারিখ: @bn($notice->date)</p>
                                    <hr>
                                    <p>{{ $notice->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{$notice->id}}">
                        <div class="modal-dialog modal-md modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title">নোটিশ সম্পাদনা</h5>
                                    <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>

                                <form method="POST" action="{{ route('notice.update', $notice->id) }}">
                                    @csrf @method('PUT')

                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label>শিরোনাম</label>
                                            <input type="text" name="title" class="form-control"
                                                value="{{ old('title', $notice->title) }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label>তারিখ</label>
                                            <input type="date" name="date" class="form-control"
                                                value="{{ old('date', $notice->date) }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label>বিবরণ</label>
                                            <textarea name="description" rows="4" class="form-control" required>{{ old('description', $notice->description) }}</textarea>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">বাতিল</button>
                                        <button class="btn btn-success">আপডেট করুন</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{$notice->id}}">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                <div class="modal-header bg-danger text-white">
                                    <h6 class="modal-title">নোটিশটি মুছে ফেলুন</h6>
                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body text-center">
                                    <p>আপনি কি নিশ্চিত?</p>
                                    <p class="text-danger">এই কাজটি পূর্বাবস্থায় ফেরানো যাবে না!</p>
                                </div>

                                <div class="modal-footer justify-content-center">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">বাতিল</button>

                                    <form method="POST" action="{{ route('notice.destroy', $notice->id) }}">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger">মুছে ফেলুন</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    @empty

                    <!-- No Data -->
                    <tr>
                        <td colspan="4">
                            <div class="d-flex flex-column justify-content-center align-items-center py-3">
                                <p class="text-danger fw-bold">কোন ডাটা পাওয়া যায় নি</p>
                                <a class="btn btn-success btn-sm" href="{{ route('notice.index') }}">সকল নোটিশ</a>
                            </div>
                        </td>
                    </tr>

                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>

{{ $notice_data->links() }}

<!-- Create Notice Modal -->
<div class="modal fade" id="modalNotice">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-success text-white">
                <h6 class="modal-title">নতুন নোটিশ যোগ করুন</h6>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('notice.store') }}">
                @csrf

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-12">
                            <label class="form-label">শিরোনাম</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">তারিখ</label>
                            <input type="date" name="date" class="form-control" value="{{ old('date') }}" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label">বিবরণ</label>
                            <textarea class="form-control" name="description" rows="4" required>{{ old('description') }}</textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">বাতিল</button>
                    <button class="btn btn-success">সংরক্ষণ করুন</button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection
