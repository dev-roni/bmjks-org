@extends('Backend.Layout.MasterLayout')

@section('Content')

    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-md-8">
                <h2 class="text-success">
                    {{ Route::is('lifetime.member.padding.list') ? "আবেদনকৃত আজীবন সদস্য তালিকা" : 
                      (Route::is('general.member.padding.list') ? "আবেদনকৃত সাধারণ সদস্য তালিকা" : "ব্যক্তির তথ্য তালিকা") }}
                </h2>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header bg-success text-white py-3 d-flex justify-content-between">
                <h5 class="card-title mb-0">{{ $personTypeName ?? 'ক্যাটাগরি' }} তালিকা</h5>
                <p class="mb-0">মোট @bn($persons->total()) জন </p>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-success">
                            <tr class="text-center">
                                <th scope="col">ক্রমিক</th>
                                <th scope="col">নাম</th>
                                <th scope="col">মোবাইল</th>
                                <th scope="col">গ্রাম</th>
                                <th scope="col" class="text-center">একশন</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($persons as $person)
                                <tr class="text-center">
                                    <td data-label="ক্রমিক">@bn($loop->iteration + ($persons->currentPage() - 1) * $persons->perPage())</td>
                                    <td data-label="নাম">{{ $person->name }}</td>
                                    <td data-label="মোবাইল নং">{{ $person->mobile_number }}</td>
                                    <td data-label="গ্রাম">{{ $person->village }}</td>
                                    <td data-label="অ্যাকশন">
                                        <div class="d-flex flex-row justify-content-center gap-2">

                                            <!-- View Button -->
                                            <button type="button" class="action-btn-info" title="বিস্তারিত দেখুন"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalViewMember{{ $person->id }}"
                                                data-id="{{ $person->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                            <!-- Edit Button -->
                                            @php
                                                $hasRestrictedType = $person->personType->pluck('id')->contains(1);
                                            @endphp

                                            @if(($hasRestrictedType && Auth::user()->account_type == 'superadmin') ||(!$hasRestrictedType))
                                            <button type="button" class="action-btn-success" title="সম্পাদনা করুন"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEditMember{{ $person->id }}"
                                                data-id="{{ $person->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            @endif


                                            <!-- Member Approve Button -->
                                            @if($person->member_aproved == 'no')
                                            <button type="button" 
                                                class="action-btn-success" 
                                                title="সদস্য অনুমোদন করুন"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#approveMemberModal{{ $person->id }}">
                                                <i class="fas fa-user-check"></i>
                                            </button>
                                            @endif

                                            <!-- Delete Button -->
                                             @if((!$person->personType->contains('id', 1)) || ($person->personType->contains('id', 1) and $person->member_aproved == 'no'))
                                            <button type="button" class="action-btn-danger" title="মুছে ফেলুন"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteMemberModal{{ $person->id }}"
                                                data-id="{{ $person->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>


                                <!-- Member Approve Modal -->
                                <div class="modal fade" id="approveMemberModal{{ $person->id }}" tabindex="-1" aria-labelledby="approveMemberLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title" id="approveMemberLabel">সদস্য অনুমোদন</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ 
                                                    Route::is('lifetime.member.padding.list') ? route('lifetime.member.approve', $person->id) : 
                                                    (Route::is('general.member.padding.list') ? route('general.member.approve', $person->id) : '') 
                                                    }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                        <p>আপনি কি নিশ্চিত যে <strong>{{ $person->name }}</strong> কে সদস্য হিসেবে অনুমোদন দিতে চান?</p>
                                        <input type="hidden" name="member_aproved" value="yes">
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল</button>
                                        <button type="submit" class="btn btn-success">অনুমোদন দিন</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                                </div>

                                <!-- View Member Modal -->
                                <div class="modal fade" id="modalViewMember{{ $person->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">

                                            <!-- Header -->
                                            <div class="modal-header bg-info text-white">
                                                <h5 class="modal-title">সদস্যের বিস্তারিত তথ্য</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <div class="row g-3">

                                                    <!-- Profile Image & Name -->
                                                    <div class="col-12 text-center">
                                                        <img src="{{ $person->photo ? asset('uploads/person/'.$person->photo) : asset('Frontend-Assets/images/profile_img.png') }}"
                                                            class="rounded-circle border border-3 border-info shadow-sm object-fit-cover"
                                                            width="120" height="120" alt="Profile">
                                                        <h4 class="mt-3 mb-0">{{ $person->name }}</h4>
                                                    </div>

                                                    <hr class="mt-2">

                                                    <!-- Personal Information -->
                                                    <div class="col-md-6">
                                                        <p><strong>{{ $person->relation_type }}:</strong> {{ $person->father_husband_name ?? 'N/A' }}</p>
                                                        <p><strong>মাতার নাম:</strong> {{ $person->mother_name ?? 'N/A' }}</p>
                                                        <p><strong>জন্ম তারিখ:</strong> {{ $person->date_of_birth ?? 'N/A' }}</p>
                                                        <p><strong>লিঙ্গ:</strong> {{ $person->gender ?? 'N/A' }}</p>
                                                        <p><strong>বৈবাহিক অবস্থা:</strong> {{ $person->marital_status ?? 'N/A' }}</p>
                                                        <p><strong>রক্তের গ্রুপ:</strong> {{ $person->blood_group ?? 'N/A' }}</p>
                                                    </div>

                                                    <!-- Contact & Address -->
                                                    <div class="col-md-6">
                                                        <p><strong>মোবাইল:</strong> {{ $person->mobile_number ?? 'N/A' }}</p>
                                                        <p><strong>পেশা:</strong> {{ $person->profession ?? 'N/A' }}</p>
                                                        <p><strong>গ্রাম:</strong> {{ $person->village ?? 'N/A' }}</p>
                                                        <p><strong>ডাকঘর:</strong> {{ $person->post_office ?? 'N/A' }}</p>
                                                        <p><strong>থানা:</strong> {{ $person->thana ?? 'N/A' }}</p>
                                                        <p><strong>জেলা:</strong> {{ $person->district ?? 'N/A' }}</p>
                                                    </div>
                                                    <div class="col-md-12">
                                                        @if($person->personType && $person->personType->count() > 0)
                                                            @foreach($person->personType as $type)
                                                                <span class="badge bg-success">{{ $type->person_type_name }}</span>
                                                            @endforeach
                                                        @else
                                                            <span class="text-muted">কোনো টাইপ নেই</span>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>

                                            <!-- Footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বন্ধ করুন</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Person Modal -->
                                <div class="modal fade" id="modalEditMember{{ $person->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-success text-white">
                                                <h6 class="modal-title">ব্যক্তির তথ্য সম্পাদনা</h6>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>

                                            <form action="{{ route('person.update', $person->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="row g-3">

                                                         <!-- ছবি প্রিভিউ -->
                                                        <div class="col-12 text-center">
                                                            <img id="photoPreview{{ $person->id }}" 
                                                                src="{{ $person->photo ? asset('uploads/person/' . $person->photo) : asset('Frontend-Assets/images/profile_img.png') }}" 
                                                                class="img-fluid rounded-circle shadow-sm" 
                                                                width="100" height="100" >
                                                        </div>

                                                        <!-- নাম -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">নাম</label>
                                                            <input type="text" name="name" class="form-control" value="{{ $person->name }}">
                                                        </div>

                                                        <!-- পিতার/স্বামীর নাম -->
                                                        <div class="col-md-6">
                                                            <div class="d-flex align-items-center gap-3">
                                                                <div class="d-flex align-items-center">
                                                                    <input class="relation-checkbox" type="radio" name="relation_type" id="fatherOption" value="পিতা"
                                                                        {{ ($person->relation_type ?? '') == 'পিতা' ? 'checked' : '' }}>
                                                                    <label for="fatherOption" class="relation-label">পিতা</label>
                                                                </div>

                                                                <div class="d-flex align-items-center">
                                                                    <input class="relation-checkbox" type="radio" name="relation_type" id="husbandOption" value="স্বামী"
                                                                        {{ ($person->relation_type ?? '') == 'স্বামী' ? 'checked' : '' }}>
                                                                    <label for="husbandOption" class="relation-label">স্বামী</label>
                                                                </div>
                                                            </div>

                                                            <input type="text" name="father_husband_name" class="form-control mt-2" id="relationName" placeholder="{{ ($person->relation_type ?? '') == 'স্বামী' ? 'স্বামীর নাম লিখুন' : 'পিতার নাম লিখুন' }}" value="{{ $person->father_husband_name ?? '' }}">
                                                        </div>

                                                        <!-- মাতার নাম -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">মাতার নাম</label>
                                                            <input type="text" name="mother_name" class="form-control" value="{{ $person->mother_name }}">
                                                        </div>

                                                        <!-- জন্ম তারিখ -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">জন্ম তারিখ</label>
                                                            <input type="date" name="date_of_birth" class="form-control" value="{{ $person->date_of_birth }}">
                                                        </div>

                                                        <!-- লিঙ্গ -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">লিঙ্গ</label>
                                                            <select name="gender" class="form-select">
                                                                <option value="male" {{ $person->gender == 'male' ? 'selected' : '' }}>পুরুষ</option>
                                                                <option value="female" {{ $person->gender == 'female' ? 'selected' : '' }}>মহিলা</option>
                                                                <option value="other" {{ $person->gender == 'other' ? 'selected' : '' }}>অন্যান্য</option>
                                                            </select>
                                                        </div>

                                                        <!-- জাত -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">গোত্র</label>
                                                            <select name="caste" class="form-select">
                                                                <option value="আঙগ্রিশ্য" {{ $person->caste == 'আঙগ্রিশ্য' ? 'selected' : '' }}>আঙগ্রিশ্য</option>
                                                                <option value="মদুকল্য" {{ $person->caste == 'মদুকল্য' ? 'selected' : '' }}>মদুকল্য</option>
                                                                <option value="বিয়াগ্র" {{ $person->caste == 'বিয়াগ্র' ? 'selected' : '' }}>বিয়াগ্র</option>
                                                            </select>
                                                        </div>

                                                        <!-- বৈবাহিক অবস্থা -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">বৈবাহিক অবস্থা</label>
                                                            <select name="marital_status" class="form-select">
                                                                <option value="single" {{ $person->marital_status == 'single' ? 'selected' : '' }}>অবিবাহিত</option>
                                                                <option value="married" {{ $person->marital_status == 'married' ? 'selected' : '' }}>বিবাহিত</option>
                                                                <option value="widowed" {{ $person->marital_status == 'widowed' ? 'selected' : '' }}>বিপত্নীক/বিধবা</option>
                                                            </select>
                                                        </div>

                                                        <!-- মোবাইল -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">মোবাইল নম্বর</label>
                                                            <input type="text" name="mobile_number" class="form-control" value="{{ $person->mobile_number }}">
                                                        </div>

                                                        <!-- পেশা -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">পেশা</label>
                                                            <input type="text" name="profession" class="form-control" value="{{ $person->profession }}">
                                                        </div>

                                                        <!-- ব্লাড গ্রুপ -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">রক্তের গ্রুপ</label>
                                                            <select name="blood_group" class="form-select">
                                                                <option value="A+" {{ $person->blood_group == 'A+' ? 'selected' : '' }}>A+</option>
                                                                <option value="A-" {{ $person->blood_group == 'A-' ? 'selected' : '' }}>A-</option>
                                                                <option value="B+" {{ $person->blood_group == 'B+' ? 'selected' : '' }}>B+</option>
                                                                <option value="B-" {{ $person->blood_group == 'B-' ? 'selected' : '' }}>B-</option>
                                                                <option value="O+" {{ $person->blood_group == 'O+' ? 'selected' : '' }}>O+</option>
                                                                <option value="O-" {{ $person->blood_group == 'O-' ? 'selected' : '' }}>O-</option>
                                                                <option value="AB+" {{ $person->blood_group == 'AB+' ? 'selected' : '' }}>AB+</option>
                                                                <option value="AB-" {{ $person->blood_group == 'AB-' ? 'selected' : '' }}>AB-</option>
                                                            </select>
                                                        </div>

                                                        <!-- গ্রাম -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">গ্রাম</label>
                                                            <input type="text" name="village" class="form-control" value="{{ $person->village }}">
                                                        </div>

                                                        <!-- পোস্ট অফিস -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">পোস্ট অফিস</label>
                                                            <input type="text" name="post_office" class="form-control" value="{{ $person->post_office }}">
                                                        </div>

                                                        <!-- থানা -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">থানা</label>
                                                            <input type="text" name="thana" class="form-control" value="{{ $person->thana }}">
                                                        </div>

                                                        <!-- জেলা -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">জেলা</label>
                                                            <input type="text" name="district" class="form-control" value="{{ $person->district }}">
                                                        </div>

                                                        <!-- ছবি -->
                                                        <div class="col-12">
                                                            <label class="form-label">ছবি</label>
                                                            <input type="file" name="photo" class="form-control" accept="image/*" onchange="previewPersonImage{{ $person->id }}(event)">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="form-label d-block mb-2">সদস্যের ক্যাটাগরি</label>

                                                            @if($person->personType && $person->personType->count() > 0)
                                                                @php
                                                                    // Person এর সব টাইপ আইডিগুলোকে একটি array তে নিচ্ছি
                                                                    $selectedTypes = $person->personType->pluck('id')->toArray();
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $selectedTypes = [];
                                                                @endphp
                                                            @endif

                                                            @foreach($tags->where('id', '!=', 1) as $tag)
                                                                <div class="form-check form-check-inline">
                                                                    <input 
                                                                        class="form-check-input" 
                                                                        type="checkbox" 
                                                                        name="person_tag[]" 
                                                                        value="{{ $tag->id }}" 
                                                                        id="tag{{ $tag->id }}"
                                                                        {{ in_array($tag->id, $selectedTypes) ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="tag{{ $tag->id }}">
                                                                        {{ $tag->person_type_name }}
                                                                    </label>
                                                                </div>
                                                            @endforeach

                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">বাতিল</button>
                                                    <button type="submit" class="btn btn-success">আপডেট করুন</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <!-- Member Delete Modal -->
                                <div class="modal fade" id="deleteMemberModal{{ $person->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h6 class="modal-title">সদস্য মুছে ফেলুন</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('person.destroy', $person->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" id="{{ $person->id }}">
                                                <div class="modal-body text-center">
                                                    <p>আপনি কি নিশ্চিত যে আপনি এই সদস্যকে মুছে ফেলতে চান?</p>
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

                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">কোনো সদস্য পাওয়া যায়নি</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        মোট @bn($persons->total()) টি রেকর্ডের মধ্যে 
                        @bn($persons->firstItem()) - @bn($persons->lastItem()) দেখানো হচ্ছে
                    </div>
                    <div>
                        {{ $persons->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
