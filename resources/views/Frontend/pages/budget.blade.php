@extends('frontend.layouts.master_layout')
@section('content')

  <!-- Budget Section -->
  <section class="page-header mt-5 mb-4">
    <div class="container">
      <div class="row mb-3">
        <div class="col-12 text-center">
          <h1 class="fw-bold text-dark">বাজেট</h1>
          <div class="border-bottom border-white border-3 mx-auto" style="width: 100px; background-color:#1A9B9F;"></div>
        </div>
      </div>

      <div class="row align-items-center">
        <!-- Left: Search Bar -->
        <div class="col-md-4 col-sm-12 mb-2 mb-md-0">
          <form action="{{ route('budget.search') }}" method="get">
            @csrf
            <div class="input-group">
              <input type="text" name="search" class="form-control" value="{{ request()->search }}"
                placeholder="বাজেটের নাম লিখুন..." aria-label="Search">
              <button class="btn btn-primary" type="submit" name="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
            @error('search')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
          </form>
        </div>

        <!-- Center: Subtitle -->
        <div class="col-md-4 col-sm-12 text-md-center text-start">
          <p class="lead fw-semibold text-dark mb-0">বার্ষিক ও বিভিন্ন বাজেট</p>
        </div>

        <!-- Right: Empty or future content -->
        <div class="col-md-4"></div>
      </div>
    </div>
  </section>

  <!-- বাজেট List -->
  <section class="py-2">
    <div class="container px-5">
      @if($budgets->isNotEmpty())
        @foreach($budgets as $budget)
          <div class="notice-card mb-4" data-category="urgent" data-year="2024">
            <div class="notice-header urgent">
              <div class="d-flex align-items-center">
                <div class="notice-icon urgent me-3">
                  <i class="fas fa-coins me-2"></i>
                </div>
                <div class="flex-grow-1">
                  <h5 class="mb-1 fw-bold text-dark">{{ $budget->title }}</h5>
                  <div class="notice-meta">
                    <span class="text-muted">
                      <i class="fas fa-calendar me-1"></i>
                      @bn($budget->date)
                    </span>
                  </div>
                </div>
                <div class="notice-actions">
                  <a href="{{ route('budget.download', $budget->pdf_path) }}" class="btn btn-sm btn-outline-warning" title="ডাউনলোড">
                    <i class="fa-solid fa-download"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      @else
        @if(Route::is('budget.search'))
          <div class="alert alert-danger text-center fw-semibold">
            দুঃখিত, আপনার অনুসন্ধানের সাথে মিলে এমন কোনো বাজেট পাওয়া যায়নি।
          </div>
        @else
          <div class="alert alert-success text-center fw-semibold">
            বর্তমানে কোনো বাজেট উপলভ্য নেই।
          </div>
        @endif
      @endif

      {{ $budgets->links() }}
    </div>
  </section>

@endsection