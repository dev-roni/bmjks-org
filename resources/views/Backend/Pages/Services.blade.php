@extends('Backend.Layout.MasterLayout')

@section('Content')

    <!-- Page Action Button -->
    <div class="page-action-buttons">
        <div class="text-end">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                <i class="fa-solid fa-plus me-1"></i> নতুন সেবা
            </button>
        </div>
    </div>

    <div class="card table-card shadow-sm mt-3">
        <div class="card-header text-white text-center">
            <i class="fa-solid fa-hand-holding-heart"></i> সেবাসমূহের তালিকা
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if($services->isEmpty())
                    <div class="alert alert-danger text-center fw-semibold">
                        এই সেবা টেবিলে কোনো তথ্য নেই।
                    </div>
                @else
                    <table class="table align-middle">
                        <thead>
                            <tr class="text-center">
                                <th>ক্রমিক নং</th>
                                <th>আইকন</th>
                                <th>সেবার নাম</th>
                                <th>বিবরণ</th>
                                <th>অ্যাকশন</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $service)
                            <tr class="text-center">
                                <td data-label="ক্রমিক">@bn($loop->iteration)</td>
                                <td data-label="আইকন"><i class="{{ $service->icon }}"></i></td>
                                <td data-label="সেবার নাম">{{ Str::limit($service->title, 20, '...') }}</td>
                                <td data-label="বিবরণ">{{ Str::limit($service->description, 30, '...') }}</td>
                                <td data-label="অ্যাকশন">
                                    <div class="d-flex flex-row justify-content-center gap-2">
                                        <button class="action-btn-success edit-service-btn" data-bs-toggle="modal"
                                            data-bs-target="#editServiceModal{{$service->id}}" title="সেবা সম্পাদনা"
                                            data-id="{{ $service->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn action-btn-danger delete-service-btn" title="সেবা মুছুন"
                                            data-bs-toggle="modal" data-bs-target="#deleteServiceModal{{$service->id}}"
                                            data-id="{{ $service->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Edit Service Modal -->
                            <div class="modal fade" id="editServiceModal{{$service->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success text-white">
                                            <h6 class="modal-title">সেবা সম্পাদনা করুন</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('service.update', $service->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" id="editServiceId">
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <div class="col-12 text-center">
                                                        <label class="form-label d-block">বর্তমান আইকন</label>
                                                        <div class="rounded-circle border bg-light d-inline-flex align-items-center justify-content-center" style="width: 64px; height: 64px;"><i class="{{ $service->icon }} fa-2x"></i></div>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label">আইকন</label>
                                                        <input type="text" class="form-control" name="icon" value="{{ $service->icon }}" placeholder="FontAwesome ক্লাস, যেমন: fa-solid fa-stethoscope">
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label">সেবার নাম</label>
                                                        <input type="text" class="form-control" name="title" value="{{ $service->title }}">
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label">সেবার বিবরণ</label>
                                                        <textarea class="form-control" name="description" rows="3">{{ $service->description }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">বাতিল</button>
                                                <button type="submit" name="submit" class="btn btn-success">আপডেট করুন</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Service Modal -->
                            <div class="modal fade" id="deleteServiceModal{{$service->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h6 class="modal-title">সেবা মুছুন</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('service.destroy', $service->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" id="{{$service->id}}">
                                            <div class="modal-body text-center">
                                                <p>আপনি কি নিশ্চিত যে আপনি এই সেবাটি স্থায়ীভাবে মুছে ফেলতে চান?</p>
                                                <p class="text-danger">এই কাজটি পূর্বাবস্থায় ফেরানো যাবে না।</p>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল</button>
                                                <button type="submit" name="submit" class="btn btn-danger">মুছে ফেলুন</button>
                                            </div>
                                        </form>
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

    <!-- Add Service Modal -->
    <div class="modal fade" id="addServiceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">নতুন সেবা যোগ করুন</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('service.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label @error('icon') text-danger @enderror">
                                    @error('icon')
                                        {{ $message }}
                                    @else
                                        আইকন
                                    @enderror
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-icons"></i></span>
                                    <input type="text" name="icon" class="form-control"
                                        placeholder="FontAwesome ক্লাস, যেমন: fa-solid fa-stethoscope">
                                </div>
                                <small class="text-muted">উদাহরণ: fa-solid fa-stethoscope, fa-solid
                                    fa-graduation-cap</small>
                            </div>
                            <div class="col-12">
                                <label class="form-label @error('title') text-danger @enderror">
                                    @error('title')
                                        {{ $message }}
                                    @else
                                        সেবার নাম
                                    @enderror
                                </label>
                                <input type="text" name="title" class="form-control" placeholder="যেমন: চিকিৎসা পরামর্শ সেবা">
                            </div>
                            <div class="col-12">
                                <label class="form-label @error('description') text-danger @enderror">
                                    @error('description')
                                        {{ $message }}
                                    @else
                                        সেবার বিবরণ
                                    @enderror
                                </label>
                                <textarea class="form-control" name="description" rows="3" placeholder="সেবাটির সংক্ষিপ্ত বিবরণ লিখুন, যেমন— আমাদের বিশেষজ্ঞ ডাক্তারদের মাধ্যমে অনলাইনে চিকিৎসা পরামর্শ প্রদান করা হয়।"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">বাতিল</button>
                        <button type="submit" name="submit" class="btn btn-success">সংরক্ষণ করুন</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection