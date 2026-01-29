@extends('Backend.Layout.MasterLayout')

@section('Content')

    <div class="page-action-buttons">
        <div class="text-end">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createUserModal">
                <i class="fa-solid fa-plus me-1"></i> নতুন ইউজার
            </button>
        </div>
    </div>

    <div class="card table-card shadow-sm mt-3">
        <div class="card-header text-white text-center">
            <i class="fas fa-user-circle"></i> ইউজার তালিকা
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr class="text-center">
                            <th>ক্রমিক</th>
                            <th>নাম</th>
                            <th>একাউন্টের ধরন</th>
                            <th>শাখা</th>
                            <th>মোবাইল</th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($users as $user)
                            <tr class="text-center">
                                <td data-label="ক্রমিক">@bn($loop->iteration)</td>
                                <td data-label="নাম">{{ $user->name }}</td>
                                <td data-label="একাউন্টের ধরন">{{ $user->account_type }}</td>
                                <td data-label="শাখা">
                                    @if($user->account_type == 'admin')
                                        {{ $user->committeeName->committee_name }}
                                    @else
                                        {{ $user->account_type == 'superadmin' ? 'সুপার অ্যাডমিন' : ($user->account_type == 'cashier' ? 'ক্যাশিয়ার' : $user->account_type) }}
                                    @endif
                                </td>
                                <td data-label="মোবাইল">@bn($user->phone_no)</td>
                                <td data-label="অ্যাকশন">
                                    <div class="d-flex flex-row justify-content-center gap-2">
                                        <button class="btn action-btn-info" data-bs-toggle="modal"
                                            data-bs-target="#viewUserModal{{ $user->id }}" data-id="{{ $user->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn action-btn-success" data-bs-toggle="modal"
                                            data-bs-target="#editUserModal{{ $user->id }}" data-id="{{ $user->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn action-btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteUserModal{{ $user->id }}" data-id="{{ $user->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- View User Modal -->
                            <div class="modal fade" id="viewUserModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info text-white">
                                            <h6 class="modal-title">ইউজারের বিস্তারিত</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img src="{{ asset('Frontend-Assets/images/profile_img.png') }}" alt="প্রোফাইল ছবি" class="rounded-circle mb-3"
                                                width="100" height="100">
                                            <p><strong>নাম:</strong> {{ $user->name }}</p>
                                            <p><strong>ইউজারনেম:</strong> {{ $user->username }}</p>
                                            <p><strong>শাখা:</strong> 
                                                @if($user->account_type == 'admin')
                                                    {{ $user->committeeName->committee_name }}
                                                @else
                                                    {{ $user->account_type == 'superadmin' ? 'সুপার অ্যাডমিন' : ($user->account_type == 'cashier' ? 'ক্যাশিয়ার' : $user->account_type) }}
                                                @endif
                                            </p>
                                            <p><strong>মোবাইল:</strong> @bn($user->phone_no)</p>
                                            <p><strong>অ্যাকাউন্ট ধরন:</strong> {{ $user->account_type }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">বন্ধ করুন</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit User Modal -->
                            <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success text-white">
                                            <h6 class="modal-title">ইউজার সম্পাদনা</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <!-- form শুরু -->
                                        <form action="{{ route('password.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <div class="col-12 text-center">
                                                        <img src="{{ asset('Frontend-Assets/images/profile_img.png') }}" alt="প্রোফাইল ছবি" class="rounded-circle mb-3"
                                                            width="100" height="100" id="previewImage">
                                                        <h5 class="text-center">{{ $user->name }}</h5>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label @error('password') text-danger @enderror">
                                                            @error('password')
                                                                {{ $message }}
                                                            @else
                                                                পাসওয়ার্ড (৮+ অক্ষর, বড়+ছোট অক্ষর, সংখ্যা)
                                                            @enderror
                                                        </label>
                                                        <input type="password" name="password" class="form-control">
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label">নিশ্চিত পাসওয়ার্ড</label>
                                                        <input type="password" name="password_confirmation" class="form-control">
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

                            <!-- Delete User Modal -->
                            <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h6 class="modal-title">ইউজার মুছুন</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                        </div>
                                        <form action="{{ route('account.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" id="{{ $user->id }}">
                                            <div class="modal-body text-center">
                                                <p>আপনি কি নিশ্চিত যে আপনি এই ইউজারটি মুছে ফেলতে চান?</p>
                                                <p class="text-danger">এই কাজটি পূর্বাবস্থায় ফেরানো সম্ভব নয়।</p>
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
            </div>
        </div>
    </div>

    <!-- Create User Modal -->
    <div class="modal fade" id="createUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h6 class="modal-title">নতুন ইউজার যোগ করুন</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label @error('name') text-danger @enderror">
                                    @error('name')
                                        {{ $message }}
                                    @else
                                        অ্যাকাউন্ট ব্যবহারকারীর নাম
                                    @enderror
                                </label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label @error('username') text-danger @enderror">
                                    @error('username')
                                        {{ $message }}
                                    @else
                                        ইউজারনেম
                                    @enderror    
                                </label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label @error('phone_no') text-danger @enderror">
                                    @error('phone_no')
                                        {{ $message }}
                                    @else
                                        মোবাইল নম্বর
                                    @enderror
                                </label>
                                <input type="text" name="phone_no" class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="account_type" class="form-label @error('account_type') text-danger @enderror">
                                    @error('account_type')
                                        {{ $message }}
                                    @else
                                        অ্যাকাউন্ট ধরন নির্বাচন করুন
                                    @enderror
                                </label>
                                <select name="account_type" id="account_type" class="form-select">
                                    <option value="" selected disabled>একটি নির্বাচন করুন</option>
                                    <option value="SuperAdmin">সুপার অ্যাডমিন</option>
                                    <option value="Cashier">ক্যাশিয়ার</option>
                                    <option value="Admin">অ্যাডমিন</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="branch" class="form-label @error('branch') text-danger @enderror">
                                    @error('branch')
                                        {{ $message }}
                                    @else
                                        কমিটি নির্বাচন করুন
                                    @enderror
                                </label>
                                <select name="branch" id="branch" class="form-select">
                                    <option value="" selected disabled>একটি নির্বাচন করুন</option>
                                    @foreach($users as $committee)
                                        <option value="{{ $committee->id }}">{{ $committee->account_type == 'admin' ? $committee->committeeName->committee_name : $committee->account_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label @error('password') text-danger @enderror">
                                    @error('password')
                                        {{ $message }}
                                    @else
                                        পাসওয়ার্ড (৮+ অক্ষর, বড়+ছোট অক্ষর, সংখ্যা)
                                    @enderror
                                </label>
                                <input type="password" name="password" class="form-control" placeholder="Password1234">
                            </div>
                            <div class="col-12">
                                <label class="form-label @error('password_confirmation') text-danger @enderror">
                                    @error('password_confirmation')
                                        {{ $message }}
                                    @else
                                        নিশ্চিত পাসওয়ার্ড
                                    @enderror
                                </label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">বাতিল</button>
                        <button type="submit" name="submit" class="btn btn-success">সংরক্ষণ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const accountType = document.getElementById('account_type');
            const branchField = document.getElementById('branch').closest('.col-12'); // পুরো div

            function toggleBranchField() {
                const value = accountType.value.toLowerCase();
                if (value === 'superadmin' || value === 'cashier') {
                    branchField.style.display = 'none';
                } else {
                    branchField.style.display = 'block';
                }
            }

            // প্রথমে লোডে চেক করা
            toggleBranchField();

            // onchange ইভেন্ট
            accountType.addEventListener('change', toggleBranchField);
        });
    </script>
    
@endsection