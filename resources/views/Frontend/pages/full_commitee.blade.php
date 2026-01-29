@extends('frontend.layouts.master_layout')
@section('content')
  <!-- About Section -->
  <section class="py-5 ">
    <div class="container">
		<section class="page-header ">
			<div class="container">
				<div class="row">
					<div class="col-12 text-center">
						<h1 class="fw-bold">{{ $committeeData->committee_name }}</h1>
						<div class="border-bottom border-white border-3 mx-auto" style="width: 100px; background-color:#1A9B9F;"></div>
						<p class="mt-2 lead">মণিপুরী যুব কল্যাণ সমিতির সকল সদস্যের তালিকা</p>
					</div>
				</div>
			</div>
		</section>

        <!-- Table View for Desktop -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover committee-table">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 120px;">
                                <i class="fas fa-user-circle me-2"></i>ছবি
                            </th>
                            <th>
                                <i class="fas fa-user me-2"></i>নাম
                            </th>
                            <th class="text-center">
                                <i class="fas fa-medal me-2"></i>পদ
                            </th>
                            <th>
                                <i class="fas fa-phone me-2"></i>ফোন
                            </th>
                            <th>
                                <i class="fas fa-envelope me-2"></i>ইমেইল
                            </th>
                            <th class="text-center" style="width: 120px;">
                                <i class="fas fa-user me-2"></i> প্রোফাইল
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($committeeMembers as $committeeMember)
                            <tr class="committee-row">
                                <td class="align-middle text-center">
                                    <div class="square-photo-wrapper">
                                        <img src="{{ $committeeMember->photo ? asset($committeeMember->photo) : asset('Frontend-Assets/images/profile_img.png') }}" class="square-photo">
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div class="committee-info">
                                        <h6 class="fw-bold mb-1" style="color: #333333;">
                                            {{$committeeMember->name}}</h6>
                                        <small style="color: var(--secondary-green);">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            {{$committeeMember->address }}
                                        </small>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="badge text-white" style="background-color: var(--primary-green);">
                                        {{ role_name($committeeMember->role) }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    <a href="tel:+8801712345678" class="contact-link">
                                        <i class="fas fa-phone me-2" style="color: var(--primary-green);"></i>
                                        {{$committeeMember->mobile }}
                                    </a>
                                </td>
                                <td class="align-middle">
                                    <a href="mailto:president@manipuri.org" class="contact-link">
                                        <i class="fas fa-envelope me-2" style="color: var(--secondary-green);"></i>
                                        {{$committeeMember->email }}
                                    </a>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{$committeeMember->facebook }}" 
                                        target="_blank" 
                                        class="btn btn-sm btn-outline-primary" 
                                        title="প্রোফাইল দেখুন">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="fas fa-info-circle me-2"></i>কোন সদস্য পাওয়া যায়নি।
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Card View for Mobile -->
        <div class="cards-container">
            @forelse($committeeMembers as $committeeMember)
                <div class="committee-card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-crown me-1"></i>{{ role_name($committeeMember->role) }}</h5>
                    </div>
                    <div class="card-body text-center">
                        <div class="card-square-photo">
                            <img src="{{ $committeeMember->photo ? asset($committeeMember->photo) : asset('Frontend-Assets/images/profile_img.png') }}" class="square-photo">
                        </div>
                        <h5 class="fw-bold" style="color: #333333;">{{$committeeMember->name}}</h5>
                        <p class="mb-2">
                            <i class="fas fa-map-marker-alt me-1" style="color: var(--secondary-green);"></i>
                            {{$committeeMember->address }}
                        </p>
                        <p class="mb-1">
                            <i class="fas fa-phone me-2" style="color: var(--primary-green);"></i>
                            <a href="tel:{{$committeeMember->mobile }}" class="contact-link">{{$committeeMember->mobile }}</a>
                        </p>
                        <p class="mb-1">
                            <i class="fas fa-envelope me-2" style="color: var(--secondary-green);"></i>
                            <a href="mailto:{{$committeeMember->email }}" class="contact-link">{{$committeeMember->email }}</a>
                        </p>
                        <div class="action-buttons">
                            <a href="{{$committeeMember->facebook }}" 
                                target="_blank" 
                                class="btn btn-sm btn-outline-primary" 
                                title="প্রোফাইল দেখুন">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </div>
                    </div>
                </div>  
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">
                        <i class="fas fa-info-circle me-2"></i>কোন সদস্য পাওয়া যায়নি
                    </td>
                </tr>
            @endforelse       
        </div>
		
    </div>
  </section>

@endsection