@extends("admin.layout")

@section("content")

    <div class="container-fluid px-4">
        <div class="bg-secondary row rounded mt-4 h-100 p-4">
            <div class="col-6 m-auto">
                @if(session("added"))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-exclamation-circle me-2"></i>{{session("added")}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="{{route("products.store")}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h5 class="my-4">Add product</h5>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" value="{{old("name")}}" id="name" placeholder="Product name">
                        <label for="name">Product name</label>
                        @error('name')
                        <p class="text-primary">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Price $</span>
                        <input type="text" class="form-control" name="price" value="{{old("price")}}" aria-label="Amount (to the nearest dollar)">
                    </div>
                    @error('price')
                    <p class="text-primary">{{$message}}</p>
                    @enderror

                    <div class="mb-3">
                        <label for="formFile" class="form-label">Image</label>
                        <input class="form-control bg-dark" type="file" name="image" id="formFile">
                        @error('image')
                        <p class="text-primary">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="brandAdmin" name="brand" aria-label="Floating label select example">
                            <option value="0">Choose</option>
                            @foreach($brands as $b)
                                <option {{old("brandAdmin") == $b->id ? "selected" : ""}} value="{{$b->id}}">{{$b->name}}</option>
                            @endforeach
                        </select>
                        <label for="brandAdmin">Product brand</label>
                        @error('brand')
                        <p class="text-primary">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Description" name="description" id="description" style="height: 150px;">{{old("description")}}</textarea>
                        <label for="description">Description</label>
                        @error('description')
                        <p class="text-primary">{{$message}}</p>
                        @enderror
                    </div>

                    <button type="submit" name="addProduct" class="btn btn-info ml-5">Add product</button>
                </form>
                <a href="{{route("admin.products")}}" class="btn mt-4 btn-primary">Back</a>
            </div>

        </div>
    </div>

@endsection



