@if ($message = Session::get('success'))
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        </div>
    </div>
</div>

@elseif ($message = Session::get('error'))
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        </div>
    </div>
</div>

@endif
