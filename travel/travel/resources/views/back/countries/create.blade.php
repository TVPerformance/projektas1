@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Add destination Country</h1>
                </div>

                <div class="card-body">

                    <form action="{{route('countries-store')}}" method="post">
                        <div class="mb-3">
                            <label class="form-label">Country title</label>
                            <input type="text" class="form-control" placeholder="Country*" name="title">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Season start</label>
                            <input type="date" class="form-control" name="start">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Season end</label>
                            <input type="date" class="form-control" name="end">
                            <!-- <input type="text" class="form-control" placeholder="Season length*" name="length"> -->
                        </div>
                        <div class="mb-3">
                        <button type="submit" class="btn btn-outline-primary">Add</button>
                        </div>
                        @csrf



                    </form>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection