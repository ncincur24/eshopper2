@extends("layout")

<?php //dd($info->singleOrder(2))?>
@section("content")
    <!-- Page Header Start -->
    @include("common.page-header", ["name" => "Ordered items"])
    <!-- Page Header End -->
    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            @if($orders)
            <table class="table m-auto table-bordered">
                <thead class="bg-primary">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Address</th>
                    <th scope="col">Price</th>
                    <th scope="col">Date</th>
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
            @else
            <h1 class="text-center">You don't have any orders</h1>
            @endif
        </div>
    </div>
    <!-- Checkout End -->


@endsection
