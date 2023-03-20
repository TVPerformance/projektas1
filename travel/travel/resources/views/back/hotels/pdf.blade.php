<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
          .mb-3 {
            margin: 20px;
        }
        .form-label {
            font-weight: bold;
        }
        .img img {
            height: 400px;
            width: auto;
        }
    </style>
</head>

<body>
    <h1>{{$hotel->title}} in {{ $hotel->hotelCountry->title }}</h1>
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
        {{$hotel->duration}} days
    </div>
    @if($hotel->picture)
        <div class="mb-3 img">
            <img src="{{asset($hotel->picture)}}">
        </div>
    @endif
    <div class="mb-3 img">
        <label class="form-label">Hotel description :</label>
        {{$hotel->desc}}
    </div>
</body>

</html>