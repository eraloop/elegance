<div class="testimonials">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">Client Testimonials</h3>
                    <h2 class="text-anime">What Our Client Say</h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- Testimonial Carousel Start -->
                <div class="testimonial-carousel">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            @foreach($testimonials as $testimonial)
                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <div class="testimonial-slide">
                                        <div class="testimonial-header">
                                            <div class="author-img">
                                                @if($testimonial->customer_photo)
                                                    <img src="{{ asset('storage/' . $testimonial->customer_photo) }}"
                                                        alt="{{ $testimonial->customer_name }}">
                                                @else
                                                    <img src="{{ asset('assets/images/default-avatar.jpg') }}"
                                                        alt="{{ $testimonial->customer_name }}">
                                                @endif
                                            </div>

                                            <div class="author-info">
                                                <h3>{{ $testimonial->customer_name }}</h3>
                                                <div class="rating-star">
                                                    <img src="{{ asset("assets/images/icon-rating.svg")}}" alt="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="testimonial-content">
                                            <p>{{ $testimonial->content }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Testimonial Slide End -->
                            @endforeach
                        </div>

                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <!-- Testimonial Carousel End -->
            </div>
        </div>
    </div>
</div>