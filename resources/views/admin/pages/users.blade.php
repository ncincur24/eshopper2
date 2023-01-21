@extends("admin.layout")

@section("content")

    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Manage users</h6>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Date joined</th>
                            <th scope="col">Active</th>
                            <th scope="col">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $u)
                            <tr>
                                <input type="hidden" id="idUserToChange" data-route="{{route("users.update", ["user" => $u->id])}}" value="{{$u->id}}" />
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$u->full_name}}</td>
                                <td>{{$u->email}}</td>
                                <td>{{$u->created_at}}</td>
                                <td>
                                    <select class="form-select form-select-sm mb-3 status" data-type="active" aria-label=".form-select-sm example">
                                        <option value="0" {{$u->active ? "" : "selected"}}>Enabled</option>
                                        <option value="1" {{$u->active ? "selected" : ""}}>Disabled</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select form-select-sm mb-3 status" data-type="role_id" aria-label=".form-select-sm example">
                                        <option value="1" {{$u->role_id == 1 ? "" : "selected"}}>Admin</option>
                                        <option value="2" {{$u->role_id == 2 ? "selected" : ""}}>User</option>
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
    <!-- Recent Sales End -->

@endsection


