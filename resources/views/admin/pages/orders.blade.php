@extends("admin.layout")

@section("content")
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary rounded h-100 p-4">
            <h6>All orders</h6>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover table-striped mb-0">
                    <thead>
                    <tr class="text-white">
                        <th scope="col">#</th>
                        <th scope="col">Product name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Address</th>
                        <th scope="col">Price</th>
                        <th scope="col">User</th>
                        <th scope="col">Order created</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $o)
                        <?php
                            $single = $info->singleOrder($o->id);
                            $number = count($single);
                        ?>
                        <tr>
                            <td rowspan="{{$number}}">{{$loop->iteration}}</td>
                            <td>{{$single->first()->name}}</td>
                            <td>{{$single->first()->quantity}}</td>
                            <td rowspan="{{$number}}">{{$o->address}}</td>
                            <td rowspan="{{$number}}">${{$o->total_price}}</td>
                            <td rowspan="{{$number}}">
                                <p>{{$o->full_name}}</p>
                                <p>{{$o->email}}</p>
                            </td>
                            <td rowspan="{{$number}}">{{date("j.m.Y. H:i", strtotime($o->created_at))}}</td>
                        </tr>
                        @if(count($single) > 1)
                            @foreach($single as $s)
                                @continue($loop->first)
                                <tr>
                                    <td>{{$s->name}}</td>
                                    <td>{{$s->quantity}}</td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- Sale & Revenue End -->

@endsection


