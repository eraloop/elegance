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
						<h1 class="text-anime">FAQ's</h1>
					</div>
					<!-- Page Heading End -->
				</div>

				<div class="col-md-4 order-md-2 order-1">
					<!-- Page Header Right Icon Start -->
					<div class="page-header-icon-box wow fadeInUp" data-wow-delay="0.5s">
						<div class="page-header-icon">
							<img src="{{ asset("assets/images/icon-faq.svg")}}" alt="">
						</div>
					</div>
					<!-- Page Header Right Icon End -->
				</div>
			</div>
		</div>
	</div>
	<!-- Page Header Section End -->

	<!-- Page FAQs Start -->
	<div class="page-faqs">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<!-- FAQ Accordion Start -->
					<div class="faq-accordion">
						<div class="accordion" id="faq_accordion">
							@foreach($faqs as $index => $faq)
								<!-- FAQ Item Start -->
								<div class="accordion-item wow fadeInUp" data-wow-delay="{{ $index * 0.1 }}s">
									<h2 class="accordion-header" id="heading{{ $faq->id }}">
										<button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button"
											data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}"
											aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
											aria-controls="collapse{{ $faq->id }}">
											{{ $faq->question }}
										</button>
									</h2>

									<div id="collapse{{ $faq->id }}"
										class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
										aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#faq_accordion">
										<div class="accordion-body">
											<p>{{ $faq->answer }}</p>
										</div>
									</div>
								</div>
								<!-- FAQ Item End -->
							@endforeach
						</div>
					</div>
					<!-- FAQ Accordion End -->

					@include("components.web.floating-booking-btn")
				</div>
			</div>
		</div>
	</div>
	<!-- Page FAQs End -->


</div>