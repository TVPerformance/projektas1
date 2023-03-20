@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>All orders</h1>
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach($orders as $order)
                        <li class="list-group-item">
                            <div class="container">
                                <div class="row">
                                    <h3 class="col-2 hotel">
                                        # {{$order->id}}
                                    </h3>
                                    <b>
                                        {{$order->user->name}}
                                    </b>
                                    <i>
                                        {{$order->order->total}} Eur
                                    </i>
                                    <ul class="list-group">
                                        @foreach($order->order->hotels as $item)
                                        <li class="list-group-item">
                                            {{$item->title}} x {{$item->count}}
                                        </li>
                                        @endforeach

                                    </ul>

                                    <div class="col-4 d-flex justify-content-end capital" style="display: flex">
                                        @if($order->status == 0)
                                        <form action="{{route('orders-update', $order)}}" method="post">

                                            <button type="submit" class="btn btn-outline-warning capital">Finish order</button>
                                            @csrf
                                            @method('put')
                                        </form>
                                        @endif
                                        <form action="{{route('orders-destroy', $order)}}" method="post">
                                            <button type="submit" class="btn btn-outline-danger capital">Delete order</button>
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
</div>
@endsection