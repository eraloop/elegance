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
						<h1 class="text-anime">Our Pricing</h1>
					</div>
					<!-- Page Heading End -->
				</div>

				<div class="col-md-4 order-md-2 order-1">
					<!-- Page Header Right Icon Start -->
					<div class="page-header-icon-box wow fadeInUp" data-wow-delay="0.50s">
						<div class="page-header-icon">
							<img src="images/icon-pricing.svg" alt="">
						</div>
					</div>
					<!-- Page Header Right Icon End -->
				</div>
			</div>
		</div>
	</div>
	<!-- Page Header Section End -->

	<!-- Page Pricing Start -->
	<div class="page-pricing">
		<div class="container">
			<div class="row">
				<div class="row">
					@foreach($services as $service)
						<div class="col-lg-4 col-md-6">
							<!-- Pricing Item Start -->
							<div class="pricing-item wow fadeInUp">
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
	</div>
	<!-- Page Pricing End -->


	@include("components.web.gifts&promotions")

	<!-- Testimonials Section Start -->
	@include("components.web.client-testimonials")

	@include("components.web.floating-booking-btn")
</div>