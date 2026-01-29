@extends('Backend.Layout.MasterLayout')

@section('Content')
<div class="container py-4">
    <div class="row mb-3">
        <div class="col-md-12 text-center">
            <h2 class="text-success">রিসেন্ট দাতাগণের তথ্য তালিকা</h2>
        </div>
    </div>

    <div class="card shadow mb-3">
        <div class="card-header bg-success text-white py-3 d-flex justify-content-between">
            <h5 class="card-title mb-0">দাতাগণের তালিকা</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-success">
                        <tr>
                            <th scope="col" class="text-center">ক্রমিক</th>
                            <th scope="col">নাম</th>
                            <th scope="col">পিতার নাম</th>
                            <th scope="col">গ্রাম</th>
                            <th scope="col" >সহায়তার পরিমান</th>
                            <th scope="col" class="text-center">ইভেন্টের নাম</th>
                            <th scope="col" class="text-center">প্রফাইল</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donations as $donation)
                        <tr>
                            <td class="text-center">@bn($loop->iteration + ($donations->currentPage()-1)*$donations->perPage() )</td>
                            <td>{{ $donation->person->name }}</td>
                            <td>{{ $donation->person->father_husband_name }}</td>
                            <td>{{ $donation->person->village }}</td>
                            <td>@bn( $donation->donate_amount )</td>
                            <td class="text-center">{{ $donation->event->event_name }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalViewMember{{ $donation->person->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Member Modal 1 -->
                        <div class="modal fade" id="modalViewMember{{ $donation->person->id }}" tabindex="-1" aria-hidden="true">
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
                                                <h4 class="mt-3 mb-0">{{ $donation->person->name }}</h4>
                                            </div>
                                            <hr class="mt-2">
                                            <div class="col-md-6">
                                                <p><strong>পিতার/স্বামীর নাম:</strong> {{ $donation->person->father_husband_name }}</p>
                                                <p><strong>মাতার নাম:</strong> {{ $donation->person->mother_name }}</p>
                                                <p><strong>জন্ম তারিখ:</strong> {{ $donation->person->date_of_birth }}</p>
                                                <p><strong>লিঙ্গ:</strong> {{ $donation->person->gender }}</p>
                                                <p><strong>বৈবাহিক অবস্থা:</strong> {{ $donation->person->marital_status }}</p>
                                                <p><strong>রক্তের গ্রুপ:</strong> {{ $donation->person->blood_group }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>মোবাইল:</strong> {{ $donation->person->mobile_number }}</p>
                                                <p><strong>পেশা:</strong>{{$donation->person->profession}}</p>
                                                <p><strong>গ্রাম:</strong> {{ $donation->person->village }}</p>
                                                <p><strong>ডাকঘর:</strong> {{ $donation->person->post_office }}</p>
                                                <p><strong>থানা:</strong> {{ $donation->person->thana }}</p>
                                                <p><strong>জেলা:</strong> {{ $donation->person->district }}</p>
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

        <!-- Footer with Pagination -->
        @if($donations->hasPages())
        <div class="card-footer bg-white">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="small text-muted mb-2 mb-md-0">
                    মোট {{ $donations->total() }} টি রেকর্ডের মধ্যে 
                    {{ $donations->firstItem() }} - {{ $donations->lastItem() }} দেখানো হচ্ছে
                </div>
                <div>
                    {{ $donations->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>

    {{ $donations->links() }}

</div>


@endsection