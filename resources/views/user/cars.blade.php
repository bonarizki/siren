@extends('master.user.index')

@section('title','CARS')
    
@section('content')
<div class="ftco-blocks-cover-1">
    <div class="ftco-cover-1 overlay innerpage" style="background-image: url('user/images/hero_2.jpg')">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 text-center">
                    <h1>Our For Rent Cars</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12">
                <form action="">
                    <div class="form-group row">
                        <div class="col-md-10 mb-4 mb-lg-0">
                            <input type="text" class="form-control" name="search" placeholder="Search  . . . ">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-lg">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            @foreach ($cars as $car)
            <div class="col-lg-4 col-md-6 mb-4">
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
            </div>
            @endforeach

        </div>

        <div class="d-flex justify-content-center mt-2">
            {{ $cars->links() }}
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#cars').addClass('active');
</script>
@endsection