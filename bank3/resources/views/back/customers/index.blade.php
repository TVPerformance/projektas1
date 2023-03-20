@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-4">
                                <h1>Klientų sąrašas</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header">
                    <form action="{{route('customers-index')}}" method="get">
                        <div class="container">
                            <div class="row justify-content-center">


                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">Rūšiuoti</label>
                                        <select class="form-sort" name="sort">
                                            @foreach($sortSelect as $value => $name)
                                            <option value="{{$value}}" @if($sortShow==$value) selected @endif>{{$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">Per puslapį</label>
                                        <select class="form-sort" name="per_page">
                                            @foreach($perPageSelect as $value)
                                            <option value="{{$value}}" @if($perPageShow==$value) selected @endif>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">Filtruoti</label>
                                        <select class="form-sort" name="filter">

                                            <option value="Visos">Visos</option>
                                            <option value="Tuščios">Tuščios</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="head-buttons">
                                        <button type="submit" class="btn btn-outline-primary">Show</button>
                                        <a href="{{route('customers-index')}}" class="btn btn-outline-info">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        @forelse($customers as $customer)
                        <li class="list-group-item">

                            <div class="space">
                                <p class="name  col-3">{{$customer->name}} {{$customer->surname}}</p>
                                <!-- <p class="name">{{$customer->surname}}</p> -->

                                <p class="mt-2"><span class="span">a.k.: </span>{{$customer->pers_id}}</p>

                                <p class="mt-2 col-3"><span class="span">IBAN </span>{{$customer->account}}</p>



                                <p class="name">{{$customer->balance}} Eur</p>

                                <div class="space">

                                    <a style="border-radius: 50%;" href="{{route('customers-edit', $customer)}}" class="btn btn-outline-primary">+/-</a>
                                    <form action="{{route('customers-destroy', $customer)}}" method="post">
                                        <button type="submit" class="btn btn-outline-danger ps">Ištrinti</button>

                                        @csrf
                                        @method('delete')
                                    </form>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">Klientų dar nėra</li>
                        @endforelse

                    </ul>

                </div>
            </div>
            @if($perPageShow != 'all')
            <div class="m-2">{{ $customers->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection