@extends('Backend.Layout.MasterLayout')

@section('Content')

    <!-- Page Action Buttons -->
    <div class="page-action-buttons">
        <div class="row g-2 d-flex justify-content-center align-items-center">

            <!-- Active/Inactive Buttons -->
            <div class="col-12 col-lg-3">
                <div class="btn-group w-100">
                    <a href="{{ route('contact.unread') }}" class="btn deactive-button {{ Route::is('contact.unread') ? 'active' : '' }}"
                        id="inactiveBtn">
                        দেখা হয়নি
                    </a>

                    <a href="{{ route('contact.read') }}" class="btn btn-outline-success {{ Route::is('contact.read') ? 'active' : '' }}"
                        id="activeBtn">
                        দেখা হয়েছে
                    </a>
                </div>
            </div>

        </div>
    </div>

    <div class="card table-card shadow-sm mt-3">
        <div class="card-header text-white text-center">
            <i class="fas fa-comments"></i> ভিজিটর মেসেজ তালিকা
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if($contacts->isEmpty())
                    <div class="alert alert-danger text-center fw-semibold">
                        এই মেসেজ টেবিলে কোনো তথ্য নেই।
                    </div>
                @else
                    <table class="table align-middle">
                        <thead>
                            <tr class="text-center">
                                <th>ক্রমিক</th>
                                <th>নাম</th>
                                <th>মোবাইল</th>
                                <th>মেসেজ টাইটেল</th>
                                <th>মেসেজ</th>
                                <th>অ্যাকশন</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)
                                <tr class="text-center">
                                    <td data-label="ক্রমিক">@bn( $loop->iteration + ($contacts->currentPage()-1)*$contacts->perPage() )</td>
                                    <td data-label="নাম">{{ $contact->name }}</td>
                                    <td data-label="মোবাইল">@bn($contact->phone_no)</td>
                                    <td data-label="মেসেজ টাইটেল">{{ Str::limit($contact->message_title, 15, '....') }}</td>
                                    <td data-label="মেসেজ">{{ Str::limit($contact->message, 20, '....') }}</td>
                                    <td data-label="অ্যাকশন">
                                        <div class="d-flex flex-row justify-content-center gap-2">
                                            {{-- Message Button --}}
                                            @if (route::is('contact.unread'))
                                                <a class="btn action-btn-warning" title="মেসেজ পাঠান" href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $contact->email }}&su={{ $contact->message_title }}&body=Type your message here" target="_blank">
                                                    <i class="fa-solid fa-envelope"></i>
                                                </a>
                                            @endif
                                            <!-- View Button -->
                                            <button type="button" class="btn action-btn-info" title="মেসেজ দেখুন"
                                                data-bs-toggle="modal" data-bs-target="#viewMessageModal{{ $contact->id }}"
                                                data-id="{{ $contact->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            {{-- Confirm Button --}}
                                            @if (route::is('contact.unread'))
                                                <form action="{{ route('contact.read.confirm', $contact->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn action-btn-success" title="দেখা হয়েছে">
                                                        <i class="fa-solid fa-check"></i>
                                                    </button>
                                                </form>
                                            @endif

                                            @if (route::is('contact.read'))
                                                <form action="{{ route('contact.unread.confirm', $contact->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn action-btn-danger" title="দেখা হয়নি">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </button>
                                                </form>
                                            @endif

                                        </div>
                                    </td>
                                </tr>

                                <!-- User Message View Modal -->
                                <div class="modal fade" id="viewMessageModal{{ $contact->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info text-white">
                                                <h6 class="modal-title">মেসেজের বিস্তারিত</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>নাম:</strong> {{ $contact->name }}</p>
                                                <p><strong>মোবাইল:</strong> @bn($contact->phone_no)</p>
                                                <p><strong>মেসেজ টাইটেল:</strong> {{ $contact->message_title }}</p>
                                                <p><strong>মেসেজ:</strong> {{ $contact->message }}</p>
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
                @endif
            </div>
        </div>
    </div>

    {{ $contacts->links() }}

@endsection