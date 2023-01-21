@extends("admin.layout")

@section("content")

    <div class="container-fluid px-4">
        <div class="bg-secondary row rounded mt-4 h-100 p-4">
            <div class="col-6 d-flex justify-content-center align-items-center">
                <img src="{{asset("storage/img/".$product->src)}}" alt="{{$product->alt}}" class="m-auto">
            </div>
            <div class="col-6">
                <form id="editProductForm">
                    <h5 class="my-4">{{$product->name}}</h5>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" value="{{$product->name}}" id="name" placeholder="Product name">
                        <label for="name">Product name</label>
                    </div>

                    <div class="input-group mb-3" id="priceErr">
                        <span class="input-group-text">Price $</span>
                        <input type="text" value="{{$product->current_price}}" id="price" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="brandAdmin" aria-label="Floating label select example">
                            @foreach($brands as $b)
                                <option {{$product->brand_id == $b->id ? "selected" : ""}} value="{{$b->id}}">{{$b->name}}</option>
                            @endforeach
                        </select>
                        <label for="brandAdmin">Product brand</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Description" id="description" style="height: 150px;">{{$product->description}}</textarea>
                        <label for="description">Description</label>
                    </div>

                    <button type="button" id="editProduct" data-route="{{route("products.update", ["product" => $product->id])}}" class="btn btn-outline-success ml-5">Save changes</button>
                </form>
                <a href="{{url()->previous()}}" class="btn mt-4 btn-outline-primary">Back</a>
            </div>

        </div>
    </div>

@endsection



