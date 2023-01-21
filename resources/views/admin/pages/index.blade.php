@extends("admin.layout")

@section("content")
<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row">
        <div class="bg-secondary rounded h-100 p-4">
            <h6>Latest actions</h6>
            <form  method="get">
            <div class="row">
                    <div class="col-2">
                        <input type="date" name="from" value="{{old("from")}}" class="form-control">
                        @if(session('afterErr'))
                            <p class="text-danger">{{session('afterErr')}}</p>
                        @endif
                    </div>
                    <div class="col-2">
                        <input type="date" value="{{old("to")}}" name="to" class="form-control">
                    </div>
                    <div class="col-3">
                        <input type="submit" value="Filter" class="btn btn-info mx-4">
                        <a href="{{route("admin.home")}}" class="btn btn-danger" btn>Reset</a>

                    </div>
            </div>
            </form>
            <div class="table-responsive mt-3">
                @if(count($actions) > 0)
                <table class="table text-start align-middle table-bordered table-hover table-striped mb-0">
                    <thead>
                    <tr class="text-white">
                        <th scope="col">#</th>
                        <th scope="col">Action</th>
                        <th scope="col">IP address</th>
                        <th scope="col">Path</th>
                        <th scope="col">Method</th>
                        <th scope="col">Date and tame</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($actions as $a)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$a->action}}</td>
                            <td>{{$a->ip}}</td>
                            <td>{{$a->path}}</td>
                            <td>{{$a->method}}</td>
                            <td>{{$a->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <h2>There is no actions for this date</h2>
                @endif
            </div>

        </div>
    </div>
</div>
<!-- Sale & Revenue End -->



@endsection


