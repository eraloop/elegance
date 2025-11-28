<div>

	<div class="hero">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6">

					<div class="hero-content">
						<div class="section-title">
							<h3 class="wow fadeInUp">{{ $hero->title }}</h3>
							<h1 class="text-anime">{{ $hero->subtitle }}</h1>
						</div>
						<div class="hero-content-body wow fadeInUp" data-wow-delay="0.5s">
							<p class="text-white">{{ $hero->description }}</p>
							<ul>
								<li class="text-white">01. Get Hair Style You Deserve</li>
								<li class="text-white">02. Perfect Hair Style</li>
							</ul>
						</div>

						<div class="hero-content-footer wow fadeInUp" data-wow-delay="0.75s">
							@if($hero->button_text)
								<a href="{{ $hero->button_link }}" class="btn-default dark-bg">{{ $hero->button_text }}</a>
							@endif
							@if($hero->secondary_button_text)
								<a href="{{ $hero->secondary_button_link }}"
									class="btn-default dark-bg">{{ $hero->secondary_button_text }}</a>
							@endif

							<!-- Trust Badges -->
							<div class="trust-badges wow fadeInUp" data-wow-delay="1s">
								<div class="trust-badge">
									<i class="fas fa-star"></i>
									<span>500+ Happy Clients</span>
								</div>
								<div class="trust-badge">
									<i class="fas fa-award"></i>
									<span>15+ Years Experience</span>
								</div>
								<div class="trust-badge">
									<i class="fas fa-certificate"></i>
									<span>Licensed Professionals</span>
								</div>
							</div>
						</div>

					</div>

				</div>

				<div class="col-lg-6">

					<div class="hero-image wow fadeInUp" data-wow-delay="0.75s">
						<figure class="hover-anime">
							@if($hero && $hero->image)
								<img src="{{ asset('storage/' . $hero->image) }}" alt="{{ $hero->title }}">
							@else
								<img src="{{ asset('assets/images/hero-img.jpg') }}" alt="Hero Image">
							@endif
						</figure>
					</div>

				</div>
			</div>


			<div class="row">
				<div class="col-md-12 scrollsp">
					<a href="#aboutus" class="scroll-down"><span></span></a>
				</div>
			</div>
		</div>
	</div>
	<!-- Hero Section End -->

	<!-- Features Ticker Section Start -->
	<div class="features-ticker">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<!-- Features Ticker Start -->
					<div class="feature-ticker-box">
						<div class="feature-ticker-content">
							<ul>
								@foreach($features as $feature)
									<li><img src="{{ asset("assets/images/ticker-icon.svg") }}" alt=""> {{ $feature->name }}
									</li>
								@endforeach
							</ul>
						</div>

						<div class="feature-ticker-content">
							<ul>
								@foreach($features as $feature)
									<li><img src="{{ asset("assets/images/ticker-icon.svg") }}" alt=""> {{ $feature->name }}
									</li>
								@endforeach
							</ul>
						</div>

					</div>
					<!-- Features Ticker End -->
				</div>
			</div>
		</div>
	</div>
	<!-- Features Ticker Section End -->

	@include("components.web.about-elegance")
	<!-- Homer Services Section Start -->

	<div class="home-services">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- Section Title Start -->
					<div class="section-title">
						<h3 class="wow fadeInUp">Professional Services</h3>
						<h2 class="text-anime">We are Expert in</h2>
					</div>
					<!-- Section Title End -->
				</div>
			</div>

			<div class="row">
				@foreach($featured_services as $service)
					<div class="col-md-4">
						<!-- Service Item Start -->
						<div class="service-item-layout1 wow fadeInUp" data-wow-delay="0.5s">
							<div class="service-icon">
								@if($service->thumbnail)
									<img src="{{ asset('storage/' . $service->thumbnail) }}" alt="{{ $service->name }}">
								@else
									<img src="{{ asset('assets/images/service-1.svg') }}" alt="{{ $service->name }}">
								@endif
							</div>

							<h3>{{ $service->name }}</h3>
							<p>{{ Str::limit($service->short_description, 100) }}</p>
						</div>
						<!-- Service Item End -->
					</div>
				@endforeach
			</div>
		</div>
	</div>
	<!-- Homer Services Section End -->

	<!-- Why Choose us Section Start -->
	<div class="why-choose-us">
		<div class="container">
			<div class="row align-items-center flex-column-reverse flex-lg-row">
				<div class="col-lg-6">
					<!-- Section Title Start -->
					<div class="section-title">
						<h3 class="wow fadeInUp">{{ $company_info->why_choose_us_title ?? 'Why Choose us ?' }}</h3>
						<h2 class="text-anime">
							{{ $company_info->why_choose_us_subtitle ?? 'Are you Ready to Make a Big Change?' }}</h2>
					</div>
					<!-- Section Title End -->

					<!-- Whyus Content Start  -->
					<div class="whyus-content">
						@foreach($why_choose_us as $item)
							<!-- Whyus Item Start -->
							<div class="whyus-feature-item wow fadeInUp" data-wow-delay="0.5s">
								<div class="whyus-icon">
									<img src="{{ asset("assets/images/whyus-1.svg")}}" alt="">
								</div>

								<div class="whyus-desc">
									<h3>{{ $item->title }}</h3>
									<p>{{ $item->description }}</p>
								</div>
							</div>
							<!-- Whyus Item End -->
						@endforeach
					</div>
					<!-- Whyus Content End  -->
				</div>
				<div class="col-lg-6">
					<!-- Video Start -->
					<div class="why-choose-us-video">
						@if($company_info && $company_info->video_file)
							<!-- Uploaded Video File -->
							<video 
								controls 
								@if($company_info->video_image) poster="{{ asset('storage/' . $company_info->video_image) }}" @endif
								style="width: 100%; border-radius: 10px;" 
								class="wow fadeInUp">
								<source src="{{ asset('storage/' . $company_info->video_file) }}" type="video/mp4">
								Your browser does not support the video tag.
							</video>
						@elseif($company_info && $company_info->video_url)
							<!-- YouTube/Vimeo Embed -->
							<div class="video-image">
								<figure class="hover-anime">
									<img src="{{ $company_info->video_image ? asset('storage/' . $company_info->video_image) : asset('assets/images/video-image.jpg') }}" alt="">
								</figure>
							</div>
							<div class="video-play-button">
								<a href="{{ $company_info->video_url }}" class="popup-video">
									<img src="{{ asset("assets/images/play.svg")}}" alt="">
								</a>
							</div>
						@else
							<!-- Default Fallback -->
							<div class="video-image">
								<figure class="hover-anime">
									<img src="{{ asset('assets/images/video-image.jpg') }}" alt="">
								</figure>
							</div>
							<div class="video-play-button">
								<a href="https://www.youtube.com/watch?v=2JNMGesMC2Y" class="popup-video">
									<img src="{{ asset("assets/images/play.svg")}}" alt="">
								</a>
							</div>
						@endif
					</div>
					<!-- Video End -->
				</div>
			</div>
		</div>
	</div>
	<!-- Why Choose us Section End -->

	<!-- Facts Section Start -->
	@include("components.web.facts&figures")
	<!-- Facts Section End -->

	<!-- Photo Gallery Section Start -->
	<div class="photo-gallery">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<!-- Section Title Start -->
					<div class="section-title">
						<h3 class="wow fadeInUp">Photo Gallery</h3>
						<h2 class="text-anime">Inside Look at Our Salon</h2>
					</div>
					<!-- Section Title End -->
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="photo-gallery-ticker">
						<!-- Photo Gallery Images Start -->
						<div class="photo-gallery-content">
							@foreach($gallery_images as $image)
								<div class="photo-gallery-item">
									<figure class="hover-anime">
										<img src="{{ asset('storage/' . $image->image_path) }}"
											alt="{{ $image->title ?? '' }}">
									</figure>
								</div>
							@endforeach
						</div>

						<div class="photo-gallery-content">
							@foreach($gallery_images as $image)
								<div class="photo-gallery-item">
									<figure class="hover-anime">
										<img src="{{ asset('storage/' . $image->image_path) }}"
											alt="{{ $image->title ?? '' }}">
									</figure>
								</div>
							@endforeach
						</div>
						<!-- Photo Gallery Images End -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Photo Gallery Section End -->

	<!-- Pricing Section Start -->
	<div class="pricing">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- Section Title Start -->
					<div class="section-title">
						<h3 class="wow fadeInUp">Price List</h3>
						<h2 class="text-anime">Our Best Prices</h2>
					</div>
					<!-- Section Title End -->
				</div>
			</div>

			<div class="row">
				@foreach($pricing_services as $service)
					<div class="col-lg-4 col-md-6">
						<!-- Pricing Item Start -->
						<div class="pricing-item wow fadeInUp" data-wow-delay="0.50s">
							<div class="pricing-info">
								<h3>{{ $service->name }}</h3>
								<p>{{ Str::limit($service->short_description, 50) }}</p>
							</div>

							<div class="pricing-price">
								<p>${{ number_format($service->price_min, 0) }}</p>
							</div>
						</div>
						<!-- Pricing Item End -->
					</div>
				@endforeach
			</div>
		</div>
	</div>
	<!-- Pricing Section End -->

	@include("components.web.gifts&promotions")

	<!-- Testimonials Section Start -->
	@include("components.web.client-testimonials")

	<!-- Floating Booking Button -->
	<div class="floating-booking-btn" id="floatingBookingBtn">
		<a href="{{ route('web.booking') }}" class="btn-default">
			<i class="fas fa-calendar-check"></i> Book Now
		</a>
	</div>

	<script>
		// Show/hide floating booking button on scroll
		window.addEventListener('scroll', function () {
			const floatingBtn = document.getElementById('floatingBookingBtn');
			if (window.scrollY > 500) {
				floatingBtn.classList.add('visible');
			} else {
				floatingBtn.classList.remove('visible');
			}
		});	</script>

</div>