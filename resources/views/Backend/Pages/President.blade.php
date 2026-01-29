@extends('Backend.Layout.MasterLayout')

@section('Content')

    <div class=" mt-3 d-flex justify-content-center">
        <div class="card shadow-sm" style="width: 40rem;">
            <div class="card-header text-white bg-success text-center">
                <i class="fas fa-user-tie"></i> সভাপতির বার্তা
            </div>
            <div class="card-body px-4">
                <form action="{{ route('president.update',$president->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-12">
                                
                            <label class="form-label @error('photo') text-danger @enderror">
                                @error('photo')
                                    {{ $message }}
                                @else
                                    সভাপতির ফটো
                                @enderror
                            </label>
                            <input type="file" name="photo" class="form-control" accept="image/png">
                        </div>
                        <div class="col-md-2 ms-4">
                            @if(!empty($president->photo))
                            <img src="{{ asset('uploads/president/' . $president->photo) }}" 
                                alt="সভাপতির ফটো" 
                                class="img-thumbnail" 
                                width="100">
                            @endif
                        </div>
                        <div class="col-md-12">
                            <label class="form-label  @error('name') text-danger @enderror">
                                 @error('name')
                                    {{ $message }}
                                @else
                                    সভাপতির নাম
                                @enderror
                            </label>
                            <input type="text" name="name" placeholder="সভাপতির নাম (বাংলায়)" class="form-control" value="{{ old('name', $president->name ?? '') }}"  required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label @error('message') text-danger @enderror">
                                @error('message')
                                    {{ $message }}
                                @else
                                    সভাপতির বার্তা
                                @enderror
                            </label>
                            <textarea type="text" name="message" class="form-control">{{$president->message}}</textarea>
                        </div>

                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" name="submit" class="btn btn-success">
                            <i class="fa-solid fa-save me-1"></i>বার্তা আপডেট
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection