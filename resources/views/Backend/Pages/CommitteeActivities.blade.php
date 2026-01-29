@extends('Backend.Layout.MasterLayout')

@section('Content')

    <div class="container mt-4">
        <div class="row align-items-center g-2">
            <!-- Search -->
            <div class="col-12 col-md-8 col-lg-5">
                <form action="{{ route('committeeActivities.index') }}" method="GET">
                    <div class="input-group">
                        <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                        <input type="text" name="title" class="form-control" placeholder="কার্যক্রমের নাম দিয়ে সার্চ করুন…" value="{{ request('title') }}">
                        <button class="btn btn-outline-success" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i> অনুসন্ধান
                        </button>
                    </div>
                </form>
            </div>

            <!-- Create Button -->
            <div class="col-12 col-md-4 col-lg-2 ms-md-auto text-md-end">
                <button class="btn btn-success w-100 w-md-auto" data-bs-toggle="modal"
                    data-bs-target="#createCommitteeModal">
                    <i class="fa-solid fa-plus me-1"></i> নতুন কার্যক্রম
                </button>
            </div>

        </div>
    </div>

    <div class="card table-card shadow-sm my-3">
        <div class="card-header text-white text-center">
            <i class="fa fa-calendar-check"></i>
            @if(request('date') || request('title'))
                সার্চ কৃত তথ্যঃ
                @if(request('date')) {{ request('date') }} @endif
                @if(request('date') && request('title')) ও @endif
                @if(request('title')) {{ request('title') }} @endif
            @else
                কমিটির কার্যক্রমের তালিকা
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if($activities_data->isEmpty())
                    <div class="alert alert-danger text-center fw-semibold">
                        বর্তমানে কোনো কার্যক্রম উপলভ্য নেই।
                    </div>
                    <div class="text-center my-3">
                        <a href="{{ route('committeeActivities.index') }}" class="btn btn-success">সকল কার্যক্রম</a>
                    </div>
                @else
                    <table class="table align-middle">
                        <thead>
                            <tr class="text-center">
                                <th>ক্রমিক</th>
                                <th>কার্যক্রমের নাম</th>
                                <th>বিবরণ</th>
                                <th>তারিখ</th>
                                <th>অ্যাকশন</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activities_data as $activities)
                                <tr class="text-center">
                                    <td data-label="ক্রমিক">@bn( $loop->iteration + ($activities_data->currentPage()-1)*$activities_data->perPage() )</td>
                                    <td data-label="কার্যক্রমের নাম">{{$activities->title}}</td>
                                    <td data-label="বিবরণ">{{$activities->description}}</td>
                                    <td data-label="তারিখ">@bn($activities->activities_date)</td>
                                    <td data-label="অ্যাকশন">
                                        <div class="d-flex flex-row justify-content-center gap-2">
                                            <button class="btn action-btn-info" data-bs-toggle="modal" data-bs-target="#viewCommitteeModal{{$activities->id}}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn action-btn-success" data-bs-toggle="modal" data-bs-target="#editCommitteeModal{{$activities->id}}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn action-btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCommitteeModal{{$activities->id}}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- View Modal -->
                                <div class="modal fade" id="viewCommitteeModal{{$activities->id}}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info text-white">
                                                <h6 class="modal-title">কার্যক্রমের বিস্তারিত</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">

                                                <!-- বিস্তারিত -->
                                                <p><strong>কার্যক্রমের নাম:</strong>{{$activities->title}}</p>
                                                <p><strong>বিবরণ:</strong> {{$activities->description}}</p>
                                                <p><strong>তারিখ:</strong> @bn($activities->activities_date)</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">বন্ধ করুন</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editCommitteeModal{{$activities->id}}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-success text-white">
                                                <h6 class="modal-title">কার্যক্রম সম্পাদনা</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <form action="{{ route('committeeActivities.update', $activities->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="row g-3">



                                                        <div class="col-12">
                                                            <label class="form-label">কার্যক্রমের নাম</label>
                                                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                                                value="{{ old('title', $activities->title) }}">
                                                            @error('title')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="col-12">
                                                            <label class="form-label">বিবরণ</label>
                                                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                                                rows="3">{{ old('description', $activities->description) }}</textarea>
                                                            @error('description')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="col-12">
                                                            <label class="form-label">তারিখ</label>
                                                            <input name="activities_date" type="date"
                                                                class="form-control @error('activities_date') is-invalid @enderror"
                                                                value="{{ old('activities_date', $activities->activities_date) }}">
                                                            @error('activities_date')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" data-bs-dismiss="modal">বাতিল</button>
                                                    <button type="submit" name="submit" class="btn btn-success">আপডেট করুন</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteCommitteeModal{{$activities->id}}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h6 class="modal-title">কার্যক্রম মুছুন</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <p>আপনি কি নিশ্চিত যে আপনি এই কার্যক্রমটি মুছে ফেলতে চান?</p>
                                                <p class="text-danger">এই কাজটি পূর্বাবস্থায় ফেরানো যাবে না।</p>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">বাতিল</button>
                                                <!-- Delete Form -->
                                                <form action="{{ route('committeeActivities.destroy', $activities->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">মুছে ফেলুন</button>
                                                </form>
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

    {{ $activities_data->links() }}

    <!-- Create Modal -->
    <div class="modal fade" id="createCommitteeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">নতুন কার্যক্রম যোগ করুন</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('committeeActivities.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div>
                                @if(Auth::user()->account_type=='superadmin' || Auth::user()->account_type=='cashier')
                                <label for="status">কমিটি লিস্ট</label>
                                <select name="committee_year_id" id="status" class="form-control">
                                    <option value="">কমিটি সিলেক্ট করুন</option>
                                        @foreach($committeeYears as $committeeYear)
                                            <option value="{{ $committeeYear->id }}">{{ $committeeYear->committee_name }}</option>
                                        @endforeach
                                </select>
                                @else
                                    @error('committee_year_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <input name="committee_year_id" value="{{$committeeYearName->id}}" type="hidden">
                                @endif
                            </div>

                            <div class="col-12">
                                <label class="form-label">কার্যক্রমের নাম</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="কার্যক্রম এর নাম দিন" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">বিবরণ</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label class="form-label">তারিখ</label>
                                <input type="date" name="activities_date" class="form-control @error('activities_date') is-invalid @enderror" value="{{ old('activities_date') }}" required>
                                @error('activities_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">বাতিল</button>
                        <button type="submit" class="btn btn-success">সংরক্ষণ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection