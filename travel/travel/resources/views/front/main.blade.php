@extends('layouts.front')


@section('content')
<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <form action="{{route('main')}}" method="get">
                            <div class="col-1">
                                <div class="mb-3">
                                    <label class="form-label">Sort</label>
                                    <select class="form-sort" name="sort">
                                        @foreach($sortSelect as $value => $name)
                                        <option value="{{$value}}" @if($sortShow==$value) selected @endif>{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="mb-2">
                                    <label class="form-label">Per page</label>
                                    <select class="form-sort" name="per_page">
                                        @foreach($perPageSelect as $value)
                                        <option value="{{$value}}" @if($perPageShow==$value) selected @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="head-buttons">
                                    <button type="submit" class="btn btn-outline-primary">Show</button>
                                    <a href="{{route('main')}}" class="btn btn-outline-info">Reset</a>
                                </div>
                            </div>
                        </form>
                        <form action="{{route('main')}}" method="get">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Find hotel</label>
                                            <input type="text" class="form-control" name="s" value="{{$s}}">
                                        </div>
                                        <div class="col-4">
                                            <div class="head-buttons">
                                                <button type="submit" class="btn btn-outline-primary">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div>
                <h1>Destinations</h1>
            </div>
            <div class="col-3">
                @include('front.common.countries')
            </div>
            <div class="col-9">
                <div class="card-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            @foreach($hotels as $hotel)
                            <div class="col-3 list-table">
                                <h2>{{$hotel->title}}</h2>
                                <h4>{{$hotel->hotelCountry->title}}</h4>
                                <h6>{{$hotel->duration}} days</h6>
                                <h5>{{$hotel->price}} Eur</h5>
                                <h6>{{$hotel->hotelCountry->start}}</h6>
                                <h6>{{$hotel->hotelCountry->end}}</h6>

                                <a href="{{route('show-hotel', $hotel)}}">
                                    <div>
                                        @if($hotel->picture)
                                        <img class="smallimg" src="{{asset($hotel->picture)}}">
                                        @else
                                        <img class="img-thumbnail" src="{{asset('hotel/absent.jpg')}}">
                                        @endif
                                    </div>
                                </a>
                                <div>
                                    <form action="{{route('add-to-cart')}}" method="post">
                                        <button type="submit" class="btn btn-danger mt-1">Buy Now</button>
                                        <input type="number" min="1" value="1" name="count">
                                        <input type="hidden" min="1" name="product" value="{{$hotel->id}}">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($perPageShow != 'all')
    {{ $hotels->links() }}
    @endif
</div>
@endsection