<div class="row mb-5">
    <div class="col-6 offset-3">
        <h3 class="text-secondary">Address Info</h3>
        <form method="post" action="{{ route('address.store') }}">
            @csrf
            <div class="form-group">
                <label for="street">Street</label>
                <input type="text" class="form-control @error('street') is-invalid @enderror" id="street"
                    name="street" value="{{ old('street', optional($user->address)->street) }}" required>
                @error('street')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"
                        name="city" value="{{ old('city', optional($user->address)->city) }}" required>
                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="state">State</label>
                    <input type="text" class="form-control @error('state') is-invalid @enderror" id="state"
                        name="state" value="{{ old('state', optional($user->address)->state) }}" required>
                    @error('state')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="zip_code">Zip Code</label>
                    <input type="text" class="form-control @error('zip_code') is-invalid @enderror" id="zip_code"
                        name="zip_code" value="{{ old('zip_code', optional($user->address)->zip_code) }}" required>
                    @error('zip_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mt-5">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
        </form>
    </div>
