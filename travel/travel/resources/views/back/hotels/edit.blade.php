@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Edit hotel in {{ $hotel->hotelCountry->title }}</h1>
                </div>

                <div class="card-body">

                    <form action="{{route('hotels-update', $hotel)}}" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Hotel name</label>
                            <input type="text" class="form-control" name="hotel_title" value="{{old('hotel_title', $hotel->title)}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="text" class="form-control" name="hotel_price" value="{{old('hotel_price', $hotel->price)}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Duration</label>
                            <input type="text" class="form-control" name="hotel_duration" value="{{old('hotel_duration', $hotel->duration)}}">
                        </div>

                        @if($hotel->picture)
                        <div class="col-12">
                            <div class="mb-3">
                                <img class="img-responsive" src="{{asset($hotel->picture)}}" width="460" height="345">
                            </div>
                        </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label">Hotel photo</label>
                            <input type="file" class="form-control" name="photo">
                        </div>
                        <div class="col-9">
                            <div class="mb-3">
                                <label class="form-label">Hotel description</label>
                                <textarea class="form-control" name="hotel_desc" rows="8">{{old('hotel_desc', $hotel->desc)}}</textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-outline-primary">Update</button>

                            @if($hotel->picture)
                            <button type="submit" class="btn btn-outline-danger" name="delete_photo" value="1">Delete photo</button>
                            @endif
                        </div>
                        @method('put')
                        @csrf



                    </form>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection