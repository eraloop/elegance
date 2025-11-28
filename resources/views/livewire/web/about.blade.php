<div>

	<div class="page-header">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-8 order-md-1 order-2">
					<div class="page-header-box">
						<div class="tiny-h3">
							<h3 class="wow fadeInUp"> Elegance Beauty </h3>
						</div>
						<h1 class="text-anime">About Us</h1>

					</div>

				</div>

				<div class="col-md-4 order-md-2 order-1">
					<div class="page-header-icon-box wow fadeInUp" data-wow-delay="0.50s">
						<div class="page-header-icon">
							<img src="{{ asset("assets/images/icon-about.svg")}}" alt="">
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>


	@include("components.web.about-elegance")
	<!-- About us Section End -->

	<!-- Our Goal Section Start -->
	<div class="our-goal">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- Section Title Start -->
					<div class="section-title">
						<h3 class="wow fadeInUp">Our Goal</h3>
						<h2 class="text-anime">Company Goal</h2>
					</div>
					<!-- Section Title End -->
				</div>
			</div>

			<div class="row">
				@foreach($goals as $goal)
					<div class="col-lg-4">
						<!-- Goal Item Start -->
						<div class="goal-item wow fadeInUp" data-wow-delay="0.5s">
							<div class="goal-image">
								<figure class="hover-anime">
									<img src="{{ asset('storage/' . $goal->image) }}" alt="{{ $goal->title }}">
								</figure>
							</div>

							<div class="goal-content">
								<div class="goal-icon">
									<img src="{{ asset('storage/' . $goal->icon) }}" alt="{{ $goal->title }}">
								</div>

								<h3>{{ $goal->title }}</h3>
								<p>{{ $goal->description }}</p>
							</div>
						</div>
						<!-- Goal Item End -->
					</div>
				@endforeach
			</div>
		</div>
	</div>
	<!-- Our Goal Section End -->

	<!-- Our Team Section Start -->
	<div class="our-team">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- Section Title Start -->
					<div class="section-title">
						<h3 class="wow fadeInUp">Our Team</h3>
						<h2 class="text-anime">Meet the Our Experts</h2>
					</div>
					<!-- Section Title End -->
				</div>
			</div>

			<div class="row">
				@foreach($teams as $team)
					<div class="col-lg-4">
						<!-- Team Item Start -->
						<div class="team-item wow fadeInUp" data-wow-delay="0.5s">
							<div class="team-image">
								<figure class="hover-anime">
									<img src="{{ asset('storage/' . $team->image) }}" alt="{{ $team->name }}">
								</figure>
							</div>

							<div class="team-info">
								<h3>{{ $team->name }}</h3>
								<p>({{ $team->position }})</p>
								<div class="team-social-links">
									<ul>
										<li><a href="{{ $team->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
										<li><a href="{{ $team->instagram }}"><i class="fab fa-instagram"></i></a></li>
										<li><a href="{{ $team->twitter }}"><i class="fab fa-twitter"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
						<!-- Team Item End -->
					</div>
				@endforeach
			</div>
		</div>
	</div>
	<!-- Our Team Section End -->

	<!-- Facts Section Start -->

	@include("components.web.facts&figures")

	@include("components.web.floating-booking-btn")
	<!-- Facts Section End -->

	<!-- We Use Section Start -->
	<div class="we-use">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- Section Title Start -->
					<div class="section-title">
						<h3 class="wow fadeInUp">Products We Use</h3>
						<h2 class="text-anime">Brands We Use</h2>
					</div>
					<!-- Section Title End -->
				</div>
			</div>

			<div class="row">
				@foreach($brands as $brand)
					<div class="col-md-3 col-6">
						<!-- Brand Logo Start -->
						<div class="brand-logo wow fadeInUp" data-wow-delay=".5s">
							<img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name }}">
						</div>
						<!-- Brand Logo End -->
					</div>
				@endforeach
			</div>
		</div>
	</div>
	<!-- We Use Section End -->
</div>