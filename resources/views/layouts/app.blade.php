<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Elegance - Hair, Nails, Wig Installations & Revamps</title>
    
    <meta name="description" content="Elegance Beauty Salon offers premium hair and beauty services, including nail care, wig installations, wig revamps, makeup, and all beauty treatments. Experience luxury and excellence in every service.">
    <meta name="keywords" content="beauty salon, hair salon, nails, wig installations, wig revamp, makeup, beauty services, professional hairstyling, luxury salon, hair extensions">
    <meta name="author" content="Elegance Beauty Salon">
    
    <meta property="og:title" content="Elegance Beauty Salon - Hair, Nails, Wig Installations & Revamps">
    <meta property="og:description" content="Looking for a luxury beauty salon? We specialize in hair, nails, wig revamps, installations, and more. Book your appointment today!">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Elegance Beauty Salon - Hair, Nails, Wig Installations & Revamps">
    <meta name="twitter:description" content="From nails to wig revamps, Elegance Beauty Salon offers expert beauty services. Visit us for the best in luxury hair and beauty.">
    <meta name="twitter:image" content="{{ asset('images/og-image.jpg') }}">
    
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&amp;family=Hanken+Grotesk:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
    
    
    <link rel="stylesheet" href="{{ asset('webfonts/fa-brands-400.html') }}">
    <link rel="stylesheet" href="{{ asset('webfonts/fa-regular-400.html') }}">
    <link rel="stylesheet" href="{{ asset('webfonts/fa-solid-900.html') }}">


    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/slicknav.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <link href="{{ asset('assets/css/all.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/slicknav.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/swiper-bundle.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/flaticon.css') }}" rel="stylesheet" media="screen">
    

    @yield('css')
    @livewireStyles

</head>


<body class="tt-magic-cursor">

	<div class="preloader">
		<div class="loading-container">
			<div class="loading"></div>
			<div id="loading-icon"><img src="images/loader.svg" alt=""></div>
		</div>
	</div>

	<div id="magic-cursor">
		<div id="ball"></div>
	</div>
	
    <div>
        {{ $slot ?? '' }}
    </div>

    @livewireScripts
    @yield('javascript')


	<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/validator.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/SmoothScroll.js') }}"></script>
    <script src="{{ asset('assets/js/gsap.min.js') }}"></script>
    <script src="{{ asset('assets/js/magiccursor.js') }}"></script>
    <script src="{{ asset('assets/js/splitType.js') }}"></script>
    <script src="{{ asset('assets/js/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.js') }}"></script>
    <script src="{{ asset('assets/js/function.js') }}"></script>

    
</body>

</html>