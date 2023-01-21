@extends("layout")

@section("content")
    <!-- Page Header Start -->
    @include("common.page-header", ["name" => "Checkout"])
    <!-- Page Header End -->


    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
                    <div class="row">
                        <div class="col-3">
                            <p>Name: <span class="font-weight-bold">{{session()->get("user")->full_name}}</span></p>
                            <p>Email: <span class="font-weight-bold">{{session()->get("user")->email}}</span></p>
                        </div>
                        <div class="col-6 form-group">
                            <label>Address</label>
                            <input class="form-control" id="address" type="text" placeholder="Street 123">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">${{$total - 10}}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">${{$total}}</h5>
                        </div>
                        <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3" data-route="{{route("makeOrder")}}" data-price="{{$total}}" id="makeOrder">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->


@endsection
