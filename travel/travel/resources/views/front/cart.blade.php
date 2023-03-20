@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-3">
            @include('front.common.countries')
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    Cart
                </div>

                <div class="card-body">
                    <form action="{{route('update-cart')}}" method="post">
                        <ul class="list-group">
                            @forelse($cartList as $cartItem)

                            <li class="list-group-item">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-2 hotel">
                                            {{$cartItem->title}}
                                        </div>
                                        <div class="col-2 country">
                                            {{$cartItem->hotelCountry->title}}
                                        </div>
                                        <div class="col-2 stay">
                                            {{$cartItem->duration}} nights x 
                                            <input type="number" min="1" name="count[]" value="{{$cartItem->count}}">
                                            <input type="hidden" name="ids[]" value="{{$cartItem->id}}">
                                        </div>
                                        <div class="col-2 price">{{$cartItem->sum}} Eur</div>

                                        @if($cartItem->picture)
                                        <div class="col-1">
                                            <img class="img-thumbnail" src="{{asset($cartItem->picture)}}" width="45" height="34">
                                        </div>
                                        @else
                                        <div class="col-1">
                                            <img class="img-thumbnail" src="{{asset('hotel/absent.jpg')}}" width="45" height="34">
                                        </div>
                                        @endif

                                        <button type="submit" class="btn btn-outline-danger" name="delete" value="{{$cartItem->id}}">Delete</button>
                                    </div>

                            </li>
                            @empty
                            <li class="list-group-item">Cart empty</li>
                            @endforelse
                            <li class="list-group-item">
                            <button type="submit" class="btn btn-outline-primary">Update cart</button>
                            </li>
                        </ul>
                        @csrf
                    </form>
                    <form action="{{route('make-order')}}" method="post">
                    <button type="submit" class="btn btn-outline-primary">Buy now</button> 
                    @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection