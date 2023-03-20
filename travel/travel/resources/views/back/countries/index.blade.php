@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1>Final destination list</h1>
                </div>

                <div class="card-body">


                    <ul class="list-group">

                        @foreach($countries as $country)
                        <li id="{{ $country['id'] }}" class="list-group-item">
                            <div class="container">
                                <div class="row">
                                    <div class="col-3 hotel">{{$country->title}}</div>
                                    <div class="col-3">{{$country->startNice}} to: {{$country->endNice}}</div>

                                    <div class="col-4 d-flex justify-content-end capital" style="display: flex">

                                        <a href="{{route('countries-edit', $country)}}" class="btn btn-primary me-2">Edit</a>

                                        <form action="{{route('countries-destroy', $country)}}" method="post">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                    @csrf
                                    @method('delete')
                                    </form>
                                </div>
                            </div>
                        </li>
                        @endforeach



                    </ul>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection