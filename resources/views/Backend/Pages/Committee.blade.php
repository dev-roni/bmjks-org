@extends('Backend.Layout.MasterLayout')

@section('Content')

    <!-- Page Action Buttons -->
    <div class="container mt-4">
        <div class="row g-3 d-flex justify-content-between align-items-center">

            <!-- Date Filter -->
            <div class="col-12 col-md-6 col-lg-4">
                <form action="" method="get">
                    <div class="input-group">
                        <input class="form-control" type="date">
                        <button class="btn btn-outline-success" type="submit">বাছাই করুন</button>
                    </div>
                </form>
            </div>

            <!-- Search -->
            <div class="col-12 col-md-6 col-lg-4">
                <form action="" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="সদস্যের নাম দিন">
                        <button class="btn btn-outline-success" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i> অনুসন্ধান
                        </button>
                    </div>
                </form>
            </div>

            <!-- New Member -->
            <div class="col-12 col-md-6 col-lg-2">
                <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#memberModal">
                    <i class="fa-solid fa-user-plus me-1"></i> নতুন সদস্য
                </button>
            </div>

        </div>
    </div>

    <!-- Members Table -->
    <div class="card table-card shadow-sm mt-4">
        <div class="card-header text-white text-center">
            <i class="fa-solid fa-users-gear me-1"></i> প্রধান কমিটি সদস্য তালিকা
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr class="text-center">
                        <th>ক্রমিক</th>
                        <th>ছবি</th>
                        <th>নাম</th>
                        <th>পদবি</th>
                        <th>মোবাইল</th>
                        <th>অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td data-label="ক্রমিক">১</td>
                        <td data-label="ছবি"><img src="Assets/img/Hero1.png" alt="সদস্যের ছবি" width="42" height="42"
                                class="rounded-circle object-fit-cover"></td>
                        <td data-label="নাম">জনাব আব্দুল করিম</td>
                        <td data-label="পদবি"><span class="badge type">সভাপতি</span></td>
                        <td data-label="মোবাইল">01711-000000</td>
                        <td data-label="অ্যাকশন">
                            <div class="d-flex flex-row justify-content-center gap-2">
                                <button type="button" class="action-btn-info" title="বিস্তারিত দেখুন" data-bs-toggle="modal"
                                    data-bs-target="#modalViewMember">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="action-btn-success" title="সম্পাদন করুন" data-bs-toggle="modal" data-bs-target="#modalMember">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn action-btn-danger" title="মুছে ফেলুন" data-bs-toggle="modal"
                                    data-bs-target="#deleteMemberModal">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="text-center">
                        <td data-label="ক্রমিক">২</td>
                        <td data-label="ছবি">
                            <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center"
                                style="width:42px;height:42px;">AH</div>
                        </td>
                        <td data-label="নাম">জনাব আজিজুল হক</td>
                        <td data-label="পদবি"><span class="badge type">সাধারণ সম্পাদক</span></td>
                        <td data-label="মোবাইল">01812-111111</td>
                        <td data-label="অ্যাকশন">
                            <div class="d-flex flex-row justify-content-center gap-2">
                                <button type="button" class="action-btn-info" title="বিস্তারিত দেখুন" data-bs-toggle="modal"
                                    data-bs-target="#modalViewMember">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="action-btn-success" data-bs-toggle="modal" data-bs-target="#modalMember">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn action-btn-danger" title="Delete" data-bs-toggle="modal"
                                    data-bs-target="#deleteMemberModal">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Member Create Modal -->
    <div class="modal fade" id="memberModal" tabindex="-1" aria-labelledby="memberModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="memberModalLabel"><i class="fa-solid fa-users me-2"></i> নতুন সদস্য যোগ করুন
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">সদস্যের নাম</label>
                            <input type="text" class="form-control" id="name" placeholder="সদস্যের পূর্ণ নাম লিখুন"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">প্রোফাইল ছবি</label>
                            <input type="file" class="form-control" id="photo" accept="image/*"
                                onchange="previewImage(event)">
                        </div>
                        <div class="mb-3 text-center">
                            <img id="photoPreview" src="#" alt="ছবি প্রিভিউ" class="img-fluid rounded shadow-sm d-none"
                                style="max-width: 200px;">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">পদবি/ভূমিকা</label>
                            <select class="form-select" id="role" required>
                                <option value="">পদবি নির্বাচন করুন</option>
                                <option value="president">সভাপতি</option>
                                <option value="secretary">সম্পাদক</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">মোবাইল নাম্বার</label>
                            <input type="text" class="form-control" id="mobile" placeholder="01XXXXXXXXX" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">ইমেইল ঠিকানা</label>
                            <input type="email" class="form-control" id="email" placeholder="example@mail.com">
                        </div>
                        <div class="mb-3">
                            <label for="facebook" class="form-label">ফেসবুক প্রোফাইল লিঙ্ক</label>
                            <input type="url" class="form-control" id="facebook"
                                placeholder="https://facebook.com/username">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল</button>
                    <button type="submit" class="btn btn-success">সংরক্ষণ করুন</button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Member Modal -->
    <div class="modal fade" id="modalViewMember" tabindex="-1" aria-labelledby="modalViewMemberLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h6 class="modal-title" id="modalViewMemberLabel">সদস্যের বিস্তারিত তথ্য</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12 text-center">
                            <img id="memberPhoto" src="Assets/img/Hero1.png" alt="সদস্যের ছবি"
                                class="rounded-circle object-fit-cover" width="100" height="100">
                        </div>
                        <div class="col-12 text-center">
                            <h5 id="memberName" class="mb-0 mt-2">জনাব আব্দুল করিম</h5>
                            <p id="memberPosition" class="text-muted">সভাপতি</p>
                        </div>
                        <hr>
                        <div class="col-12">
                            <p class="mb-1"><strong>মোবাইল:</strong> <span id="memberMobile">01711-000000</span></p>
                            <p class="mb-1"><strong>শাখা:</strong> কেন্দ্রীয় কমিটি</p>
                            <p class="mb-1"><strong>যোগদানের তারিখ:</strong> ১০-০৩-২০২১</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বন্ধ করুন</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Member Modal -->
    <div class="modal fade" id="modalMember" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h6 class="modal-title">সদস্য তথ্য সম্পাদনা করুন</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">নাম</label>
                                <input class="form-control" required placeholder="সদস্যের নাম লিখুন">
                            </div>
                            <div class="col-12">
                                <label class="form-label">পদবি/ভূমিকা</label>
                                <select class="form-select" required>
                                    <option value="">পদবি নির্বাচন করুন</option>
                                    <option>সভাপতি</option>
                                    <option>সহ-সভাপতি</option>
                                    <option>সাধারণ সম্পাদক</option>
                                    <option>সহ-সম্পাদক</option>
                                    <option>সাংগঠনিক সম্পাদক</option>
                                    <option>সদস্য</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">মোবাইল নাম্বার</label>
                                <input class="form-control" placeholder="01XXXXXXXXX" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">ইমেইল ঠিকানা</label>
                                <input type="email" class="form-control" placeholder="example@mail.com">
                            </div>
                            <div class="col-12">
                                <label class="form-label">ফেসবুক প্রোফাইল লিঙ্ক</label>
                                <input type="url" class="form-control" placeholder="https://facebook.com/username">
                            </div>
                            <div class="col-12">
                                <label class="form-label">প্রোফাইল ছবি</label>
                                <input type="file" class="form-control" id="memberPhoto" accept="image/*"
                                    onchange="previewMemberImage(event)">
                            </div>
                            <div class="col-12 text-center">
                                <img id="memberPhotoPreview" src="#" alt="ছবি প্রিভিউ"
                                    class="img-fluid rounded-circle shadow-sm d-none" style="max-width: 150px;">
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

    <!-- Delete Member Modal -->
    <div class="modal fade" id="deleteMemberModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h6 class="modal-title">সদস্য মুছে ফেলুন</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p>আপনি কি নিশ্চিত যে আপনি এই সদস্যকে মুছে ফেলতে চান?</p>
                    <p class="text-danger">এই কাজটি পূর্বাবস্থায় ফেরানো যাবে না।</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল</button>
                    <button type="button" class="btn btn-danger">মুছে ফেলুন</button>
                </div>
            </div>
        </div>
    </div>

@endsection