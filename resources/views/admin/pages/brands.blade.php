@extends("admin.layout")

@section("content")

    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary rounded h-100 p-4" id="brand">
            <div class="col-10 m-auto py-4">
                <h6 class="mb-4">Manage brands</h6>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Brand name</th>
                        <th>Date added</th>
                        <th scope="col">Delete</th>
                        <th scope="col">Edit</th>
                    </tr>
                    </thead>
                    <tbody data-type="brand" id="brandTable">
                    @foreach($brands as $b)
                        <tr id="brand_{{$b->id}}">
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$b->name}}</td>
                            <td>{{$b->created_at}}</td>
                            <td>
                                <button type="button" data-route="{{route("brands.destroy", ["brand" => $b->id])}}" class="btn btn-square btn-outline-primary delete-icon">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-8">
                                        <input type="text" id="edit-brand_{{$b->id}}" class="form-control" placeholder="Edit">
                                    </div>
                                    <div class="col">
                                        <input type="button" data-route="{{route("brands.update", ["brand" => $b->id])}}" class="btn btn-success editBtn" value="Done">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <input type="text" id="addBrandColumn" class="form-control w-25" placeholder="Brand name">
                <input type="button" id="addBrand" data-route="{{route("brands.store")}}" class="btn btn-warning mt-3" value="Add brand">
            </div>
        </div>
    </div>

@endsection



