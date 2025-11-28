<div class="fun-facts">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">Company Overview</h3>
                    <h2 class="text-anime">Facts & Figures</h2>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="col-lg-7">
                <div class="facts-counter">
                    <div class="row">
                        @foreach($fun_facts as $fact)
                            <div class="col-md-4">
                                <!-- Counter Item Start -->
                                <div class="facts-item wow fadeInUp" data-wow-delay="0.5s">
                                    <div class="icon-box">
                                        <img src="{{ asset($fact->icon)}}" alt="">
                                    </div>

                                    <h3><span class="counter">{{ $fact->count }}</span>+</h3>
                                    <p>{{ $fact->label }}</p>
                                </div>
                                <!-- Counter Item End -->
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>