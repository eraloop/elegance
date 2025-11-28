<!-- Gift & Cards Section Start -->
<div class="gift-cards">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">Gifts & Cards</h3>
                    <h2 class="text-anime">Special Gifts & Cards</h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            @foreach($services as $service)
                @if($service->is_promotion || $service->is_gift)
                    <div class="col-lg-6">
                        <!-- Gift Offer Box Start -->
                        <div class="gift-box {{ $loop->even ? 'left-shape' : '' }}">
                            <div class="gift-content wow fadeInUp" data-wow-delay="0.5s">
                                <h3>{{ $service->name }}</h3>
                                <p>{{ Str::limit($service->short_description, 100) }}</p>
                                <a href="{{ route("web.booking")}}" class="btn-default">Get Now</a>
                            </div>

                            <div class="gift-image wow fadeInUp" data-wow-delay="0.75s">
                                <img src="{{ asset($service->thumbnail)}}" alt="">
                            </div>
                        </div>
                        <!-- Gift Offer Box End -->
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
<!-- Gift & Cards Section End -->