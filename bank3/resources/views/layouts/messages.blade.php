<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

        @if(Session::has('ok'))
        <h3 class="alert alert-success alert-dissmissible fade show" role="alert">
            {{ Session::get('ok')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </h3>
        @endif

        @if(Session::has('no'))
        <h3 class="alert alert-danger alert-dissmissible fade show" role="alert">
            {{ Session::get('no')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </h3>
        @endif

        @if($errors)
        @foreach($errors->all() as $message)
        <h3 class="alert alert-danger alert-dissmissible fade show" role="alert">
            {{$message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </h3>
        @endforeach
        @endif


        </div>
    </div>
</div>