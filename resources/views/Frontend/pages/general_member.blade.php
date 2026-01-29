@extends('frontend.layouts.master_layout')
@section('content') 
<!-- lifetime member Section -->
<div class="member_form">

	<div class="application-container">
		<div class="application-header">
			<h2><i class="fas fa-users me-2"></i>সাধারণ সদস্য আবেদন ফর্ম</h2>
			<p class="mb-0">সংগঠনের সাধারণ সদস্য হওয়ার জন্য নিচের ফর্মটি পূরণ করুন</p>
		</div>
	
		<div class="application-body">
			<form action="{{route('general.member.store')}}" method="POST" enctype="multipart/form-data" id="membershipForm">
				@csrf

				<!-- ব্যক্তিগত তথ্য -->
				<div class="form-section">
					<div class="text-center my-1">
						<p class="btn btn-lg btn-outline-primary px-2 py-1 rounded-pill fw-semibold shadow-sm"
						data-bs-toggle="modal" data-bs-target="#membershipReasonModal">
							<i class="fas fa-question-circle me-2"></i> আপনি কেন সাধারন সদস্য হবেন ?
						</p>
					</div>

					<h4 class="section-title">কমিটি নির্বাচন তথ্য</h4>
					<div class="row">
						<div class="col-md-6 mb-3">
								@error('gm_id')
								<label class="form-label text-danger">{{$message}}</label>
								@else
								<label class="form-label">কমিটি নির্বাচন করুন</label>
								@enderror
								<select name="gm_id" class="form-select">
									<option value="">নির্বাচন করুন</option>
									@foreach($committeeNames as $committeeName)
										<option value="{{ $committeeName->id }}">{{ $committeeName->committee_name }}</option>
									@endforeach
								</select>
							</div>
					</div>

					<h4 class="section-title">ব্যক্তিগত তথ্য</h4>
					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="fullName" class="form-label required-field @error('name') text-danger @enderror">
								@error('name') {{ $message }} @else পূর্ণ নাম @enderror
							</label>
							<input type="text" name="name" class="form-control" id="fullName" value="{{ old('name') }}" required>
						</div>

						<div class="col-md-6 mb-3">
							<label for="father_husband_name" class="form-label required-field @error('father_husband_name') text-danger @enderror">
								@error('father_husband_name') {{ $message }} @else @enderror
							</label>
							<div class="d-flex align-items-center gap-3">
								<div class="d-flex align-items-center">
									<input class="relation-checkbox" type="radio" name="relation_type" id="fatherOption" value="পিতা" checked>
									<label for="fatherOption" class="relation-label">পিতা</label>
								</div>
								<div class="d-flex align-items-center">
									<input class="relation-checkbox" type="radio" name="relation_type" id="husbandOption" value="স্বামী">
									<label for="husbandOption" class="relation-label">স্বামী</label>
								</div>
							</div>
							<input type="text" name="father_husband_name" class="form-control mt-2" id="relationName" placeholder="পিতার নাম লিখুন">
						</div>

					</div>
					
					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="motherName" class="form-label required-field @error('mother_name') text-danger @enderror">
								@error('mother_name') {{ $message }} @else মাতার নাম @enderror
							</label>
							<input type="text" name="mother_name" class="form-control" id="motherName" value="{{ old('mother_name') }}" required>
						</div>
						<div class="col-md-6 mb-3">
							<label for="dateOfBirth" class="form-label required-field @error('date_of_birth') text-danger @enderror">
								@error('date_of_birth') {{ $message }} @else জন্ম তারিখ @enderror
							</label>
							<input type="date" name="date_of_birth" class="form-control" id="dateOfBirth" value="{{ old('date_of_birth') }}" required>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="gender" class="form-label required-field @error('gender') text-danger @enderror">
								@error('gender') {{ $message }} @else লিঙ্গ @enderror
							</label>
							<select class="form-select" name="gender" id="gender" required>
								<option value="" disabled {{ old('gender') ? '' : 'selected' }}>লিঙ্গ নির্বাচন করুন</option>
								<option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>পুরুষ</option>
								<option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>মহিলা</option>
								<option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>অন্যান্য</option>
							</select>
						</div>
						<div class="col-md-6 mb-3">
							<label for="caste" class="form-label required-field @error('caste') text-danger @enderror">
								@error('caste') {{ $message }} @else গোত্র @enderror
							</label>
							<select class="form-select" name="caste" id="caste" required>
								<option value="" disabled {{ old('caste') ? '' : 'selected' }}>গোত্র নির্বাচন করুন</option>
								<option value="modhukollo" {{ old('caste') == 'modhukollo' ? 'selected' : '' }}>মধুকল্য</option>
								<option value="kassob" {{ old('caste') == 'kassob' ? 'selected' : '' }}>কাশ্যব</option>
								<option value="angrishya" {{ old('caste') == 'angrishya' ? 'selected' : '' }}>আংগ্রিশ্য</option>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="marital_status" class="form-label required-field @error('marital_status') text-danger @enderror">
								@error('marital_status') {{ $message }} @else বৈবাহিক অবস্থা @enderror
							</label>
							<select class="form-select" name="marital_status" id="marital_status" required>
								<option value="" disabled {{ old('marital_status') ? '' : 'selected' }}>বৈবাহিক অবস্থা নির্বাচন করুন</option>
								<option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>বিবাহিত</option>
								<option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>অবিবাহিত</option>
								<option value="divorced" {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>তালাকপ্রাপ্ত</option>
								<option value="widowed" {{ old('marital_status') == 'widowed' ? 'selected' : '' }}>বিধবা</option>
							</select>
						</div>
						<div class="col-md-6 mb-3">
							<label for="blood_group" class="form-label required-field @error('blood_group') text-danger @enderror">
								@error('blood_group') {{ $message }} @else রক্তের গ্রুপ @enderror
							</label>
							<select name="blood_group" id="blood_group" class="form-select">
								<option value="" {{ old('blood_group') ? '' : 'selected' }}>নির্বাচন করুন</option>
								@foreach(['A+','A-','B+','B-','O+','O-','AB+','AB-'] as $group)
									<option value="{{ $group }}" {{ old('blood_group') == $group ? 'selected' : '' }}>{{ $group }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

				<!-- যোগাযোগের তথ্য -->
				<div class="form-section">
					<h4 class="section-title">যোগাযোগের তথ্য</h4>
					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="village" class="form-label required-field @error('village') text-danger @enderror">
								@error('village') {{ $message }} @else গ্রাম @enderror
							</label>
							<input type="text" name="village" class="form-control" id="village" value="{{ old('village') }}" required>
						</div>
						<div class="col-md-6 mb-3">
							<label for="post_office" class="form-label required-field @error('post_office') text-danger @enderror">
								@error('post_office') {{ $message }} @else পোষ্ট অফিস @enderror
							</label>
							<input type="text" name="post_office" class="form-control" id="post_office" value="{{ old('post_office') }}" required>
						</div>
						<div class="col-md-6 mb-3">
							<label for="thana" class="form-label required-field @error('thana') text-danger @enderror">
								@error('thana') {{ $message }} @else থানা @enderror
							</label>
							<input type="text" name="thana" class="form-control" id="thana" value="{{ old('thana') }}" required>
						</div>
						<div class="col-md-6 mb-3">
							<label for="district" class="form-label required-field @error('district') text-danger @enderror">
								@error('district') {{ $message }} @else জেলা @enderror
							</label>
							<input type="text" name="district" class="form-control" id="district" value="{{ old('district') }}" required>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="phone" class="form-label required-field @error('mobile_number') text-danger @enderror">
								@error('mobile_number') {{ $message }} @else মোবাইল নম্বর @enderror
							</label>
							<input type="tel" name="mobile_number" class="form-control" id="phone" value="{{ old('mobile_number') }}" required>
						</div>
					</div>
				</div>
				
				<!-- পেশাগত তথ্য -->
				<div class="form-section">
					<h4 class="section-title">পেশাগত তথ্য</h4>
					<div class="row">
						<div class="col-md-12 mb-3">
							<label for="profession" class="form-label required-field @error('profession') text-danger @enderror">
								@error('profession') {{ $message }} @else পেশা @enderror
							</label>
							<input type="text" name="profession" class="form-control" id="profession" value="{{ old('profession') }}" required>
						</div>
					</div>
				</div>
				
				<!-- প্রয়োজনীয় নথি -->
				<div class="form-section">
					<h4 class="section-title">প্রয়োজনীয় নথি</h4>
					<div class="row">
						<div class="col-md-6 mb-3">
							<label class="form-label @error('photo') text-danger @enderror">
								@error('photo') {{ $message }} @else পাসপোর্ট সাইজের ছবি @enderror
							</label>

							<!-- Label Click = File Input Trigger -->
							<label for="photoFile" class="upload-area" style="cursor:pointer;">
								<div class="upload-icon"><i class="fas fa-camera"></i></div>
								<p>এখানে ক্লিক করে ফাইল আপলোড করুন</p>
								<small class="text-muted">সর্বোচ্চ সাইজ: 1MB</small>
							</label>

							<input type="file" name="photo" id="photoFile" class="d-none" accept="image/*">
						</div>
					</div>
				</div>

				
				<!-- জমা দিন বাটন -->
				<div class="text-center">
					<button type="submit" class="btn btn-primary btn-lg">
						<i class="fas fa-paper-plane me-2"></i>আবেদন জমা দিন
					</button>
				</div>
			</form>
		</div>
	</div>
</div>



<!--আপনি কেন সাধারন সদস্য হবেন Modal -->
<div class="modal fade" id="membershipReasonModal" tabindex="-1" aria-labelledby="membershipReasonLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="membershipReasonLabel"><i class="fas fa-star me-2"></i> আজীবন সদস্য হওয়ার কারণ</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="lead text-dark">
          সংগঠনের সাধারন সদস্য হয়ে আপনি শুধু নিজেকে নয়, সমাজকেও এগিয়ে নিতে পারেন।
          এই সদস্যপদ আপনাকে বিভিন্ন সামাজিক, সাংস্কৃতিক ও মানবিক কার্যক্রমে সক্রিয় অংশগ্রহণের সুযোগ করে দেয়।
          এছাড়া সাধারন সদস্য হিসেবে আপনি সংগঠনের উন্নয়ন ও সিদ্ধান্তগ্রহণ প্রক্রিয়ায় ভূমিকা রাখতে পারবেন।
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বন্ধ করুন</button>
      </div>
    </div>
  </div>
</div>

<script>
	const fatherOption = document.getElementById('fatherOption');
	const husbandOption = document.getElementById('husbandOption');
	const relationName = document.getElementById('relationName');

	function updatePlaceholder() {
		if (fatherOption.checked) {
			relationName.placeholder = "পিতার নাম লিখুন";
		} else if (husbandOption.checked) {
			relationName.placeholder = "স্বামীর নাম লিখুন";
		} else {
			relationName.placeholder = "নাম লিখুন";
		}
	}

	fatherOption.addEventListener('change', () => {
		if (fatherOption.checked) husbandOption.checked = false;
		updatePlaceholder();
	});

	husbandOption.addEventListener('change', () => {
		if (husbandOption.checked) fatherOption.checked = false;
		updatePlaceholder();
	});
</script>
<script>
document.getElementById('photoFile').addEventListener('change', function(e) {
    let reader = new FileReader();
    reader.onload = function(event) {
        document.querySelector('.upload-icon').innerHTML =
            `<img src="${event.target.result}" class="img-fluid" />`;
    };
    reader.readAsDataURL(e.target.files[0]);
});
</script>

@endsection