@extends("layout")

@section("content")
    <!-- Page Header Start -->
    @include("common.page-header", ["name" => "Product Detail"])
    <!-- Page Header End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div class="carousel-inner border">
                    <div class="carousel-item active">
                        <img class="w-100 h-100" src="{{asset("storage/img/".$product->src)}}" alt="{{$product->alt}}">
                    </div>
                </div>
            </div>
            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold mb-5">{{$product->name}}</h3>
                <h3 class="font-weight-semi-bold mb-1">${{$product->current_price}}</h3>
                <p class="mb-1">{{$product->brand_name}}</p>
                <p class="mb-4">{{$product->description}}</p>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->
    <div id="snackbar"></div>

@endsection
