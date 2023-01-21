@extends("layout")



@section("content")
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Registration</h1>
        </div>
    </div>
<!--Registration start-->
<div class="container-fluid pt-5" id="model">
    <div class="row px-xl-5">
        <div class="m-auto col-lg-7 mb-5">
            <div class="contact-form">
                <div id="success"></div>
                <form id="registerForm" data-login="{{route("login")}}">
                    <div class="control-group mb-4">
                        <input type="text" class="form-control" id="name" placeholder="Your Name">
                    </div>
                    <div class="control-group mb-4">
                        <input type="text" class="form-control" id="lastName" placeholder="Your Last Name">
                    </div>
                    <div class="control-group mb-4">
                        <input type="email" class="form-control" id="email" placeholder="Your Email">
                    </div>
                    <div class="control-group mb-4">
                        <input type="password" class="form-control" id="password" placeholder="Your Password">
                    </div>
                    <div class="control-group mb-4">
                        <input type="password" class="form-control" id="conf-password" placeholder="Confirm Password">
                    </div>
                    <div>
                        <input class="btn btn-primary py-2 px-4" data-route="{{route("registerAction")}}" type="button" value="Register" id="register">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Registration start-->
@endsection
