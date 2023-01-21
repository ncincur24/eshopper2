@extends("layout")


@section("content")

    <div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Login</h1>
    </div>
</div>
<!--Login start-->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="m-auto col-lg-7 mb-5">
            <div class="contact-form">
                <form id="loginForm">
                    <div class="control-group mb-4">
                        <input type="email" class="form-control" id="email" placeholder="Your Email">
                    </div>
                    <div class="control-group mb-4">
                        <input type="password" class="form-control" id="password" placeholder="Your Password">
                    </div>
                    <div>
                        <input class="btn btn-primary py-2 px-4" data-route="{{route("loginAction")}}" type="button" value="Login" id="loginBtn">
                    </div>
                </form>
                @if(session("msg"))
                    <p class="alert alert-danger">{{session("msg")}}</p>
                @endif
            </div>
        </div>
    </div>
</div>
<!--Login end-->
@endsection
