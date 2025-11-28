<!DOCTYPE html>
<html lang="zxx">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>@yield('title', 'Elegance - Hair, Nails, Wig Installations & Revamps')</title>

	<meta name="description"
		content="@yield('description', 'Elegance Beauty Salon offers premium hair and beauty services, including nail care, wig installations, wig revamps, makeup, and all beauty treatments. Experience luxury and excellence in every service.')">
	<meta name="keywords"
		content="@yield('keywords', 'beauty salon, hair salon, nails, wig installations, wig revamp, makeup, beauty services, professional hairstyling, luxury salon, hair extensions')">
	<meta name="author" content="Elegance Beauty Salon">

	<meta property="og:title"
		content="@yield('title', 'Elegance Beauty Salon - Hair, Nails, Wig Installations & Revamps')">
	<meta property="og:description"
		content="@yield('description', 'Looking for a luxury beauty salon? We specialize in hair, nails, wig revamps, installations, and more. Book your appointment today!')">
	<meta property="og:image" content="@yield('og_image', asset('assets/images/hero-img.jpg'))">
	<meta property="og:type" content="website">
	<meta property="og:url" content="{{ url()->current() }}">

	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title"
		content="@yield('title', 'Elegance Beauty Salon - Hair, Nails, Wig Installations & Revamps')">
	<meta name="twitter:description"
		content="@yield('description', 'From nails to wig revamps, Elegance Beauty Salon offers expert beauty services. Visit us for the best in luxury hair and beauty.')">
	<meta name="twitter:image" content="@yield('og_image', asset('assets/images/hero-img.jpg'))">

	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}">
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&amp;family=Hanken+Grotesk:wght@400;500;600;700&amp;display=swap"
		rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
		integrity="sha512-dP5C6W4Aw3yDdc0AGJi/7/0GINuD/7/UZ5E2osFVJeFt3PcTJS3BM4tiTqcKoy0eZZ+j9RnBbTK1ZBOqVakiQg=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/slicknav.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/swiper-bundle.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/all.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/magnific-popup.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/premium-enhancements.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/flaticon.css') }}" rel="stylesheet">


	@yield('css')
	@livewireStyles

</head>


