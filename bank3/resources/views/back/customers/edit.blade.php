@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Tvarkyti lėšas</h1>
                </div>

                <div class="card-body">
                    <form action="{{route('customers-update', $customer)}}" method="post">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="space">
                                    <div class="name">
                                        <p>{{$customer->name}} {{$customer->surname}}</p>
                                    </div>
                                      <p class="name">{{$customer->balance}} Eur</p>
                                </div>
                                <div>
                                <p class="span"> a.k. <span>{{$customer->pers_id}}</span> </p>
                                    <p class="span">{{$customer->account}}</p>
                                  
                                </div>
                                <input type="text" style="margin-bottom: 10px" name="sum" value="{{old('sum')}}" placeholder="Suma">
                                <div class="buton">
                                    <button type="submit" class="btn btn-outline-info" >Pridėti lėšas</button>
                                    <button type="submit" class="btn btn-outline-secondary ps" name="minus" value="5">Nuimti lėšas</button>
                                </div>
                            </li>
                        </ul>
                        @method('put')
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection