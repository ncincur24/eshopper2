<div class="col-lg-3 col-md-12">
    <form action="{{route("products.index")}}" method="get">
        <!-- Search Start -->
        <div class="border-bottom mb-4 pb-4">
            <h5 class="font-weight-semi-bold mb-4">Sort By</h5>
            <div>
                <div class="input-group">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
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
                    <input type="text" class="form-control" placeholder="Search by name">
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
                        <input type="checkbox" class="custom-control-input brand-filter" value="{{$b->id}}" id="brand_{{$b->id}}">
                        <label class="custom-control-label" for="brand_{{$b->id}}">{{$b->name}}</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Brand End -->

        <!-- Type Start -->
        <div class="mb-5">
            <h5 class="font-weight-semi-bold mb-4">Types</h5>
            <div>
                @foreach($types as $t)
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input type-filter" value="{{$t->id}}" id="type_{{$t->id}}">
                        <label class="custom-control-label" for="type_{{$t->id}}">{{$t->name}}</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Type End -->
        <input type="submit" value="Filter" class="btn btn-primary" />
    </form>
</div>
