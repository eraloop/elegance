<div>
	<!-- Page Header Section Start -->
	<div class="page-header">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-8 order-md-1 order-2">
					<!-- Page Heading Start -->
					<div class="page-header-box">
						<div class="tiny-h3">
							<h3 class="wow fadeInUp"> Elegance Beauty </h3>
						</div>
						<h1 class="text-anime">Our Services</h1>
					</div>
					<!-- Page Heading End -->
				</div>

				<div class="col-md-4 order-md-2 order-1">
					<!-- Page Header Right Icon Start -->
					<div class="page-header-icon-box wow fadeInUp" data-wow-delay="0.5s">
						<div class="page-header-icon">
							<img src="{{ asset("assets/images/icon-services.svg")}}" alt="">
						</div>
					</div>
					<!-- Page Header Right Icon End -->
				</div>
			</div>
		</div>
	</div>
	<!-- Page Header Section End -->

	<!-- Services Lists Start -->
	<div class="services-lists">
		<div class="container">
			<div class="row">
				@foreach($services as $service)
					<div class="col-lg-4 col-md-6">
						<!-- Service Item Start -->
						<div class="service-item-layout2 wow fadeInUp">
							<div class="service-image">
								<figure class="hover-anime">
									<img src="{{ asset('storage/' . $service->thumbnail) }}" alt="{{ $service->name }}">
								</figure>
							</div>

							<div class="service-content">
								<h3>{{ $service->name }}</h3>
								<p>{{ Str::limit($service->short_description, 100) }}</p>
								<a href="{{ route('web.service.details', $service->slug) }}" class="service-readmore">Read
									More</a>
							</div>
						</div>
						<!-- Service Item End -->
					</div>
				@endforeach
			</div>
		</div>
	</div>
	<!-- Services Lists End -->


	@include("components.web.gifts&promotions")

	<!-- Testimonials Section Start -->
	@include("components.web.client-testimonials")

	@include("components.web.floating-booking-btn")
</div>