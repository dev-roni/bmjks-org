@extends('Backend.Layout.MasterLayout')

@section('Content')

    <div class="container my-4">
        <div class="card shadow-sm mx-auto" style="max-width: 70rem;">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">ব্যক্তির তথ্য সম্পাদনা</h5>
            </div>
            <form action="{{route('person.update', $person->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="row g-3">
                        <!-- নাম -->
                        <div class="col-md-6">
                            <label class="form-label @error('name') text-danger @enderror">নাম</label>
                            <input name="name" class="form-control" value="{{ old('name', $person->name) }}" required>
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
                            <label class="form-label @error('mother_name') text-danger @enderror">মাতার নাম</label>
                            <input name="mother_name" class="form-control" value="{{ old('mother_name', $person->mother_name) }}">
                        </div>

                        <!-- ছবি -->
                        <div class="col-md-6">
                            <label class="form-label @error('photo') text-danger @enderror">ছবি</label>
                            <input type="file" name="photo" class="form-control" onchange="previewMemberPhoto(event)">
                            <img id="previewPhoto" src="{{ $person->photo ? asset($person->photo) : '' }}" alt="Preview" class="mt-2 rounded" style="max-height:120px; {{ $person->photo ? '' : 'display:none;' }}">
                        </div>

                        <!-- জন্ম তারিখ -->
                        <div class="col-md-6">
                            <label class="form-label @error('date_of_birth') text-danger @enderror">জন্ম তারিখ</label>
                            <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', $person->date_of_birth) }}">
                        </div>

                        <!-- লিঙ্গ -->
                        <div class="col-md-6">
                            <label class="form-label @error('gender') text-danger @enderror">লিঙ্গ</label>
                            <select name="gender" class="form-select">
                                <option value="">নির্বাচন করুন</option>
                                <option value="male" {{ $person->gender == 'male' ? 'selected' : '' }}>পুরুষ</option>
                                <option value="female" {{ $person->gender == 'female' ? 'selected' : '' }}>মহিলা</option>
                                <option value="other" {{ $person->gender == 'other' ? 'selected' : '' }}>অন্যান্য</option>
                            </select>
                        </div>

                        <!-- জাত -->
                         <div class="col-md-6">
                            <label class="form-label @error('caste') text-danger @enderror">গোত্র</label>
                            <select name="caste" class="form-select">
                                <option value="আঙগ্রিশ্য" {{ $person->caste == 'আঙগ্রিশ্য' ? 'selected' : '' }}>আঙগ্রিশ্য</option>
                                <option value="মদুকল্য" {{ $person->caste == 'মদুকল্য' ? 'selected' : '' }}>মদুকল্য</option>
                                <option value="বিয়াগ্র" {{ $person->caste == 'বিয়াগ্র' ? 'selected' : '' }}>বিয়াগ্র</option>
                            </select>
                        </div>

                        <!-- বৈবাহিক অবস্থা -->
                        <div class="col-md-6">
                            <label class="form-label @error('marital_status') text-danger @enderror">বৈবাহিক অবস্থা</label>
                            <select name="marital_status" class="form-select">
                                <option value="">নির্বাচন করুন</option>
                                <option value="single" {{ $person->marital_status == 'single' ? 'selected' : '' }}>অবিবাহিত</option>
                                <option value="married" {{ $person->marital_status == 'married' ? 'selected' : '' }}>বিবাহিত</option>
                                <option value="widowed" {{ $person->marital_status == 'widowed' ? 'selected' : '' }}>বিপত্নীক/বিধবা</option>
                                <option value="divorced" {{ $person->marital_status == 'divorced' ? 'selected' : '' }}>তালাকপ্রাপ্ত</option>
                            </select>
                        </div>

                        <!-- মোবাইল -->
                        <div class="col-md-6">
                            <label class="form-label @error('mobile_number') text-danger @enderror">মোবাইল নম্বর</label>
                            <input name="mobile_number" class="form-control" value="{{ old('mobile_number', $person->mobile_number) }}" placeholder="01XXXXXXXXX">
                        </div>

                        <!-- গ্রাম -->
                        <div class="col-md-6">
                            <label class="form-label @error('village') text-danger @enderror">গ্রাম</label>
                            <input name="village" class="form-control" value="{{ old('village', $person->village) }}">
                        </div>

                        <!-- পোস্ট অফিস -->
                        <div class="col-md-6">
                            <label class="form-label @error('post_office') text-danger @enderror">পোস্ট অফিস</label>
                            <input name="post_office" class="form-control" value="{{ old('post_office', $person->post_office) }}">
                        </div>

                        <!-- থানা -->
                        <div class="col-md-6">
                            <label class="form-label @error('thana') text-danger @enderror">থানা</label>
                            <input name="thana" class="form-control" value="{{ old('thana', $person->thana) }}">
                        </div>

                        <!-- জেলা -->
                        <div class="col-md-6">
                            <label class="form-label @error('district') text-danger @enderror">জেলা</label>
                            <input name="district" class="form-control" value="{{ old('district', $person->district) }}">
                        </div>

                        <!-- পেশা -->
                        <div class="col-md-6">
                            <label class="form-label @error('profession') text-danger @enderror">পেশা</label>
                            <input name="profession" class="form-control" value="{{ old('profession', $person->profession) }}">
                        </div>

                        <!-- রক্তের গ্রুপ -->
                        <div class="col-md-6">
                            <label class="form-label @error('blood_group') text-danger @enderror">রক্তের গ্রুপ</label>
                            <select name="blood_group" class="form-select">
                                <option value="">নির্বাচন করুন</option>
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

                        <!-- সদস্যের ক্যাটাগরি -->
                        <div class="col-md-12">
                            <label class="form-label d-block mb-2">সদস্যের ক্যাটাগরি</label>
                            @php
                                $selectedTypes = $person->personType ? $person->personType->pluck('id')->toArray() : [];
                            @endphp
                            @foreach($tags->where('id','!=','1') as $tag)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="person_tag[]" value="{{ $tag->id }}" id="tag{{ $tag->id }}" {{ in_array($tag->id, $selectedTypes) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tag{{ $tag->id }}">{{ $tag->person_type_name }}</label>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-success">আপডেট করুন</button>
                </div>
@endsection