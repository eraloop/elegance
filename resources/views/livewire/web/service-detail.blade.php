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
						<h1 class="text-anime">{{ $service->name }}</h1>
					</div>
					<!-- Page Heading End -->
				</div>

				<div class="col-md-4 order-md-2 order-1">
					<!-- Page Header Right Icon Start -->
					<div class="page-header-icon-box wow fadeInUp" data-wow-delay="0.5s">
						<div class="page-header-icon">
							<img src="{{ asset("assets/images/icon-service-single.svg")}}" alt="">
						</div>
					</div>
					<!-- Page Header Right Icon End -->
				</div>
			</div>
		</div>
	</div>
	<!-- Page Header Section End -->

	<!-- Page Service Single Start -->
	<div class="page-service-single">
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<!-- Service Sidebar Start -->
					<div class="service-sidebar">
						<!-- Service List Box Start -->
						<div class="service-list-box wow fadeInUp">
							<h3>Categories</h3>
							<div class="service-list-entry">
								<ul>
									@foreach($categories as $category)
										@if($category && $category->name)
											<li><a href="#">{{ $category->name }}</a></li>
										@endif
									@endforeach
								</ul>
							</div>
						</div>
						<!-- Service List Box End -->

						<!-- Service Help Box Start -->
						<div class="service-help wow fadeInUp" data-wow-delay="0.25s">
							<div class="help-image">
								<img src="{{ asset("assets/images/help-image.jpg")}}" alt="">
							</div>

							<div class="help-content">
								<h3>Need Help? <br>Talk with Expert</h3>
								<h5>Call Anytime</h5>
								<p>{{ $company_info->phone ?? 'Contact Us' }}</p>
							</div>
						</div>
						<!-- Service Help Box End -->
					</div>
					<!-- Service Sidebar End -->
				</div>

				<div class="col-lg-8">
					<!-- Service Content Start -->
					<div class="service-content">
						<div class="service-image">
							<figure class="hover-anime">
								<img src="{{ asset('storage/' . $service->thumbnail)}}" alt="{{ $service->name }}">
							</figure>
						</div>

						<div class="service-entry">
							<h2>{{ $service->name }}</h2>

							<p>{!! nl2br(e($service->description)) !!}</p>

							<h2>Responsibilities</h2>
							<ul>
								@if($service->responsibilities)
									@foreach($service->responsibilities as $responsibility)
										<li>{{ $responsibility }}</li>
									@endforeach
								@endif
							</ul>
						</div>
					</div>
					<!-- Service Content End -->

					<!-- Service Photo Gallery Start -->
					<div class="service-photo-gallery">
						<div class="service-photo-gallery-header">
							<h2>{{ $service->name }} Photo Gallery</h2>
						</div>

						<div class="service-photo-gallery-entry service-gallery">
							@if($service->gallery)
								@foreach($service->gallery as $image)
									<div class="service-photo-item">
										<a href="{{ asset($image)}}">
											<figure class="hover-anime">
												<img src="{{ asset($image)}}" alt="">
											</figure>
										</a>
									</div>
								@endforeach
							@endif
						</div>
					</div>
					<!-- Service Photo Gallery End -->

					<!-- FAQs Start -->
					<div class="faqs">
						<div class="faq-header">
							<h2>Frequently Asked Question</h2>
						</div>

						<div class="faq-accordion">
							<div class="accordion" id="faq_accordion">
								@foreach($faqs as $index => $faq)
									<div class="accordion-item">
										<h2 class="accordion-header" id="heading{{ $index }}"><button
												class="accordion-button {{ $index != 0 ? 'collapsed' : '' }}" type="button"
												data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
												aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
												aria-controls="collapse{{ $index }}">{{ $faq->question }}</button></h2>

										<div id="collapse{{ $index }}"
											class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"
											aria-labelledby="heading{{ $index }}" data-bs-parent="#faq_accordion">
											<div class="accordion-body">
												<p>{{ $faq->answer }}</p>
											</div>
										</div>
									</div>
								@endforeach
							</div>
						</div>
					</div>
					<!-- FAQs End -->
				</div>
				
			</div>
		</div>
	</div>
	<!-- Page Service Single End -->


</div>