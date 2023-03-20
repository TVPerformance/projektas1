@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Hotel list</h1>
                </div>

                <div class="card-body">
                    <ul class="list-group">

                        @foreach($countries as $country)
                        @foreach($country->countryHotel as $hotel)

                        <li class="list-group-item">
                            <div class="container">
                                <div class="row">
                                    <div class="col-2 hotel">
                                        {{$hotel->title}}
                                    </div>
                                    <div class="col-2 country">
                                        {{$country->title}}
                                    </div>
                                    <!-- <div class="col-2">
                                    {{$country->startNice}} -  {{$country->endNice}}
                                    </div> -->
                                    <div class="col-1 stay">
                                        {{$hotel->duration}} nights
                                    </div>
                                    <div class="col-2 price">{{$hotel->price}} Eur</div>

                                    @if($hotel->picture)
                                    <div class="col-1">
                                        <img class="img-thumbnail" src="{{asset($hotel->picture)}}" width="45" height="34">
                                    </div>
                                    @else
                                    <div class="col-1">
                                        <img class="img-thumbnail" src="{{asset('hotel/absent.jpg')}}" width="45" height="34">
                                    </div>
                                    @endif
                                    
                                            <div class="col-4 d-flex justify-content-end capital" style="display: flex">
                                                <a href="{{route('hotels-show', $hotel)}}" class="btn btn-outline-info me-2">Show</a>
                                                <a href="{{route('hotels-edit', $hotel)}}" class="btn btn-outline-secondary me-2">Edit</a>

                                                <form action="{{route('hotels-destroy', $hotel)}}" method="post">
                                                    <button type="submit" class="btn btn-danger capital">Delete</button>
                                            </div>
                                     
                                    @csrf
                                    @method('delete')
                                    </form>

                        </li>


                        @endforeach
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