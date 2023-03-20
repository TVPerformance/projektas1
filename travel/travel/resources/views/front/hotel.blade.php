@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>{{$hotel->title}} in {{ $hotel->hotelCountry->title }}</h1>
                </div>

                <div class="card-body">


                    <div class="mb-3">
                        <label class="form-label">Hotel name :</label>
                        {{$hotel->title}}
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price :</label>
                        {{$hotel->price}} Eur
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Duration</label>
                        {{$hotel->duration}} nights
                    </div>

                    @if($hotel->picture)
                    <div class="col-12">
                        <div class="mb-3">
                            <img class="img-responsive" src="{{asset($hotel->picture)}}" width="460" height="345">
                            @else
                            <img class="img-thumbnail" src="{{asset('hotel/absent.jpg')}}">
                        </div>
                    </div>
                    @endif

                    <div class="col-9">
                        <div class="mb-3">
                            <label class="form-label">Hotel description :</label>
                            {{$hotel->desc}}
                        </div>
                    </div>
                    <div class="mb-3">
                        <a href="{{route('hotels-pdf', $hotel)}}" class="btn btn-outline-primary">Download PDF</a>
                    </div>
                    @method('put')
                    @csrf

                </div>
            </div>
        </div>
    </div>
</div>
@endsection