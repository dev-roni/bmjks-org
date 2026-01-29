@extends('Backend.Layout.MasterLayout')

@section('Content')

    <div class="container my-4">
        <div class="card shadow-sm mx-auto" style="max-width: 70rem;">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">সদস্য তৈরি করুন</h5>
            </div>
            <form action="{{route('person.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            @error('name')
                            <label class="form-label text-danger">{{$message}}</label>
                            @else
                            <label class="form-label">নাম</label>
                            @enderror
                            <input name="name" class="form-control" placeholder="পূর্ণ নাম লিখুন" value="{{ old('name') }}" required>
                        </div>

                        <div class="col-md-6">
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
                            <input type="text" name="father_husband_name" class="form-control mt-2" id="relationName" value="{{ old('father_husband_name') }}" placeholder="পিতার নাম লিখুন">
                        </div>

                        <div class="col-md-6">
                            @error('mother_name')
                            <label class="form-label text-danger">{{$message}}</label>
                            @else
                            <label class="form-label">মাতার নাম</label>
                            @enderror
                            <input name="mother_name" class="form-control" value="{{ old('mother_name') }}" placeholder="মাতার নাম লিখুন">
                        </div>

                        <div class="col-md-6">
                            @error('photo')
                            <label class="form-label text-danger">{{$message}}</label>
                            @else
                            <label class="form-label">ছবি</label>
                            @enderror
                            <input type="file" name="photo" class="form-control" onchange="previewMemberPhoto(event)">
                            <img id="previewPhoto" src="" alt="Preview" class="mt-2 rounded" style="max-height:120px; display:none;">
                        </div>

                        <div class="col-md-6">
                            @error('date_of_birth')
                            <label class="form-label text-danger">{{$message}}</label>
                            @else
                            <label class="form-label">জন্ম তারিখ</label>
                            @enderror
                            <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"  class="form-control">
                        </div>

                        <div class="col-md-6">
                            @error('gender')
                            <label class="form-label text-danger">{{$message}}</label>
                            @else
                            <label class="form-label">লিঙ্গ</label>
                            @enderror
                            <select name="gender" class="form-select">
                                <option value="">লিঙ্গ নির্বাচন করুন</option>
                                <option value="male">পুরুষ</option>
                                <option value="female">মহিলা</option>
                                <option value="other">অন্যান্য</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            @error('caste')
                            <label class="form-label text-danger">{{$message}}</label>
                            @else
                            <label class="form-label">গোত্র</label>
                            @enderror
                            <select name="caste" class="form-select">
                                <option value="">গোত্র নির্বাচন করুন</option>
                                <option value="male">পুরুষ</option>
                                <option value="female">মহিলা</option>
                                <option value="other">অন্যান্য</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            @error('marital_status')
                            <label class="form-label text-danger">{{$message}}</label>
                            @else
                            <label class="form-label">বৈবাহিক অবস্থা</label>
                            @enderror
                            <select name="marital_status" class="form-select">
                                <option value="">বৈবাহিক অবস্থা নির্বাচন করুন</option>
                                <option value="single">অবিবাহিত</option>
                                <option value="married">বিবাহিত</option>
                                <option value="widowed">বিধবা</option>
                                <option value="divorced">তালাকপ্রাপ্ত</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            @error('mobile_number')
                            <label class="form-label text-danger">{{$message}}</label>
                            @else
                            <label class="form-label">মোবাইল নম্বর</label>
                            @enderror
                            <input name="mobile_number" class="form-control" value="{{ old('mobile_number') }}" placeholder="১১-সংখ্যার মোবাইল নম্বর লিখুন (যেমনঃ 01XXXXXXXXX)">
                        </div>

                        <div class="col-md-6">
                            @error('village')
                            <label class="form-label text-danger">{{$message}}</label>
                            @else
                            <label class="form-label">গ্রাম</label>
                            @enderror
                            <input name="village" class="form-control" value="{{ old('village') }}" placeholder="গ্রামের নাম লিখুন">
                        </div>

                        <div class="col-md-6">
                            @error('post_office')
                            <label class="form-label text-danger">{{$message}}</label>
                            @else
                            <label class="form-label">পোস্ট অফিস</label>
                            @enderror
                            <input name="post_office" class="form-control" value="{{ old('post_office') }}" placeholder="পোস্ট অফিসের নাম লিখুন">
                        </div>

                        <div class="col-md-6">
                            @error('thana')
                            <label class="form-label text-danger">{{$message}}</label>
                            @else
                            <label class="form-label">থানা</label>
                            @enderror
                            <input name="thana" class="form-control" value="{{ old('thana') }}" placeholder="থানার নাম লিখুন">
                        </div>

                        <div class="col-md-6">
                            @error('district')
                            <label class="form-label text-danger">{{$message}}</label>
                            @else
                            <label class="form-label">জেলা</label>
                            @enderror
                            <input name="district" class="form-control" value="{{ old('district') }}" placeholder="জেলার নাম লিখুন">
                        </div>

                        <div class="col-md-6">
                            @error('profession')
                            <label class="form-label text-danger">{{$message}}</label>
                            @else
                            <label class="form-label">পেশা</label>
                            @enderror
                            <input name="profession" class="form-control" value="{{ old('profession') }}" placeholder="আপনার পেশা লিখুন (যেমনঃ শিক্ষক, কৃষক)">
                        </div>

                        <div class="col-md-6">
                            @error('blood_group')
                            <label class="form-label text-danger">{{$message}}</label>
                            @else
                            <label class="form-label">রক্তের গ্রুপ</label>
                            @enderror
                            <select name="blood_group" class="form-select">
                                <option value="">রক্তের গ্রুপ নির্বাচন করুন</option>
                                <option value="A+" {{ old('blood_group', request('blood_group')) == 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="A-" {{ old('blood_group', request('blood_group')) == 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="B+" {{ old('blood_group', request('blood_group')) == 'B+' ? 'selected' : '' }}>B+</option>
                                <option value="B-" {{ old('blood_group', request('blood_group')) == 'B-' ? 'selected' : '' }}>B-</option>
                                <option value="O+" {{ old('blood_group', request('blood_group')) == 'O+' ? 'selected' : '' }}>O+</option>
                                <option value="O-" {{ old('blood_group', request('blood_group')) == 'O-' ? 'selected' : '' }}>O-</option>
                                <option value="AB+" {{ old('blood_group', request('blood_group')) == 'AB+' ? 'selected' : '' }}>AB+</option>
                                <option value="AB-" {{ old('blood_group', request('blood_group')) == 'AB-' ? 'selected' : '' }}>AB-</option>
                            </select>

                        </div>



                         @if(Auth::user()->account_type=='superadmin' || Auth::user()->account_type=='cashier')
                            <div class="col-md-6">
                                @error('gm_id')
                                <label class="form-label text-danger">{{$message}}</label>
                                @else
                                <label class="form-label">কমিটি নির্বাচন করুন (সাধারণ সদস্যদের জন্য)</label>
                                @enderror
                                <select name="gm_id" class="form-select">
                                    <option value="">কমিটি নির্বাচন করুন</option>
                                    @foreach($committeeNames as $committeeName)
                                        <option value="{{ $committeeName->id }}">{{ $committeeName->committee_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input name="gm_id" value="{{Auth::user()->branch}}" type="hidden">
                        @endif

                        <div class="col-md-12">
                            <label class="form-label d-block mb-2">সদস্যের ক্যাটাগরি</label>
                            @php
                                $filteredTags = !in_array(Auth::user()->account_type, ['superadmin', 'cashier'])
                                    ? $tags->where('id', '!=', 1)
                                    : $tags;
                            @endphp
                            @foreach($filteredTags as $tag)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="person_tag[]" value="{{ $tag->id }}" id="tag{{ $tag->id }}">
                                    <label class="form-check-label" for="tag{{ $tag->id }}">{{ $tag->person_type_name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-success">সংরক্ষণ করুন</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewMemberPhoto(event) {
            const input = event.target;
            const preview = document.getElementById('previewPhoto');
            const reader = new FileReader();
            reader.onload = function () {
                preview.src = reader.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }

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

@endsection