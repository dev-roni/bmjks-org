@extends('frontend.layouts.master_layout')

@section('content')

  <div class="container member-table-wrapper py-4">
      <section class="page-header">
          <div class="container">
              <div class="row">
                  <div class="col-12 text-center">
                      <h1 class="fw-bold text-dark">আজীবন সদস্য তালিকা</h1>
                      <div class="border-bottom border-white border-3 mx-auto" style="width: 100px; background-color:#1A9B9F;"></div>
                      <p class="mt-2 lead text-dark">বামজুকসের সকল আজীবন সদস্যদের তালিকা ও তথ্য</p>
                  </div>
              </div>
          </div>
      </section>

      @if($persons->isEmpty())
        <div class="alert alert-success text-center fw-semibold">
          দুঃখিত, বর্তমানে কোনো সদস্যের তথ্য প্রদর্শনের জন্য নেই।
        </div>
      @else
          <div class="card">
              <div class="card-header py-3 d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">{{ $personTypeName ?? 'ক্যাটাগরি' }} তালিকা</h5>
                  <span>মোট @bn($persons->total()) জন</span>
              </div>

              <div class="card-body p-0">
                  <div class="table">
                      <table class="table table-bordered table-hover mb-0">
                          <thead>
                              <tr>
                                  <th>ক্রমিক</th>
                                  <th>নাম</th>
                                  <th>পিতার/স্বামীর নাম</th>
                                  <th>গ্রাম</th>
                                  <th>একশন</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($persons as $person)
                                  <tr>
                                      <td data-label="ক্রমিক">@bn($loop->iteration + ($persons->currentPage()-1)*$persons->perPage())</td>
                                      <td data-label="নাম">{{ $person->name }}</td>
                                      <td data-label="পিতার/স্বামীর নাম">{{ $person->father_husband_name }}</td>
                                      <td data-label="গ্রাম">{{ $person->village }}</td>
                                      <td data-label="একশন" class="text-center">
                                          <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewMemberModal{{ $person->id }}">
                                              <i class="fas fa-eye"></i>
                                          </button>
                                      </td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>

              <div class="mt-4">
                  <div class="text-center mb-2">
                      মোট @bn($persons->total()) টি রেকর্ডের মধ্যে
                      @bn($persons->firstItem()) - @bn($persons->lastItem()) দেখানো হচ্ছে
                  </div>
                  <div class="d-flex justify-content-center mb-3">
                      {{ $persons->links('pagination::bootstrap-5') }}
                  </div>
              </div>
          </div>
      @endif
  </div>

  {{-- =================== ALL MODALS =================== --}}
  @foreach($persons as $person)
    <div class="modal fade" id="viewMemberModal{{ $person->id }}" tabindex="-1" aria-labelledby="viewMemberModalLabel{{ $person->id }}" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="viewMemberModalLabel{{ $person->id }}">{{ $person->name }} - বিস্তারিত তথ্য</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-12 text-center">
                <img src="{{ $person->photo ? asset($person->photo) : asset('Frontend-Assets/images/profile_img.png') }}" class="rounded-circle border border-3 border-info shadow-sm" width="120" height="120" alt="Profile">
                <h4 class="mt-3 mb-0">{{ $person->name }}</h4>
              </div>
              <hr class="mt-3">
              <div class="col-md-6 text-center">
                <p><strong>{{ $person->relation_type }}:</strong> {{ $person->father_husband_name ?? 'তথ্য পাওয়া যায়নি' }}</p>
                <p><strong>মাতার নাম:</strong> {{ $person->mother_name ?? 'তথ্য পাওয়া যায়নি' }}</p>
                <p><strong>লিঙ্গ:</strong> {{ $person->gender ?? 'তথ্য পাওয়া যায়নি' }}</p>
                <p><strong>বৈবাহিক অবস্থা:</strong> {{ $person->marital_status ?? 'তথ্য পাওয়া যায়নি' }}</p>
                <p><strong>রক্তের গ্রুপ:</strong> {{ $person->blood_group ?? 'তথ্য পাওয়া যায়নি' }}</p>
              </div>
              <div class="col-md-6 text-center">
                <p><strong>পেশা:</strong> {{ $person->profession ?? 'তথ্য পাওয়া যায়নি' }}</p>
                <p><strong>গ্রাম:</strong> {{ $person->village ?? 'তথ্য পাওয়া যায়নি' }}</p>
                <p><strong>ডাকঘর:</strong> {{ $person->post_office ?? 'তথ্য পাওয়া যায়নি' }}</p>
                <p><strong>থানা:</strong> {{ $person->thana ?? 'তথ্য পাওয়া যায়নি' }}</p>
                <p><strong>জেলা:</strong> {{ $person->district ?? 'তথ্য পাওয়া যায়নি' }}</p>
              </div>
              <div class="col-12 mt-2 text-center">
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
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বন্ধ করুন</button>
          </div>
        </div>
      </div>
    </div>
  @endforeach

@endsection