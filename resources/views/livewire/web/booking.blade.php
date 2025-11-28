<div>
	<div class="page-header">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-8 order-md-1 order-2">
					<div class="page-header-box">
						<div class="tiny-h3">
							<h3 class="wow fadeInUp"> Elegance Beauty </h3>
						</div>
						<h1 class="text-anime">Book an <br> Appointment</h1>
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
						<h3 class="wow fadeInUp">Appointment Form</h3>
						<h2 class="text-anime">Book a hair appointment with us.</h2>
					</div>
					<!-- Section Title End -->
				</div>
			</div>

			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="contact-form wow fadeInUp bg-primary-green " data-wow-delay="0.75s">
						@if($step === 1)
							<div class="step-1">
								<h3>Step 1: Select Service</h3>
								<div class="form-group mb-4">
									<label>Choose a Service</label>
									<select wire:model="service_id" class="form-control">
										<option value="">Select Service</option>
										@foreach($services as $service)
											<option value="{{ $service->id }}">{{ $service->name }} (${{ $service->price_min }})
											</option>
										@endforeach
									</select>
									@error('service_id') <span class="text-danger">{{ $message }}</span> @enderror
								</div>
								<button wire:click="nextStep" class="btn-default">Next</button>
							</div>
						@elseif($step === 2)
							<div class="step-2">
								<h3>Step 2: Select Date & Time</h3>
								<div class="row">
									<div class="col-md-6 form-group mb-4">
										<label>Date</label>
										<input type="date" wire:model="date" class="form-control" min="{{ date('Y-m-d') }}">
										@error('date') <span class="text-danger">{{ $message }}</span> @enderror
									</div>
									<div class="col-md-6 form-group mb-4">
										<label>Time</label>
										<input type="time" wire:model="time" class="form-control">
										@error('time') <span class="text-danger">{{ $message }}</span> @enderror
									</div>
								</div>
								<button wire:click="prevStep" class="btn-default">Back</button>
								<button wire:click="nextStep" class="btn-default">Next</button>
							</div>
						@elseif($step === 3)
							<div class="step-3">
								<h3>Step 3: Your Details</h3>
								<div class="row">
									<div class="col-md-6 form-group mb-4">
										<input type="text" wire:model="name" class="form-control" placeholder="Name">
										@error('name') <span class="text-danger">{{ $message }}</span> @enderror
									</div>
									<div class="col-md-6 form-group mb-4">
										<input type="email" wire:model="email" class="form-control" placeholder="Email">
										@error('email') <span class="text-danger">{{ $message }}</span> @enderror
									</div>
									<div class="col-md-6 form-group mb-4">
										<input type="text" wire:model="phone" class="form-control" placeholder="Phone">
										@error('phone') <span class="text-danger">{{ $message }}</span> @enderror
									</div>
									<div class="col-md-12 form-group mb-4">
										<textarea wire:model="notes" class="form-control" rows="4"
											placeholder="Special Requests (Optional)"></textarea>
									</div>
								</div>
								<button wire:click="prevStep" class="btn-default">Back</button>
								<button wire:click="submit" class="btn-default">Confirm Booking</button>
							</div>
						@elseif($step === 4)
							<div class="step-4 text-center">
								<div class="success-icon mb-4">
									<img src="{{ asset('assets/images/icon-check.svg') }}" alt="Success"
										style="width: 80px;">
								</div>
								<h3>Booking Confirmed!</h3>
								<p>Thank you, {{ $name }}. Your appointment has been scheduled.</p>
								<a href="{{ route('web.index') }}" class="btn-default mt-3">Back to Home</a>
							</div>
						@endif
					</div>
					<!-- Contact Form end -->
				</div>
			</div>
		</div>
	</div>


</div>