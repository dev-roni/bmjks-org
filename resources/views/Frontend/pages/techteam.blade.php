@extends('frontend.layouts.master_layout')
@section('content') 
	<!-- Tech Team Section -->

		<section class="page-header mt-5">
			<div class="container">
				<div class="row">
					<div class="col-12 text-center">
						<h1 class="fw-bold text-dark">আমাদের টেক টিমের সদস্যরা</h1>
						<div class="border-bottom border-white border-3 mx-auto" style="width: 100px; background-color:#1A9B9F;"></div>
						<p class="mt-2 lead text-dark">ওয়েবসাইট ও প্রযুক্তি উন্নয়নে অবদান রাখা সদস্যবৃন্দ</p>
					</div>
				</div>
			</div>
		</section>

		<div class="py-4">
			<!-- Member 2 -->
			<div class="row justify-content-center p-2">
				<div class="col-12 col-lg-10">
					<div class="card shadow-lg overflow-hidden" style="border-radius: 15px; border: none; height: 20rem;">
						<div class="row g-0 h-100">
							<!-- প্রোফাইল সেকশন -->
							<div class="col-md-3 profile-section  position-relative z-1">
								<div class="d-flex flex-column align-items-center justify-content-center h-100">
									<img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=300&q=80" 
										 alt="Laravel Expert in Bangladesh - Roni Singha" class="profile-img  mb-3">
									<h4 class="fw-bold mb-1">রনি সিংহ</h4>
									<p class="mb-1">ওয়েব ডেভেলপার</p>


								</div>
							</div>

							<!-- উক্তি সেকশন -->
							<div class="col-md-9 quote-section p-4">
								<div class="d-flex flex-column h-100">
									<p class="quote-text flex-grow-1">
										ওয়েবসাইটের ফ্রন্টএন্ড ও ব্যাকএন্ড—উভয় ক্ষেত্রেই গুরুত্বপূর্ণ অবদান রেখেছেন রনি সিংহ।
										Laravel ফ্রেমওয়ার্ক ব্যবহার করে শক্তিশালী ব্যাকএন্ড তৈরি করেছেন এবং Bootstrap ব্যবহার করে
										রেসপন্সিভ ও ব্যবহারকারী-বান্ধব UI ডিজাইন করেছেন। এছাড়া ডাটাবেজ ম্যানেজমেন্ট এবং সাইটের নিরাপত্তা নিশ্চিত করতেও
										সক্রিয়ভাবে কাজ করেছেন।
									</p>
									<hr>
									<div class="d-flex flex-nowrap overflow-auto justify-content-center justify-content-lg-end gap-2 p-2 ">
										<a href="#" class="btn btn-outline-secondary rounded-circle flex-shrink-0 ">
										  <i class="fab fa-facebook-f"></i>
										</a>
										<a href="#" class="btn btn-outline-secondary rounded-circle flex-shrink-0">
										  <i class="fab fa-twitter"></i>
										</a>
										<a href="#" class="btn btn-outline-secondary rounded-circle flex-shrink-0">
										  <i class="fab fa-youtube"></i>
										</a>
										<a href="#" class="btn btn-outline-secondary rounded-circle flex-shrink-0">
										  <i class="fab fa-instagram"></i>
										</a>
									 </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Member 3 -->
			<div class="row justify-content-center p-2">
				<div class="col-12 col-lg-10">
					<div class="card shadow-lg overflow-hidden" style="border-radius: 15px; border: none; height: 20rem;">
						<div class="row g-0 h-100">
							<!-- প্রোফাইল সেকশন -->
							<div class="col-md-3 profile-section  position-relative z-1">
								<div class="d-flex flex-column align-items-center justify-content-center h-100">
									<img src="{{ asset('assets/images/amitsingha.png') }}" 
										 alt="Laravel Expert in Bangladesh - Amit Singha" class="profile-img  mb-3">
									<h4 class="fw-bold mb-1">অমিত সিংহ</h4>
									<p class="mb-1">ওয়েব ডেভেলপার</p>


								</div>
							</div>

							<!-- উক্তি সেকশন -->
							<div class="col-md-9 quote-section p-4">
								<div class="d-flex flex-column h-100">
									<p class="quote-text flex-grow-1">
										অমিত সিংহ ওয়েবসাইটের ফ্রন্টএন্ড ও ব্যাকএন্ড উভয় দিকেই অবদান রেখেছেন। Laravel ব্যবহার করে সার্ভার-সাইড লজিক ডেভেলপ করেছেন
										এবং
										Bootstrap ব্যবহার করে আধুনিক ও রেসপন্সিভ UI তৈরি করেছেন। সার্ভার কনফিগারেশন এবং পারফরম্যান্স অপ্টিমাইজেশনে গুরুত্বপূর্ণ
										অবদান রেখেছেন।
									</p>
									<hr>
									<div class="d-flex flex-nowrap overflow-auto justify-content-center justify-content-lg-end gap-2 p-2 ">
										<a href="#" class="btn btn-outline-secondary rounded-circle flex-shrink-0 ">
										  <i class="fab fa-facebook-f"></i>
										</a>
										<a href="#" class="btn btn-outline-secondary rounded-circle flex-shrink-0">
										  <i class="fab fa-twitter"></i>
										</a>
										<a href="#" class="btn btn-outline-secondary rounded-circle flex-shrink-0">
										  <i class="fab fa-youtube"></i>
										</a>
										<a href="#" class="btn btn-outline-secondary rounded-circle flex-shrink-0">
										  <i class="fab fa-instagram"></i>
										</a>
									 </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Member 3 -->
			<div class="row justify-content-center p-2">
				<div class="col-12 col-lg-10">
					<div class="card shadow-lg overflow-hidden" style="border-radius: 15px; border: none; height: 20rem;">
						<div class="row g-0 h-100">
							<!-- প্রোফাইল সেকশন -->
							<div class="col-md-3 profile-section  position-relative z-1">
								<div class="d-flex flex-column align-items-center justify-content-center h-100">
									<img src="{{ asset('assets/images/amitsingha.png') }}" 
										 alt="Laravel Expert in Bangladesh - Shyamol Singha" class="profile-img  mb-3">
									<h4 class="fw-bold mb-1">শ্যামল সিংহ</h4>
									<p class="mb-1">প্রজেক্ট ম্যানেজার</p>
								</div>
							</div>

							<!-- উক্তি সেকশন -->
							<div class="col-md-9 quote-section p-4">
								<div class="d-flex flex-column h-100">
									<p class="quote-text flex-grow-1">
										ওয়েবসাইট ডেভেলপমেন্টের পুরো কার্যক্রমের পরিকল্পনা, সমন্বয় এবং মান নিয়ন্ত্রণ করেছেন শ্যামল সিংহ। 
										তাঁর নেতৃত্বে টেক টিম নির্ধারিত সময়ের মধ্যে ওয়েবসাইটটি ডেভেলপ করা হয়েছে।
									</p>
									<hr>
									<div class="d-flex flex-nowrap overflow-auto justify-content-center justify-content-lg-end gap-2 p-2 ">
										<a href="#" class="btn btn-outline-secondary rounded-circle flex-shrink-0 ">
										  <i class="fab fa-facebook-f"></i>
										</a>
										<a href="#" class="btn btn-outline-secondary rounded-circle flex-shrink-0">
										  <i class="fab fa-twitter"></i>
										</a>
										<a href="#" class="btn btn-outline-secondary rounded-circle flex-shrink-0">
										  <i class="fab fa-youtube"></i>
										</a>
										<a href="#" class="btn btn-outline-secondary rounded-circle flex-shrink-0">
										  <i class="fab fa-instagram"></i>
										</a>
									 </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Member 4 -->
			<div class="row justify-content-center p-2">
				<div class="col-12 col-lg-10">
					<div class="card shadow-lg overflow-hidden" style="border-radius: 15px; border: none;">
						<div class="row g-0 h-100">
							<!-- উক্তি সেকশন -->
							<div class="col-md-12 p-4">
								<div class="d-flex flex-column">
									<p class="quote-text flex-grow-1">

										উত্তর গাঁও ভানুবিল গ্রামের অবস্থিত Bhanubil Freelancing Training Center একটি দক্ষতা উন্নয়নমূলক প্রতিষ্ঠান, যেখানে স্থানীয় তরুণদের আধুনিক আইটি দক্ষতায় প্রশিক্ষিত করে কর্মসংস্থানের সুযোগ সৃষ্টি করা হয়। এই কেন্দ্রের টেক টিমের সদস্য রনি সিংহ ও অমিত সিংহ এখান থেকে ওয়েব ডিজাইন ও ওয়েব ডেভেলপমেন্ট প্রশিক্ষণ গ্রহণ করেছেন। রনি সিংহ ও অমিত সিংহ তাদের অর্জিত দক্ষতাকে মনিপুরি সমাজের কল্যাণে প্রয়োগের উদ্দেশ্যে মনিপুরি সমাজের তরুণ প্রজন্মকে প্রযুক্তির সাথে যুক্ত করে মনিপুরি যুব কল্যাণ সমিতির কার্যক্রমকে ডিজিটাল প্ল্যাটফর্মে রূপান্তরিত করার লক্ষ্য নিয়ে এই ওয়েবসাইট তৈরির উদ্যোগ গ্রহণ করেন। <br><br>
										আমরা দৃঢ়ভাবে বিশ্বাস করি — প্রযুক্তি সমাজ উন্নয়নের সবচেয়ে শক্তিশালী হাতিয়ার, এবং এই ওয়েবসাইট তারই একটি অনন্য বাস্তব উদাহরণ, যা মনিপুরি সমাজকে আরও এক ধাপ এগিয়ে নেবে একটি আধুনিক, সংযুক্ত ও প্রযুক্তিনির্ভর ভবিষ্যতের পথে।
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
@endsection