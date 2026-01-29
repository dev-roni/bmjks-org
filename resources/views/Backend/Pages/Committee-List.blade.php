@extends('Backend.Layout.MasterLayout')

@section('Content')

    <div class="row g-3">
        <div class="col-sm-6 col-lg-3">
            <div class="card stat-card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-dark">
                                মোট সক্রিয় কমিটি
                            </small>
                            <h4 class="mb-0">

                                    @bn($totalActiveCommittees)

                            </h4>
                        </div>

                        <div class="display-6 social-color"><i class="fa-solid fa-sitemap"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card stat-card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-dark">মোট সক্রিয় কমিটি সদস্য</small>
                            <h4 class="mb-0">@bn($totalActiveMembers)</h4>
                        </div>
                        <div class="display-6 social-color"><i class="fa-solid fa-users"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card stat-card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-dark">মোট নিষ্ক্রিয় কমিটি</small>
                            <h4 class="mb-0">@bn($totalDeactiveCommittees)</h4>
                        </div>
                        <div class="display-6 social-color"><i class="fa-solid fa-sitemap"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card stat-card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-dark">মোট নিষ্ক্রিয় কমিটি সদস্য</small>
                            <h4 class="mb-0">@bn($totalDeactiveMembers)</h4>
                        </div>
                        <div class="display-6 social-color"><i class="fa-solid fa-users"></i></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Page Action Buttons -->
    <div class="page-action-buttons mt-3">
        <div class="row g-2 d-flex justify-content-center align-items-center">

            <!-- Active/Inactive Buttons -->
            <div class="col-12 col-lg-3">
                <div class="btn-group w-100">
                    <a class="btn btn-outline-success {{ Route::is('active.committee.list') ? 'active' : '' }}" href="{{ route('active.committee.list') }}">
                        সক্রিয়
                    </a>

                    <a class="btn deactive-button {{ Route::is('deactive.committee.list') ? 'active' : '' }}" href="{{ route('deactive.committee.list') }}">
                        নিষ্ক্রিয়
                    </a>
                </div>
            </div>

        </div>
    </div>

    <div class="row g-3 mt-1">
        <div class="col-lg-12">
            <div class="card table-card shadow-sm">
                <div class="card-header text-white text-center">
                    <i class="fa-solid fa-sitemap"></i>
                    {{ Route::is('active.committee.list') ? 'সক্রিয় কমিটি তালিকা' : 'নিষ্ক্রিয় কমিটি তালিকা' }}
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr class="text-center">
                                <th>ক্রমিক</th>
                                <th>কমিটি নাম</th>
                                <th>সদস্য সংখ্যা</th>
                                <th>অবস্থা</th>
                                <th>অ্যাকশন</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($committees as $committee)
                                <tr class="text-center">
                                    <td data-label="ক্রমিক">@bn($loop->iteration)</td>
                                    <td data-label="শাখা নাম">
                                        <div class="d-flex align-items-center justify-content-center gap-2">
                                            <i class="fa-solid fa-sitemap text-primary"></i>
                                            <strong>{{ $committee->committee_name }}</strong>
                                        </div>
                                    </td>
                                    <td data-label="সদস্য সংখ্যা">@bn($committee->committee_members_count)</td>
                                    <td data-label="অবস্থা"><span class="{{ $committee->status == 'active' ? 'type' : 'type-deactive' }} badge">{{ $committee->status == 'active' ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}</span></td>
                                    <td data-label="অ্যাকশন">
                                        <div class="btn-group">
                                            <a href="{{ route('active.committee', $committee->id) }}" class="btn btn-outline-success" title="View">
                                                <i class="fa-solid fa-hand-point-right"></i> দেখুন
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Branch -->
    <div class="modal fade" id="modalBranch" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">নতুন শাখা যোগ করুন</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form data-fake>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">শাখার নাম</label>
                                <input class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল</button>
                        <button type="submit" class="btn btn-success">সংরক্ষণ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: Committee -->
    <div class="modal fade" id="newCommitteeModal" tabindex="-1" aria-labelledby="newCommitteeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newCommitteeModalLabel">নতুন কমিটি তৈরি করুন</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="newCommitteeForm">
                        <div class="mb-3">
                            <label for="branchName" class="form-label">শাখা নির্বাচন</label>
                            <select class="form-select" id="branchName" name="branchName" required>
                                <option selected disabled value="">শাখা নির্বাচন করুন</option>
                                <option value="branch1">শাখা ১</option>
                                <option value="branch2">শাখা ২</option>
                                <option value="branch3">শাখা ৩</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="effectiveDate" class="form-label">কমিটি কার্যকর তারিখ</label>
                            <input type="date" class="form-control" id="effectiveDate" name="effectiveDate" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বন্ধ করুন</button>
                    <button type="submit" form="newCommitteeForm" class="btn btn-success">সংরক্ষণ করুন</button>
                </div>
            </div>
        </div>
    </div>

@endsection