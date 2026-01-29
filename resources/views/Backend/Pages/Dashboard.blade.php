@extends('Backend.Layout.MasterLayout')

@section('Content')

    <div class="row g-3">
        
        <!-- আজীবন সদস্য -->
        <div class="col-sm-6 col-lg-3">
            <div class="card stat-card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-dark">আজীবন সদস্য</small>
                            <h4 class="mb-0">@member_count(1)</h4>
                        </div>
                        <div class="display-6 social-color"><i class="fa-solid fa-bullhorn"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- কমিটি -->
        <div class="col-sm-6 col-lg-3">
            <div class="card stat-card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-dark">সাধারণ সদস্য</small>
                            <h4 class="mb-0">@member_count(2)</h4>
                        </div>
                        <div class="display-6 social-color"><i class="fa-solid fa-users-gear"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- সদস্য -->
        @if(Auth::user()->account_type!='cashier')
        <div class="col-sm-6 col-lg-3">
            <div class="card stat-card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-dark">সক্রিয় কমিটি সদস্য</small>
                            <h4 class="mb-0">@bn($total_active_member)</h4>
                        </div>
                        <div class="display-6 social-color"><i class="fa-solid fa-user-group"></i></div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- আজকের ভিজিট -->
        <div class="col-sm-6 col-lg-3">
            <div class="card stat-card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-dark">ওয়েবসাইট ভিজিট</small>
                            <h4 class="mb-0">@bn($view_count)</h4>
                        </div>
                        <div class="display-6 social-color"><i class="fa-solid fa-chart-line"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- স্ট্যাট কার্ডস শেষ -->

    @if(Auth::user()->account_type!='cashier')
    <div class="row g-3 mt-1">
        <div class="col-lg-12">
            <div class="card table-card shadow-sm">
                <div class="card-header text-white">
                    <h5 class="mb-0 text-center">
                        <i class="fa-solid fa-sitemap"></i>
                        সক্রিয় কমিটি তালিকা
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr class="text-center">
                                <th>কমিটি নাম</th>
                                <th>সদস্য সংখ্যা</th>
                                <th>অবস্থা</th>
                                <th>অ্যাকশন</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($committees->isEmpty())
                                <tr>
                                    <td colspan="5">
                                        <div class="align-items-center py-2 text-center">
                                            <strong>এই সক্রিয় কমিটি তালিকা টেবিলে কোনো তথ্য নেই।</strong>
                                        </div>
                                    </td>
                                </tr>
                            @endif

                            @foreach($committees as $committee)
                            <tr class="text-center">
                                <td data-label="শাখা নাম">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fa-solid fa-sitemap text-primary"></i>
                                        <strong>{{ $committee->committee_name }}</strong>
                                    </div>
                                </td>
                                <td data-label="সদস্য সংখ্যা">@bn($committee->committee_members_count)</td>
                                <td data-label="অবস্থা"><span class="badge type">সক্রিয়</span></td>
                                <td data-label="অ্যাকশন">
                                    <div class="btn-group">
                                        <a href="{{ route('active.committee',$committee->id) }}" class="btn btn-outline-success" title="View">
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
    @endif


    {{-- পূর্বে তৈরি ট্যাগগুলোর তালিকা --}}
    <div class="card shadow-sm mx-auto mt-4" style="max-width: 70rem;">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0 mx-auto">
                <i class="fas fa-database"></i>
                বাসযুক ডেটাবেজ বিন্যাস
            </h5>
            <span class="badge bg-light text-dark">মোট:@bn($tags->count())</span>
        </div>

        <div class="card-body">
            @if($tags->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-success text-center">
                            <tr>
                                <th scope="col" style="width: 70px;">ক্রমিক</th>
                                <th scope="col">ক্যাটাগরির নাম</th>
                                <th scope="col" style="width: 120px;">লোকজন</th>
                                <th scope="col" style="width: 150px;">দেখুন</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($tags->isEmpty())
                                <tr>
                                    <td colspan="5">
                                        <div class="align-items-center py-2 text-center">
                                            <strong>এই বাসযুক ডেটাবেজ বিন্যাস টেবিলে কোনো তথ্য নেই।</strong>
                                        </div>
                                    </td>
                                </tr>
                            @endif

                            @foreach($tags as $tag)
                                <tr>
                                    <td class="text-center fw-bold" data-label="ক্রমিক নং">@bn($loop->iteration)</td>
                                    <td data-label="ক্যাটাগরি নাম" class="text-center">{{ $tag->person_type_name }}</td>
                                    <td class="text-center" data-label="লোকজন">
                                        <span class="badge bg-success" >@bn($tag->people->count() ?? 0)</span>
                                    </td>
                                    <td class="text-center" data-label="দেখুন">
                                        <div class="d-flex flex-row justify-content-center gap-2">
                                            <a href="{{route('specific.category.person', $tag->id)}}" 
                                            class="btn btn-sm action-btn-info" 
                                            title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info mb-0 text-center">
                    <i class="fas fa-info-circle"></i> কোনো ট্যাগ এখনো যোগ করা হয়নি।
                </div>
            @endif
        </div>
    </div>


    <!-- সাম্প্রতিক নোটিশ টেবিল শুরু -->
    <div class="row g-3 mt-1">
        <div class="col-lg-12">
            <div class="card table-card shadow-sm">
                <div class="card-header text-white">
                    <h5 class="mb-0 text-center">
                        <i class="fa-solid fa-bullhorn"></i> 
                        সাম্প্রতিক নোটিশ
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr class="text-center">
                                <th>ক্রমিক</th>
                                <th>শিরোনাম</th>
                                <th>ইস্যু তারিখ</th>
                                <th>দেখুন</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($notices->isEmpty())
                                <tr>
                                    <td colspan="5">
                                        <div class="align-items-center py-2 text-center">
                                            <strong>এই সাম্প্রতিক নোটিশ টেবিলে কোনো তথ্য নেই।</strong>
                                        </div>
                                    </td>
                                </tr>
                            @endif

                            @foreach($notices as $notice)
                            <tr class="text-center">
                                <td data-label="ক্রমিক">@bn($loop->iteration)</td>
                                <td data-label="শিরোনাম">{{ $notice->title }}</td>
                                <td data-label="তারিখ">@bn($notice->date)</td>
                                <td data-label="অ্যাকশন">
                                    <div class="d-flex flex-row justify-content-center gap-2">
                                        <button type="button" class="action-btn-info"
                                            title="view" data-bs-toggle="modal" 
                                            data-bs-target="#noticeViewModal{{ $notice->id }}" data-id="{{ $notice->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- নোটিশ ভিউ মডাল শুরু -->
                            <div class="modal fade" id="noticeViewModal{{ $notice->id }}" tabindex="-1" aria-labelledby="noticeViewModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info text-white">
                                            <h5 class="modal-title" id="noticeViewModalLabel">নোটিশের বিস্তারিত</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="notice-details">
                                                <h4 id="noticeTitle">{{ $notice->title }}</h4>
                                                <p class="text-muted">
                                                    <span>তারিখ: {{ $notice->date }}</span>
                                                </p>
                                                <hr>
                                                <div id="noticeContent">
                                                    <p>
                                                        {{ $notice->description }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বন্ধ করুন</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- নোটিশ ভিউ মডাল শেষ -->
                            @endforeach

                        </tbody>
                    </table>
                    @if(Auth::user()->account_type=='superadmin')
                    <div class="bg-white text-center m-4">
                        <a href="{{ route('notice.index') }}" class="btn btn-success btn-sm px-4">
                        সব নোটিশ
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- সাম্প্রতিক নোটিশ টেবিল শেষ -->

@endsection