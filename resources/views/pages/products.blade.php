@extends("layout")

@section("content")
    <!-- Page Header Start -->
    @include("common.page-header", ["name" => "Shop"])
    <!-- Page Header End -->

    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <form action="{{route("products.index")}}" method="get">
                    <!-- Search Start -->
                    <div class="border-bottom mb-4 pb-4">
                        <h5 class="font-weight-semi-bold mb-4">Sort By</h5>
                            <div>
                                <div class="input-group">
                                    <select class="form-select" name="sort" aria-label="Default select example">
                                        <option @if($sort == 0) selected @endif value="0">Order by</option>
                                        <option @if($sort == 1) selected @endif value="1">Price ascending</option>
                                        <option @if($sort == 2) selected @endif value="2">Price descending</option>
                                        <option @if($sort == 3) selected @endif value="3">Name ascending</option>
                                        <option @if($sort == 4) selected @endif value="4">Name descending</option>
                                    </select>
                                </div>
                            </div>
                    </div>
                    <!-- Search End -->

                    <!-- Order Start -->
                    <div class="border-bottom mb-4 pb-4">
                        <h5 class="font-weight-semi-bold mb-4">Filter by price</h5>
                            <div>
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" value="{{$word}}" placeholder="Search by name">
                                    <div class="input-group-append">
                                            <span class="input-group-text bg-transparent text-primary">
                                                <i class="fa fa-search"></i>
                                            </span>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <!-- Order End -->

                    <!-- Brand Start -->
                    <div class="border-bottom mb-4 pb-4">
                        <h5 class="font-weight-semi-bold mb-4">Brands</h5>
                        <div>
                            @foreach($brands as $b)
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" name="brands[]" {{in_array($b->id, $checkedBrands) ? "checked" : ""}} class="custom-control-input brand-filter" value="{{$b->id}}" id="brand_{{$b->id}}">
                                <label class="custom-control-label" for="brand_{{$b->id}}">{{$b->name}}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Brand End -->
                    <input type="submit" value="Filter" name="formData" class="btn btn-primary" />
                    <a href="{{route("products.index")}}" class="btn btn-danger ml-4">Reset</a>
                </form>
            </div>
            <!-- Shop Sidebar End -->

            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div id="write" class="row pb-3">
                    @if(count($products) == 0)
                        <h1>Oops, we don't have products for this filters</h1>
                    @else
                    @foreach($products as $p)
                    <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100" src="{{asset("storage/img/".$p->src)}}" alt="{{$p->alt}}">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">{{$p->name}}</h6>
                                <p>{{$p->brand_name}}</p>
                                <p>{{$p->type_name}}</p>
                                <div class="d-flex justify-content-center">
                                    <h6>${{$p->current_price}}</h6>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="{{route("products.show", ["product" => $p->id])}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                <button type="button" data-id="{{$p->id}}" data-price="{{$p->current_price}}" class="btn btn-sm text-dark p-0 add-to-cart"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div id="snackbar"></div>
                <div id="custom-paginate" data-route="{{route("products.index")}}">{{$products->links()}}</div>
                <style>.w-5{display: none}</style>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection
