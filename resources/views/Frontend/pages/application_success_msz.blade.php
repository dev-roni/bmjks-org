@extends('frontend.layouts.master_layout')
@section('content') 
<section class="py-5 ">
    <div class="container">
		<section class="page-header ">
			<div class="container">
				<div class="row">
					<div class="col-12 text-center">
						<h1 class="display-4 fw-bold text-dark">Success</h1>
						<div class="border-bottom border-white border-3 mx-auto" style="width: 100px; background-color:#1A9B9F;"></div>
						<p class="mt-2 lead text-dark">
							{{$msz}}
						</p>
						
						<a class="btn btn-primary" href="{{route('home')}}"> হোমে ফিরে যান </a>
					</div>
				</div>
			</div>
		</section>
    </div>
  </section>
@endsection