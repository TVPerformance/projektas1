@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Add Hotel</h1>
                </div>

                <div class="card-body">

                    <form action="{{route('hotels-store')}}" method="post" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label class="form-label">Country</label>
                            <select class="form-select" name="country_id">
                                @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hotel title</label>
                            <input type="text" class="form-control" placeholder="Hotel name*" name="hotel_title">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stay length</label>
                            <input type="text" class="form-control" placeholder="Days*" name="length">
                            <!-- <input type="text" class="form-control" placeholder="Season length*" name="length"> -->
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="text" class="form-control" placeholder="Price*" name="price">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hotel photo</label>
                            <input type="file" class="form-control" name="photo">
                        </div>
                        <div class="col-9">
                            <div class="mb-3">
                                <label class="form-label">Hotel description</label>
                                <textarea class="form-control" name="hotel_desc"  rows="8">{{old('hotel_desc')}}</textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-outline-primary">Add New</button>
                        </div>
                        @csrf



                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection