    <!-- Footer -->
	<footer class="bg-dark text-white py-4">
	  <div class="container">
		<div class="row g-4 text-center text-md-start">
		  
		  <!-- যোগাযোগ -->
		  <div class="col-12 col-md-6 col-lg-4">
			<h5  class="text-accent mb-3">যোগাযোগ</h5>
			<div class="mb-2">
			  <i class="fas fa-map-marker-alt text-accent me-2"></i>
			  <span>{{ $setting->address }}</span>
			</div>
			<div class="mb-2">
			  <i  class="fas fa-phone text-accent me-2"></i>
			  <span>{{ $setting->phone_no  }}</span>
			</div>
			<div class="">
			  <i class="fas fa-envelope text-accent me-2"></i>
			  <span>{{ $setting->email }}</span>
			</div>
		  </div>

		  <!-- গুরুত্বপূর্ণ লিংক -->
		  <div class="col-12 col-md-6 col-lg-4">
			<h5  class="text-accent mb-3">গুরুত্বপূর্ণ লিংক</h5>
			<ul class="list-unstyled">
			  <li class="mb-2"><a href="{{ $setting->link_1  }}" class="text-white text-decoration-none">{{ $setting->link_name_1  }}</a></li>
			  <li class="mb-2"><a href="{{ $setting->link_2  }}" class="text-white text-decoration-none">{{ $setting->link_name_2  }}</a></li>
			  <li class="mb-2"><a href="{{ $setting->link_3  }}" class="text-white text-decoration-none">{{ $setting->link_name_3  }}</a></li>
			</ul>
		  </div>

			<!-- সামাজিক মাধ্যম -->
			<div class="col-12 col-lg-4">
			  <h5 class="text-accent mb-3">সামাজিক মাধ্যম</h5>
			  <div class="d-flex flex-nowrap overflow-auto justify-content-center justify-content-lg-start gap-2 p-2 ">
				<a href="{{ $setting->facebook_url }}" class="btn btn-outline-light rounded-circle flex-shrink-0 ">
				  <i class="fab fa-facebook-f"></i>
				</a>
				<a href="{{ $setting->twitter_url }}" class="btn btn-outline-light rounded-circle flex-shrink-0">
				  <i class="fab fa-twitter"></i>
				</a>
				<a href="{{ $setting->youtube_url }}" class="btn btn-outline-light rounded-circle flex-shrink-0">
				  <i class="fab fa-youtube"></i>
				</a>
				<a href="{{ $setting->instagram_url }}"  class="btn btn-outline-light rounded-circle flex-shrink-0">
				  <i class="fab fa-instagram"></i>
				</a>
			  </div>
			</div>


		</div>


	  </div>
	</footer>

	<!-- Font Awesome (Social Icons) -->
	<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

	     <!-- Bootstrap 5 JS -->
    <script src="{{asset('Frontend-Assets/js/bootstrap.bundle.min.js')}}"></script>
    
    <!-- Custom JS -->
	
    <script src="{{asset('Frontend-Assets/js/js.js')}}"></script>
</html> 