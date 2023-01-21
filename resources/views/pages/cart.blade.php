@extends("layout")

@section("content")
    <!-- Page Header Start -->
    @include("common.page-header", ["name" => "Shopping cart"])
    <!-- Page Header End -->


    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5" id="cartDecide" data-route="{{route("cartDetails")}}" data-check="{{route("checkout")}}">
        </div>
    </div>

    <!-- Cart End -->
@endsection
