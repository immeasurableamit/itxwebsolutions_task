<div class="container text-center mt-4">
    <div class="row justify-content-md-center">

        <div class="col-md-auto">
            <div class="card">
                <div class="card-body">

                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="save">

                        <div class="form-group row mb-3">
                            <label for="name" class="col-sm-3 col-form-label">Name</label>

                            <div class="col-md-9">
                                <input type="text" class="form-control" id="name" name="name"
                                    wire:model="name">
                                <span class="error">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>

                            <div class="col-md-9">
                                <input type="email" class="form-control" id="email" wire:model="email">
                                <span class="error">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>

                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="country" class="col-sm-3 col-form-label">Country</label>

                            <div class="col-md-9">
                                <select wire:model="selectedCountry" class="form-control">
                                    <option value="" selected>
                                        Choose Country
                                    </option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <span class="error">
                                    @error('selectedCountry')
                                        {{ $message }}
                                    @enderror
                                </span>

                            </div>
                        </div>


                        @if (!is_null($selectedCountry))
                            <div class="form-group row mb-3">
                                <label for="state" class="col-sm-3 col-form-label">State</label>

                                <div class="col-md-9">
                                    <select wire:model="selectedState" class="form-control">
                                        <option value="" selected>
                                            Choose State
                                        </option>
                                        @foreach ($states as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <span class="error">
                                        @error('selectedState')
                                            {{ $message }}
                                        @enderror
                                    </span>

                                </div>
                            </div>
                        @endif

                        @if (!is_null($selectedState))
                            <div class="form-group row mb-3">
                                <label for="city" class="col-sm-3 col-form-label">City</label>

                                <div class="col-md-9">
                                    <select wire:model="selectedCity" class="form-control" name="city_id">
                                        <option value="" selected>
                                            Choose City
                                        </option>
                                        @foreach ($cities as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <span class="error">
                                        @error('selectedCity')
                                            {{ $message }}
                                        @enderror
                                    </span>

                                </div>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary">Save</button>

                    </form>

                </div>
            </div>

        </div>

    </div>

</div>
