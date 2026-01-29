@extends('Backend.Layout.MasterLayout')

@section('Content')

    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-md-12 text-center">
                <h2 class="text-success">সম্মানিত দাতাগণের তথ্য তালিকা</h2>
            </div>
        </div>

        <div class="card shadow mb-3">
            <div class="card-header bg-success text-white py-3 d-flex justify-content-between">
                <h5 class="card-title mb-0">দাতাগণের তালিকা</h5>
                <p class="mb-0">মোট @bn($persons->count() ) জন</p>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-success">
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col">নাম</th>
                                <th scope="col">পিতার নাম</th>
                                <th scope="col">গ্রাম</th>
                                <th scope="col">সহায়তার পরিমান</th>
                                <th scope="col" class="text-center">সহায়তার তালিকা</th>
                                <th scope="col" class="text-center">প্রফাইল</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($persons as $person)
                            <tr>
                                <td class="text-center">@bn( $loop->iteration + ($persons->currentPage() - 1) * $persons->perPage() )</td>
                                <td>{{ $person->name }}</td>
                                <td>{{ $person->father_husband_name }}</td>
                                <td>{{ $person->village }}</td>
                                <td>@bn($person->donations_sum_donate_amount )</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-info" title="বিস্তারিত দেখুন"
                                        data-bs-toggle="modal" data-bs-target="#eventView{{ $person->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-info" title="বিস্তারিত দেখুন"
                                        data-bs-toggle="modal" data-bs-target="#modalViewMember{{ $person->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- সহায়তার তালিকা Modal -->
                            <div class="modal fade" id="eventView{{ $person->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content shadow-lg border-0">

                                        <!-- Header -->
                                        <div class="modal-header bg-info text-white">
                                            <h5 class="modal-title">সদস্যের ডোনেশনের তথ্য</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Body -->
                                        <div class="modal-body">
                                            <div class="row g-3">

                                                <!-- Profile Image & Name -->
                                                <div class="col-12 text-center">
                                                    <img src="https://via.placeholder.com/120"
                                                        class="rounded-circle border border-3 border-info shadow-sm object-fit-cover"
                                                        width="120" height="120" alt="Profile">
                                                    <h4 class="mt-3 mb-0">{{ $person->name }}</h4>
                                                    <p class="text-muted">{{ $person->profession ?? 'N/A' }}</p>
                                                </div>

                                                <hr class="mt-3">

                                                <!-- Donation Table -->
                                                <div class="col-12">
                                                    <h6 class="text-success mb-3">ডোনেশনের তালিকা</h6>

                                                    @forelse($person->donations as $donation)
                                                    <div class="card mb-2 shadow-sm">
                                                        <div class="card-body d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <h6 class="mb-1">{{ $donation->event->event_name ?? 'N/A' }}</h6>
                                                                <small class="text-muted">@bn($donation->date)</small>
                                                            </div>
                                                            <div class="fw-bold text-success">
                                                                ৳ @bn($donation->donate_amount)
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @empty
                                                    <div class="alert alert-warning text-center">
                                                        কোনো ডোনেশন পাওয়া যায়নি
                                                    </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                বন্ধ করুন
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Member Modal -->
                            <div class="modal fade" id="modalViewMember{{ $person->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info text-white">
                                            <h5 class="modal-title">সদস্যের বিস্তারিত তথ্য</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-3">
                                                <div class="col-12 text-center">
                                                    <img src="https://via.placeholder.com/120" 
                                                        class="rounded-circle border border-3 border-info shadow-sm object-fit-cover"
                                                        width="120" height="120" alt="Profile">
                                                    <h4 class="mt-3 mb-0">{{ $person->name }}</h4>
                                                </div>
                                                <hr class="mt-2">
                                                <div class="col-md-6">
                                                    <p><strong>পিতার/স্বামীর নাম:</strong> {{ $person->father_husband_name }}</p>
                                                    <p><strong>মাতার নাম:</strong> {{ $person->mother_name }}</p>
                                                    <p><strong>জন্ম তারিখ:</strong> {{ $person->date_of_birth }}</p>
                                                    <p><strong>লিঙ্গ:</strong> {{ $person->gender }}</p>
                                                    <p><strong>বৈবাহিক অবস্থা:</strong> {{ $person->marital_status }}</p>
                                                    <p><strong>রক্তের গ্রুপ:</strong> {{ $person->blood_group }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>মোবাইল:</strong> {{ $person->mobile_number }}</p>
                                                    <p><strong>পেশা:</strong> {{ $person->profession }}</p>
                                                    <p><strong>গ্রাম:</strong> {{ $person->village }}</p>
                                                    <p><strong>ডাকঘর:</strong> {{ $person->post_office }}</p>
                                                    <p><strong>থানা:</strong> {{ $person->thana }}</p>
                                                    <p><strong>জেলা:</strong> {{ $person->district }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বন্ধ করুন</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        মোট @bn( $persons->total() ) টি রেকর্ডের মধ্যে 
                        @bn( $persons->firstItem() ) - @bn( $persons->lastItem() ) দেখানো হচ্ছে
                    </div>
                    <div>
                        {{ $persons->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection