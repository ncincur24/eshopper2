@extends("admin.layout")

@section("content")

    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary rounded h-100 p-4" id="product">
            <h6 class="mb-4">Products</h6>
            <a href="{{route("products.create")}}" class="btn btn-info mb-3">Add product</a>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover table-striped mb-0">
                    <thead>
                    <tr class="text-white">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Updated at</th>
                        <th scope="col" colspan="2">Action</th>
                    </tr>
                    </thead>
                    <tbody data-type="product">
                        @foreach($products as $p)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$p->name}}</td>
                                <td>${{$p->current_price}}</td>
                                <td>{{$p->brand_name}}</td>
                                <td>{{$p->created_at}}</td>
                                <td>{{$p->updated_at}}</td>
                                <td>
                                    <button type="button" data-route="{{route("products.destroy", ["product" => $p->id])}}" class="btn btn-square btn-outline-primary m-2 delete-icon">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                                <td>
                                    <a href="{{route("products.edit", ["product" => $p->id])}}" class="btn btn-square btn-outline-info m-2">
                                        <i class="fas fa-info"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection


