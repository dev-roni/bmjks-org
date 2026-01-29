@extends('Backend.Layout.MasterLayout')

@section('Content')

    <div class="container my-4">
        <div class="card shadow-sm mx-auto" style="max-width: 70rem;">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">সদস্যদের ক্যাটাগরি তৈরি করুন </h5>
            </div>
            <form action="{{route('tag.create')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            @error('tag_create')
                            <label class="form-label text-danger">{{$message}}</label>
                            @else
                            <label class="form-label" >সদস্যদের নতুন ক্যাটাগরির নাম (বাংলা)</label>
                            @enderror
                            <input name="tag_create" placeholder="নতুন ক্যাটাগরির নাম লিখুন (বাংলায়)" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-success">সংরক্ষণ</button>
                </div>
            </form>
        </div>

        {{-- আগের ট্যাগগুলোর লিস্ট --}}
<div class="card shadow-sm mx-auto mt-4" style="max-width: 70rem;">
    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-tags me-2"></i>ইতোমধ্যে তৈরি করা ক্যাটাগরি</h5>
    </div>
    <div class="card-body">
        @if($tags->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-success">
                        <tr class="text-center">
                            <th scope="col" width="60">ক্রমিক</th>
                            <th scope="col">ক্যাটাগরির নাম</th>
                            <th scope="col" width="120" class="text-center">লোকজন</th>
                            <th scope="col" width="200" class="text-center">একশন</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tags as $tag)
                            <tr class="text-center">
                                <td scope="row" data-label="ক্রমিক">@bn($loop->iteration)</td>
                                <td data-label="ক্যাটাগরি নাম">
                                    <div>
                                        {{ $tag->person_type_name }}
                                    </div>
                                </td>
                                <td class="text-center" data-label="সদস্য সংখ্যা">
                                    <span class="badge bg-info rounded-pill">@bn($tag->persons_count ?? 0 )</span>
                                </td>
                                <td data-label="এ্যাকশন">
                                    <div class="d-flex justify-content-center gap-2">
                                        @if(!in_array($tag->id, [1, 2]))
                                        <!-- Status Change Button -->
                                        <button type="button" class="btn btn-sm {{ $tag->status == 'active' ? 'btn-outline-success' : 'btn-outline-secondary' }}" 
                                                data-bs-toggle="modal" data-bs-target="#statusModal{{$tag->id}}">
                                            <i class="fas {{ $tag->status == 'active' ? 'fa-eye' : 'fa-eye-slash' }} me-1"></i>
                                            {{ $tag->status == 'active' ? 'দৃশ্যমান' : 'অদৃশ্য' }}
                                        </button>

                                        <!-- Delete Button -->
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{$tag->id}}">
                                            <i class="fas fa-trash-alt me-1"></i> মুছুন
                                        </button>
                                        @endif
                                    </div>

                                    <!-- Status Change Modal -->
                                    <div class="modal fade" id="statusModal{{$tag->id}}" tabindex="-1" aria-labelledby="statusModalLabel{{$tag->id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content shadow-lg border-0">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="statusModalLabel{{$tag->id}}">
                                                        <i class="fas fa-exchange-alt me-2"></i>স্ট্যাটাস পরিবর্তন
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center py-4">
                                                    @if($tag->status == 'active')
                                                        <div class="mb-3">
                                                            <i class="fas fa-eye-slash fa-3x text-danger"></i>
                                                        </div>
                                                        <p class="fs-5">
                                                            আপনি কি নিশ্চিত <strong class="text-primary">"{{ $tag->person_type_name }}"</strong> ক্যাটাগরিটি 
                                                            <span class="badge bg-success">দৃশ্যমান</span> অবস্থা থেকে  
                                                            <span class="badge bg-secondary">অদৃশ্য</span> করতে চান?
                                                        </p>
                                                    @else
                                                        <div class="mb-3">
                                                            <i class="fas fa-eye fa-3x text-success"></i>
                                                        </div>
                                                        <p class="fs-5">
                                                            আপনি কি নিশ্চিত <strong class="text-primary">"{{ $tag->person_type_name }}"</strong> ক্যাটাগরিটি  
                                                            <span class="badge bg-secondary">অদৃশ্য</span> অবস্থা থেকে  
                                                            <span class="badge bg-success">দৃশ্যমান</span> করতে চান?
                                                        </p>
                                                    @endif
                                                </div>
                                                <div class="modal-footer justify-content-center border-0 pt-0">
                                                    <form action="{{ route('tag.status', $tag->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success px-4">
                                                            <i class="fas fa-check me-1"></i> হ্যাঁ, পরিবর্তন করুন
                                                        </button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                                                        <i class="fas fa-times me-1"></i> বাতিল
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{$tag->id}}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-header bg-danger text-white">
                                                    <h6 class="modal-title">
                                                        <i class="fas fa-exclamation-triangle me-2"></i>ক্যাটাগরি মুছে ফেলুন
                                                    </h6>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center py-4">
                                                    <div class="mb-3">
                                                        <i class="fas fa-trash-alt fa-3x text-danger"></i>
                                                    </div>
                                                    <p class="fs-5">আপনি কি নিশ্চিতভাবে <strong class="text-danger">"{{ $tag->person_type_name }}"</strong> ক্যাটাগরিটি মুছে ফেলতে চান?</p>
                                                    <p class="text-danger mb-0">এই কাজটি পূর্বাবস্থায় ফেরানো যাবে না।</p>
                                                </div>
                                                <div class="modal-footer justify-content-center border-0">
                                                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                                                        <i class="fas fa-times me-1"></i> বাতিল
                                                    </button>
                                                    <form action="{{ route('tag.destroy', $tag->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger px-4">
                                                            <i class="fas fa-trash me-1"></i> মুছে ফেলুন
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                <p class="text-muted fs-5">কোনো ক্যাটাগরি এখনো যোগ করা হয়নি।</p>
                <a href="#" class="btn btn-success mt-2">
                    <i class="fas fa-plus me-1"></i> প্রথম ক্যাটাগরি যোগ করুন
                </a>
            </div>
        @endif
    </div>
</div>

    </div>

          

@endsection