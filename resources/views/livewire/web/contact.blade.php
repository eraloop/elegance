<div>
	<!-- Page Header Section Start -->
	<div class="page-header">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-8 order-md-1 order-2">
					<div class="page-header-box">
						<div class="tiny-h3">
							<h3 class="wow fadeInUp"> Elegance Beauty </h3>
						</div>
						<h1 class="text-anime">Contact Us</h1>

					</div>
				</div>

				<div class="col-md-4 order-md-2 order-1">
					<div class="page-header-icon-box wow fadeInUp" data-wow-delay="0.5s">
						<div class="page-header-icon">
							<img src="{{ asset("assets/images/icon-contact.svg") }}" alt="">
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- Page Header Section End -->

	<!-- Contact Information Section Start -->
	<div class="contact-information">
		<div class="container">
			<div class="row justify-content-center align-items-center ">
				<div class="col-lg-3 col-md-6">
					<!-- Contact Box Start -->
					<div class="contact-box wow fadeInUp">
						<div class="icon-box">
							<img src="{{ asset("assets/images/icon-address.svg") }}" alt="">
						</div>

						<h3>Address</h3>
						<p>{!! nl2br(e($company_info->address)) !!}</p>
					</div>
					<!-- Contact Box End -->
				</div>

				<div class="col-lg-3 col-md-6">
					<!-- Contact Box Start -->
					<div class="contact-box wow fadeInUp" data-wow-delay="0.25s">
						<div class="icon-box">
							<img src="{{ asset("assets/images/icon-phone.svg")}}" alt="">
						</div>

						<h3>Phone</h3>
						<p>{{ $company_info->phone }}</p>
					</div>
					<!-- Contact Box End -->
				</div>

				<div class="col-lg-3 col-md-6">
					<!-- Contact Box Start -->
					<div class="contact-box wow fadeInUp" data-wow-delay="0.75s">
						<div class="icon-box">
							<img src="{{ asset("assets/images/icon-email.svg") }}" alt="">
						</div>

						<h3>Email</h3>
						<p>{{ $company_info->email }}</p>
					</div>
					<!-- Contact Box End -->
				</div>
			</div>
		</div>
	</div>
	<!-- Contact Information Section End -->

	<!-- Get In Touch Section Start -->
	<div class="get-in-touch">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- Section Title Start -->
					<div class="section-title">
						<h3 class="wow fadeInUp">Contact Form</h3>
						<h2 class="text-anime">Get In Touch With Us</h2>
					</div>
					<!-- Section Title End -->
				</div>
			</div>

			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="contact-form wow fadeInUp bg-primary-green " data-wow-delay="0.75s">
						@if (session()->has('message'))
							<div class="alert alert-success">
								{{ session('message') }}
							</div>
						@endif
						<form wire:submit.prevent="submit" id="contactForm" data-toggle="validator">
							<div class="row">
								<div class="form-group col-md-6 mb-4">
									<input type="text" wire:model="name" class="form-control" id="name"
										placeholder="Name">
									@error('name') <span class="text-danger">{{ $message }}</span> @enderror
								</div>

								<div class="form-group col-md-6 mb-4">
									<input type="email" wire:model="email" class="form-control" id="email"
										placeholder="Email">
									@error('email') <span class="text-danger">{{ $message }}</span> @enderror
								</div>

								<div class="form-group col-md-6 mb-4">
									<input type="text" wire:model="phone" class="form-control" id="phone"
										placeholder="Phone">
									@error('phone') <span class="text-danger">{{ $message }}</span> @enderror
								</div>

								<div class="form-group col-md-6 mb-4">
									<input type="text" wire:model="subject" class="form-control" id="subject"
										placeholder="Subject">
									@error('subject') <span class="text-danger">{{ $message }}</span> @enderror
								</div>

								<div class="form-group col-md-12 mb-4">
									<textarea wire:model="msg" class="form-control" id="msg" rows="4"
										placeholder="Write a Message"></textarea>
									@error('msg') <span class="text-danger">{{ $message }}</span> @enderror
								</div>

								<div class="col-md-12 text-center">
									<button type="submit" class="btn-default">Submit Now</button>
									<div id="msgSubmit" class="h3 text-left hidden"></div>
								</div>
							</div>
						</form>
					</div>
					<!-- Contact Form end -->
				</div>
			</div>
		</div>
	</div>
	<!-- Get In Touch Section End -->

	<!-- Google Map Start -->
	<div class="google-map">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="google-map-iframe">
						<iframe
							src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d115295.63487487636!2d78.4483918264236!3d25.43864500078133!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30635ff06b92b791%3A0xd78c4fa1854213a6!2sIndia!5e0!3m2!1sen!2sin!4v1703825451377!5m2!1sen!2sin"
							width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
							referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Google Map End -->

	@include("components.web.floating-booking-btn")
</div>