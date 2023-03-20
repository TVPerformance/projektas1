@inject('countries', 'App\Services\CountriesService')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>All Destinations</h1>
                </div>
                <ul class="list-group">
                    <div class="card-body">
                        
                            @foreach($countries->get() as $country)
                            <a class="list-group-item" href="{{route('show-country-hotels', $country)}}">
                                <li class="list-group-item">{{$country->title}} <span>
                                        [{{$country->countryHotel()->count()}}]
                                    </span>
                                </li>
                            </a>
                            @endforeach
                       
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>