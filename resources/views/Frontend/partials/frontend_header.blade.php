<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>বাংলাদেশ মণিপুরী যুব কল্যাণ সমিতি</title>
    
        <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="{{asset('Frontend-Assets/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script:400,700" rel="stylesheet" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('Frontend-Assets/css/customStyle.css')}}">

</head>
<body>
    <!-- Header Section -->
<header class="bg-fatafati text-white shadow-sm">
    <div class="container ">
        <div class="row align-items-center">

            <!-- বাম 8 কলাম: লোগো + টাইটেল -->
            <div class="col-7 col-md-8 col-lg-8 d-flex align-items-center py-2  py-md-3 py-lg-3">
                <div class="me-2 me-md-3">
                    <img src="{{asset('Frontend-Assets/images/header/logo.png')}}" 
                        alt="প্রতীক" 
                        class="img-fluid floating float-pulse" 
                        style="width: 80px; max-height: 80px;">
                </div>
                <div class="w-100 pt-2">
                    <h1 class="mb-0 fw-bold d-block d-md-none" style="font-size: 1rem;">
                        বাংলাদেশ মণিপুরী যুব কল্যাণ সমিতি
                    </h1>
                    <h1 class="mb-0 fw-bold d-none d-md-block d-lg-none" style="font-size: 1.2rem;">
                        বাংলাদেশ মণিপুরী যুব কল্যাণ সমিতি
                    </h1>
                    <h1 class="mb-0 fw-bold d-none d-lg-block" style="font-size: 1.7rem;">
                        বাংলাদেশ মণিপুরী যুব কল্যাণ সমিতি
                    </h1>
                    <p class="mb-0 opacity-75 d-block d-md-none" style="font-size: 0.7rem;">
                        শান্তি ঐক্য প্রগতি
                    </p>
                    <p class="mb-0 opacity-75 d-none d-md-block d-lg-none" style="font-size: 0.9rem;">
                        শান্তি ঐক্য প্রগতি
                    </p>
                    <p class="mb-0 opacity-75 d-none d-lg-block" style="font-size: 1.1rem;">
                        শান্তি ঐক্য প্রগতি
                    </p>
                </div>
            </div>

            <!-- ডান 5/4 কলাম: ছবি -->
            <div class="col-5 col-md-4 col-lg-4 p-0 d-flex justify-content-end position-relative" >
                <!-- ডেস্কটপ/ট্যাবলেট ইমেজ -->
                <img src="{{asset('Frontend-Assets/images/header/objectpc.png')}}" 
                     alt="সংস্কৃতি" 
                     class="img-fluid d-none d-md-block pt-3 " 
                     style="width: auto; max-height: 80px; margin-bottom: -20px; margin-right: -50px;  ">
                
                <img src="{{asset('Frontend-Assets/images/header/dakhulaleft.png')}}" 
                    alt="সংস্কৃতি" 
                    class="img-fluid d-none d-md-block pt-3 position-absolute dakhulaleft" 
                    style="width: auto; max-height: 80px; margin-bottom: -20px; margin-right: -50px; ">
                
                <img src="{{asset('Frontend-Assets/images/header/dakhularight.png')}}" 
                    alt="সংস্কৃতি" 
                    class="img-fluid d-none d-md-block pt-3 position-absolute dakhularight" 
                    style="width: auto; max-height: 80px; margin-bottom: -20px; margin-right: -50px; ">
                
                <img src="{{asset('Frontend-Assets/images/header/gopileft.png')}}" 
                    alt="সংস্কৃতি" 
                    class="img-fluid d-none d-md-block pt-3 position-absolute gopileft" 
                    style="width: auto; max-height: 80px; margin-bottom: -20px; margin-right: -50px; ">

                <img src="{{asset('Frontend-Assets/images/header/gopiright.png')}}" 
                    alt="সংস্কৃতি" 
                    class="img-fluid d-none d-md-block pt-3 position-absolute gopiright" 
                    style="width: auto; max-height: 80px; margin-bottom: -20px; margin-right: -50px; ">
                     
                <!-- মোবাইল ইমেজ -->
                <img src="{{asset('Frontend-Assets/images/header/objectmobile.png')}}" 
                     alt="সংস্কৃতি" 
                     class="img-fluid d-md-none position-absolute" 
                     style="width: auto; max-height: 50px; margin-bottom: -40px;">

                <img src="{{asset('Frontend-Assets/images/header/subjectmobile.png')}}" 
                    alt="সংস্কৃতি" 
                    class="img-fluid d-md-none dakhularight" 
                    style="width: auto; max-height: 50px; margin-bottom: -40px;">
            </div>

        </div>
    </div>
</header>