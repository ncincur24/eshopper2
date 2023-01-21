@extends("layout")

@section("content")
    <!-- Page Header Start -->
    @include("common.page-header", ["name" => "Contact"])
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Contact For Any Queries</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form">
                    <div id="success"></div>
                    <form id="form-contact">
                        <div class="control-group mb-4">
                            <input type="text" class="form-control" value="{{session()->has("user") ? session()->get("user")->name : ""}}" id="contactName" placeholder="Your Name">
                        </div>
                        <div class="control-group mb-4">
                            <input type="email" class="form-control" value="{{session()->has("user") ? session()->get("user")->email : ""}}" id="contactEmail" placeholder="Your Email">
                        </div>
                        <div class="control-group mb-4">
                            <textarea class="form-control" rows="6" id="contactMessage" placeholder="Message"></textarea>
                        </div>
                        <div>
                            <input class="btn btn-primary py-2 px-4" type="button" data-route="{{route("sendMessage")}}" value="Send Message" id="btnContactMessage">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <h5 class="font-weight-semi-bold mb-3">Get In Touch</h5>
                <p>Contact us form more information or visit our stores</p>
                <div class="d-flex flex-column mb-3">
                    <h5 class="font-weight-semi-bold mb-3">Store 1</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