<body class="tt-magic-cursor">

	<div class="preloader">
		<div class="loading-container">
			<div class="loading"></div>
			<div id="loading-icon"><img src="{{ asset('assets/images/loader.svg') }}" alt=""></div>
		</div>
	</div>

	<div id="magic-cursor">
		<div id="ball"></div>
	</div>

	<div>

		<header class="main-header">
			<div class="header-sticky">
				<nav class="navbar navbar-expand-lg">
					<div class="container">

						<a class="navbar-brand" href="{{ route("web.index")}}">
							<h1 class="text-anime text-white">Elegance.</h1>
						</a>

						<div class="collapse navbar-collapse main-menu">
							<ul class="navbar-nav mr-auto" id="menu">
								<li class="nav-item"><a class="nav-link" href="{{ route("web.index")}}">Home</a></li>
								<li class="nav-item"><a class="nav-link" href="{{ route("web.about")}}">About us</a>
								</li>
								<li class="nav-item"><a class="nav-link" href="{{ route("web.services")}}">Services</a>
								</li>
								<li class="nav-item"><a class="nav-link" href="{{ route("web.pricing")}}">Pricing</a>
								</li>
								<li class="nav-item"><a class="nav-link" href="{{ route("web.faq")}}">FAQ</a></li>
								<li class="nav-item"><a class="nav-link" href="{{ route("web.contact")}}">Contact</a>
								</li>
								<li class="nav-item highlighted-menu"><a class="nav-link"
										href="{{ route("web.booking")}}">Book Now</a></li>
							</ul>
						</div>

						<div class="navbar-toggle"></div>
					</div>
				</nav>

				<div class="responsive-menu"></div>
			</div>
		</header>


		{{ $slot ?? '' }}

		<!-- Footer Start -->
		<footer class="footer">
			<!-- Footer Contact Information Section Start -->
			<div class="footer-contact-information">
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							<!-- Footer Contact Info Box Start -->
							<div class="contact-info-item wow fadeInUp">
								<div class="icon-box">
									<img src="{{ asset("assets/images/icon-location.svg")}}" alt="">
								</div>

								<h3>Our Location</h3>
								<p>{{ $company_info->address ?? 'Address not available' }}</p>
							</div>
							<!-- Footer Contact Info Box End -->
						</div>

						<div class="col-md-4">
							<!-- Footer Contact Info Box Start -->
							<div class="contact-info-item wow fadeInUp" data-wow-delay="0.25s">
								<div class="icon-box">
									<img src="{{ asset("assets/images/icon-email-phone.svg")}}" alt="">
								</div>

								<h3>Get in Touch</h3>
								<p>Phone: {{ $company_info->phone ?? '' }} <br>Email: {{ $company_info->email ?? '' }}
								</p>
							</div>
							<!-- Footer Contact Info Box End -->
						</div>

						<div class="col-md-4">
							<!-- Footer Contact Info Box Start -->
							<div class="contact-info-item wow fadeInUp" data-wow-delay="0.5s">
								<div class="icon-box">
									<img src="{{ asset("assets/images/icon-working-hours.svg")}}" alt="">
								</div>

								<h3>Working Hours</h3>
								<p>{!! nl2br(e($company_info->working_hours ?? 'Mon-Fri: 10:00 AM - 9:00 PM')) !!}</p>
							</div>
							<!-- Footer Contact Info Box End -->
						</div>
					</div>
				</div>
			</div>
			<!-- Footer Contact Information Section End -->

			<!-- Main Footer Start -->
			<div class="footer-main">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-5">
							<!-- Footer Logo Start -->
							<div class="footer-logo">
								<h1 class="text-anime text-white">Elegance.</h1>
							</div>
							<!-- Footer Logo End -->

							<!-- Footer Social Icons Start -->
							<div class="footer-social">
								<ul>
									@if($company_info->facebook)
										<li><a href="{{ $company_info->facebook }}"><i class="fab fa-facebook-f"></i></a>
									</li> @endif
									@if($company_info->instagram)
										<li><a href="{{ $company_info->instagram }}"><i class="fab fa-instagram"></i></a>
									</li> @endif
									@if($company_info->twitter)
										<li><a href="{{ $company_info->twitter }}"><i class="fab fa-twitter"></i></a></li>
									@endif
									@if($company_info->linkedin)
										<li><a href="{{ $company_info->linkedin }}"><i class="fab fa-linkedin-in"></i></a>
									</li> @endif
								</ul>
							</div>
							<!-- Footer Social Icons End -->
						</div>

						<div class="col-lg-7">
							<!-- Footer Menu Start -->
							<div class="footer-menu">
								<ul>
									<li><a href="{{ route("web.index")}}">Home</a></li>
									<li><a href="{{ route("web.about")}}">About Us</a></li>
									<li><a href="{{ route("web.pricing")}}">Pricing</a></li>
									{{-- <li><a href="{{ route(" web.service")}}"> Services</a></li> --}}
									<li><a href="{{ route("web.faq")}}">FAQ</a></li>
									<li><a href="{{ route("web.contact")}}">Contact Us</a></li>

								</ul>
							</div>
							<!-- Footer Menu End -->

							<!-- Footer Copyright Start -->
							<div class="copyright">
								<p>Copyright &copy; <span id="currentYear"></span> Elegance. All Rights Reserved.</p>
							</div>

							<script>
								document.getElementById('currentYear').textContent = new Date().getFullYear();
							</script>
							<!-- Footer Copyright End -->
						</div>
					</div>
				</div>
			</div>
			<!-- Main Footer End -->
		</footer>
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