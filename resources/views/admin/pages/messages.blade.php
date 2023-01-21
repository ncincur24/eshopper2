@extends("admin.layout")

@section("content")
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary rounded h-100 p-4">
            <h4 class="text-center mb-5">Messages</h4>
            <div class="row">
                @foreach($messages as $m)
                <div class="col-7 m-auto mt-3">
                    <div class="bg-dark p-4 rounded">
                        <h6 class="mb-0">{{$m->name}}</h6>
                        <i>{{date("d M Y", strtotime($m->created_at))}}</i>
                        <p class="mt-4">{{$m->message}}</p>
                        <a href="mailto:{{$m->email}}" class="btn btn-outline-info">Reply</a>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
    <!-- Sale & Revenue End -->

@endsection


