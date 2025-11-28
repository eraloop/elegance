@extends('layouts.app')

@section('title', 'Server Error - Elegance')

@section('content')
    <!-- Page Header Section Start -->
    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 order-md-1 order-2">
                    <div class="page-header-box">
                        <div class="tiny-h3">
                            <h3 class="wow fadeInUp"> Elegance Beauty </h3>
                        </div>
                        <h1 class="text-anime">Server Error</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-not-found">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-not-found-box wow fadeInUp" data-wow-delay="0.25s">
                        <h3>Something went wrong!</h3>
                        <p>We are experiencing some technical difficulties. Please try again later.</p>
                        <a href="{{ route('web.index') }}" class="btn-default">Back To Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection