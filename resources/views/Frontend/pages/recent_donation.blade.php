@extends('frontend.layouts.master_layout')
@section('content')
<div class="container donator py-4">

    <!-- Page Header -->
    <section class="page-header mt-5 text-center">
        <h1 class="fw-bold">সম্প্রতি ডোনেশন তালিকা</h1>
        <div class="border-bottom border-3 mx-auto" style="width: 100px; background-color:#1A9B9F;"></div>
        <p class="mt-2 lead">সম্প্রতি দাতাগণের সম্পূর্ণ বিবরণ</p>
    </section>

    <!-- Main Card -->
    <div class="card shadow-lg border-0 mt-4">
        <div class="card-header bg-primary text-white py-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h5 class="mb-0"><i class="fas fa-users me-2"></i>দাতাগণের তালিকা</h5>
        </div>

        <div class="card-body ">
            <!-- Desktop Table -->
            <div class="table d-none d-md-block">
                <table class="table table-bordered table-hover mb-0 align-middle">
                    <thead class="table-success text-center">
                        <tr>
                            <th>ক্রমিক</th>
                            <th>নাম</th>
                            <th>পিতার নাম</th>
                            <th>গ্রাম</th>
                            <th>সহায়তার পরিমান</th>
                            <th>সহায়তার ইভেন্টের নাম</th>
                            <th>প্রফাইল</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donations as $donation)
                        <tr>
                            <td class="text-center fw-bold text-success">
                                @bn($loop->iteration + ($donations->currentPage() - 1) * $donations->perPage())
                            </td>
                            <td>
                                <div class="d-flex align-items-center">

                                         
                                    <span class="fw-semibold">{{ $donation->person->name }}</span>
                                </div>
                            </td>
                            <td>{{ $donation->person->father_husband_name ?? 'তথ্য পাওয়া যায়নি' }}</td>
                            <td>{{ $donation->person->village ?? 'তথ্য পাওয়া যায়নি' }}</td>
                            <td class="text-center text-success fw-bold">৳ @bn($donation->donate_amount)</td>
                            <td class="text-center text-success fw-bold">{{$donation->event->event_name}}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-accent" data-bs-toggle="modal" data-bs-target="#modalViewMember{{ $donation->person->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">কোনো দাতা পাওয়া যায়নি</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="d-block d-md-none">
                @forelse($donations as $donation)
                <div class="card shadow-sm mb-3 border-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            
                            <div>
                                <h5 class="mb-0 fw-bold">{{ $donation->person->name }}</h5>
                                <small class="text-muted">{{$donation->person->relation_type}}: {{ $donation->person->father_husband_name ?? 'তথ্য পাওয়া যায়নি' }}</small>
                            </div>
                        </div>
                        <p class="mb-1"><strong>গ্রাম:</strong> {{ $donation->person->village ?? 'তথ্য পাওয়া যায়নি' }}</p>
                        <p class="mb-2"><strong>সহায়তা পরিমান:</strong> <span class="text-success fw-bold">৳ @bn($donation->donate_amount)</span></p>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-sm btn-accent w-50" data-bs-toggle="modal" data-bs-target="#modalViewMember{{ $donation->person->id }}">
                                <i class="fas fa-user me-1"></i> প্রোফাইল
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center text-muted py-4">
                    <i class="fas fa-users fa-3x mb-2"></i>
                    <p>কোনো দাতা পাওয়া যায়নি</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Card Footer -->
        <div class="card-footer bg-light text-center">
            <div class="small text-muted">
                মোট @bn($donations->total()) টি রেকর্ডের মধ্যে 
                <strong>@bn($donations->firstItem()) - @bn($donations->lastItem())</strong> দেখানো হচ্ছে
            </div>
            <div class="mt-2">
                {{ $donations->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

    @forelse($donations as $donation)


    <!-- Member Profile Modal -->
    <div class="modal fade" id="modalViewMember{{ $donation->person->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-secondary text-dark">
                    <h5 class="modal-title text-white">
                        <i class="fas fa-user-circle me-2"></i>সদস্যের বিস্তারিত তথ্য
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <img src="{{ $donation->person->photo ? asset('uploads/person/'.$donation->person->photo) 
                                    : 'https://ui-avatars.com/api/?name=' . urlencode($donation->person->name) . '&background=random&color=fff&size=120' }}" 
                                    class="rounded-circle border border-3 shadow-sm" 
                                    width="120" height="120">

                        <h4 class="mt-3 mb-1 text-dark">{{ $donation->person->name }}</h4>
                    </div>
                    <hr>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <h6 class="text-success mb-3  pb-2"><i class="fas fa-user me-2"></i>ব্যক্তিগত তথ্য</h6>
                            <p><strong>{{$donation->person->relation_type}}:</strong> {{ $donation->person->father_husband_name ?? 'তথ্য পাওয়া যায়নি' }}</p>
                            <p><strong>মাতার নাম:</strong> {{ $donation->person->mother_name ?? 'তথ্য পাওয়া যায়নি' }}</p>
                            <p><strong>পেশা:</strong> {{ $donation->person->profession ?? 'তথ্য পাওয়া যায়নি' }}</p>
                            <p><strong>লিঙ্গ:</strong> {{ $donation->person->gender ?? 'তথ্য পাওয়া যায়নি' }}</p>
                            <p><strong>বৈবাহিক অবস্থা:</strong> {{ $donation->person->marital_status ?? 'তথ্য পাওয়া যায়নি' }}</p>
                            <p><strong>রক্তের গ্রুপ:</strong> <span class="badge bg-danger">{{ $donation->person->blood_group ?? 'তথ্য পাওয়া যায়নি' }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-success mb-3  pb-2"><i class="fas fa-address-card me-2"></i>যোগাযোগের তথ্য</h6>
                            <p><strong>পেশা:</strong> {{ $donation->person->profession ?? 'তথ্য পাওয়া যায়নি' }}</p>
                            <p><strong>গ্রাম:</strong> {{ $donation->person->village ?? 'তথ্য পাওয়া যায়নি' }}</p>
                            <p><strong>ডাকঘর:</strong> {{ $donation->person->post_office ?? 'তথ্য পাওয়া যায়নি' }}</p>
                            <p><strong>থানা:</strong> {{ $donation->person->thana ?? 'তথ্য পাওয়া যায়নি' }}</p>
                            <p><strong>জেলা:</strong> {{ $donation->person->district ?? 'তথ্য পাওয়া যায়নি' }}</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>বন্ধ করুন
                    </button>
                </div>
            </div>
        </div>
    </div>

    @empty
        কোন ডাটা নেই
    @endforelse

@endsection
