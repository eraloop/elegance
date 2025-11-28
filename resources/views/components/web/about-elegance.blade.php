<!-- About us Section Start -->
<div class="about-us-section" id="aboutus">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <!-- About Left Image Start -->
                <div class="about-image">
                    <div class="row">
                        <div class="col-7">
                            <div class="about-img right-shape">
                                <figure class="reveal hover-anime">
                                    <img src="{{ asset('storage/' . $company_info->about_image) }}" alt="">
                                </figure>
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="about-year-image">
                                <div class="about-year">
                                    <p>Since</p>
                                    <h4 class="counter">{{ $company_info->founded_year }}</h4>
                                </div>

                                <div class="about-img left-shape">
                                    <figure class="reveal hover-anime">
                                        <img src="{{ asset('storage/' . $company_info->about_image_2) }}" alt="">
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- About Left Image End -->
            </div>

            <div class="col-lg-6">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">{{ $company_info->about_subtitle }}</h3>
                    <h2 class="text-anime">{{ $company_info->about_title }}</h2>
                </div>

                <div class="about-content wow fadeInUp" data-wow-delay="0.75s">
                    <p>{{ $company_info->about_us }}</p>

                    <ul>
                        @if($company_info->about_points)
                            @foreach($company_info->about_points as $index => $point)
                                <li><span>0{{ $index + 1 }}.</span> {{ $point }}</li>
                            @endforeach
                        @endif
                    </ul>

                    <a href="{{ route("web.about")}}" class="btn-default">Read More</a>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- About us Section End -->