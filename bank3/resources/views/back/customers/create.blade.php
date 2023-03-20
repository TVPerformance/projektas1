@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Sukurti naują sąskaitą</h1>
                </div>

                <div class="card-body">
                    <form action="{{route('customers-store')}}" method="post">
                        <div class="name">
                            <input  type="hidden" value="{{ $account = 'LT' .rand(0, 9) .rand(0, 9) .'-' .'3141'.'-' .'5' .rand(0, 9) .rand(0, 9) .rand(0, 9) .'-' .rand(0, 9) .rand(0, 9) .rand(0, 9) .rand(0, 9) .'-' .rand(0, 9) .rand(0, 9) .rand(0, 9) .rand(0, 9)}}" name="customer_account" readonly>{{ $account }}</input>
                        </div>
                        <div class="mb-3">
                            <label class="form-lable span">Vardas</label>
                            <input type="text" class="form-control" name="customer_name" value="{{old('customer_name')}}" placeholder="Vardas*">
                        </div>
                        <div class="mb-3">
                            <label class="form-lable span">Pavardė</label>
                            <input type="text" class="form-control" name="customer_surname" value="{{old('customer_surname')}}" placeholder="Pavardė*">
                        </div>
                        <div class="mb-3">
                            <label class="form-lable span">Asmens kodas</label>
                            <input type="text" class="form-control" name="customer_pers_id" value="{{old('customer_pers_id')}}" placeholder="asmens kodas*">
                        </div>
                        <button type="submit" class="btn btn-outline-success">Sukurti</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection