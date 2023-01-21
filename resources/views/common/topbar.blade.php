<!-- Topbar Start -->
<div class="container-fluid">
    <div class="row align-items-center justify-content-between py-3 px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="{{route("home")}}" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
            </a>
        </div>
        <div class="col-4">
            @if(session()->has("user"))
            <h1 class="text-center">{{session()->get("user")->full_name}}</h1>
            <div class="d-flex justify-content-center">
                <a class="text-decoration-none mx-3" href="{{route("orderedItems")}}">Ordered items</a>
                @if(session()->get("user")->role_id == 1)
                    <a class="text-decoration-none" href="{{route("admin.home")}}">Admin panel</a>
                @endif

            </div>
            @endif
        </div>
        <div class="col-lg-3 col-6 text-right">
            <a href="{{route("cart")}}" class="btn border">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge" id="productNumber"></span>
            </a>
        </div>
    </div>
</div>
<!-- Topbar End -->
