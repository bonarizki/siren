@extends('master.user.index')

@section('title','HOME')

@section('content')
    <div class="ftco-blocks-cover-1">
            <div class="ftco-cover-1 overlay" style="background-image: url('user/images/hero_1.jpg')">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <div class="feature-car-rent-box-1">
                                <h2>Welcome, Find Your Cars</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <h3>Our Offer</h3>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure nesciunt nemo vel
                            earum maxime neque!</p>
                        <p>
                            <a href="#" class="btn btn-primary custom-prev">Previous</a>
                            <span class="mx-2">/</span>
                            <a href="#" class="btn btn-primary custom-next">Next</a>
                        </p>
                    </div>
                    <div class="col-lg-9">
                        <div class="nonloop-block-13 owl-carousel">
                            @foreach ($cars as $car)
                                <div class="item-1">
                                    <a href="#"><img src="file_upload/car_image/{{ $car->car_image }}" alt="Image" class="img-fluid"></a>
                                    <div class="item-1-contents">
                                        <div class="text-center">
                                            <h3><a href="#">{{ $car->car_name }}</a></h3>
                                            <div class="rent-price"><span>Rp. {{number_format($car->car_price,2,",",'.')}}/</span>day</div>
                                        </div>
                                        <ul class="specs">
                                            <li>
                                                <span>Brand</span>
                                                <span class="spec">{{ $car->Brands->brand_name }}</span>
                                            </li>
                                            <li>
                                                <span>Type</span>
                                                <span class="spec">{{ $car->Types->type_name }}</span>
                                            </li>
                                            <li>
                                                <span>Seats</span>
                                                <span class="spec">{{ $car->car_seat }}</span>
                                            </li>
                                        </ul>
                                        <div class="d-flex action">
                                            <span class="btn btn-primary" onclick="showForm('{{ $car->id }}')">Rent Now</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section section-3" style="background-image: url('user/images/hero_2.jpg');">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center mb-5">
                        <h2 class="text-white">Our services</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="service-1">
                            <span class="service-1-icon">
                                <span class="flaticon-car-1"></span>
                            </span>
                            <div class="service-1-contents">
                                <h3>Repair</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, laboriosam.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="service-1">
                            <span class="service-1-icon">
                                <span class="flaticon-traffic"></span>
                            </span>
                            <div class="service-1-contents">
                                <h3>Car Accessories</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, laboriosam.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="service-1">
                            <span class="service-1-icon">
                                <span class="flaticon-valet"></span>
                            </span>
                            <div class="service-1-contents">
                                <h3>Own a Car</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, laboriosam.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container site-section mb-5">
            <div class="row justify-content-center text-center">
                <div class="col-7 text-center mb-5">
                    <h2>How it works</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo assumenda, dolorum necessitatibus
                        eius earum voluptates sed!</p>
                </div>
            </div>
            <div class="how-it-works d-flex">
                <div class="step">
                    <span class="number"><span>01</span></span>
                    <span class="caption">Time &amp; Place</span>
                </div>
                <div class="step">
                    <span class="number"><span>02</span></span>
                    <span class="caption">Car</span>
                </div>
                <div class="step">
                    <span class="number"><span>03</span></span>
                    <span class="caption">Details</span>
                </div>
                <div class="step">
                    <span class="number"><span>04</span></span>
                    <span class="caption">Checkout</span>
                </div>
                <div class="step">
                    <span class="number"><span>05</span></span>
                    <span class="caption">Done</span>
                </div>

            </div>
        </div>

        @section('script')
            <script>
                $('#home').addClass('active')

                $(document).ready(function () {
                    $('.owl-nav').attr('hidden',true)
                });
            </script>
        @endsection
@endsection