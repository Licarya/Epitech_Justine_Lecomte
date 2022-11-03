<!doctype html>
<html lang="en">
    <head>
        @include('includes.head')
        <title>Edit {{$company->name}}</title>
    </head>
    <body>
        <header>
            @include('includes.navbar')
        </header>

        <main class="container p-5">
            <a class="arrowBack mt-4" href="{{route('admin.companies.index')}}">
                <i class="fa-solid fa-circle-arrow-left text-primary"></i>
            </a>
            <div class="content">
                <h1 class="pb-3 pl-3 pr-3 pt-2 tslateYh1 border-0 rounded"><span class="btn btn-outline-success btn-lg">Edit</span> {{$company->name ?? ''}}</h1>

                <form class="p-3" action="{{ route('admin.companies.update', $company->users_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <h4 class="mt-3">Company</h4>
                    <hr>
                    <div class="d-flex">
                        <div class="form-group col">
                            <label for="name">Company Name</label>
                            <input type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name" placeholder="The company name" name="name"
                            value="{{$company->name ?? ''}}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col">
                            <label for="siret">Siret</label>
                            <input type="number" class="form-control @error('siret') is-invalid @enderror"
                            id="siret" placeholder="Your SIRET" name="siret"
                            value="{{$company->siret ?? ''}}">
                            @error('siret')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <h4 class="mt-3">Your description</h4>
                    <hr>
                    <div class="form-group col">
                        <label for="description">Description</label>
                        <textarea type="text" rows="10" class="form-control @error('description') is-invalid @enderror"
                        id="description" placeholder="Talk about you..."
                        name="description">{{$company->description ?? ''}}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <h4 class="mt-3">Address</h4>
                    <hr>
                    <div class="form-group col">
                        <label for="address1">Address 1</label>
                        <input type="text" class="form-control @error('address1') is-invalid @enderror"
                        id="address1" placeholder="Your address 1" name="address1"
                        value="{{$address->address1 ?? ''}}">
                        @error('address1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col">
                        <label for="address2">Address 2</label>
                        <input type="text" class="form-control @error('address2') is-invalid @enderror"
                        id="address2" placeholder="Your address 2" name="address2"
                        value="{{$address->address2 ?? ''}}">
                        @error('address2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-flex">
                        <div class="form-group col">
                            <label for="country">Country</label>
                            <input type="text" class="form-control @error('country') is-invalid @enderror"
                            id="country" placeholder="Your country" name="country"
                            value="{{$address->country ?? ''}}">
                            @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for="city">City</label>
                            <input type="text" class="form-control @error('city') is-invalid @enderror"
                            id="city" placeholder="Your city" name="city"
                            value="{{$address->city ?? ''}}">
                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for="postal_code">Postal code</label>
                            <input type="text" class="form-control @error('postal_code') is-invalid @enderror"
                            id="postal_code" placeholder="Your postal code" name="postal_code"
                            value="{{$address->postal_code ?? ''}}">
                            @error('postal_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col text-center mb-3">
                            <a href="{{route('admin.companies.index')}}" class="btn btn-secondary btn-block">Cancel</a>
                        </div>
                        <div class="col text-center mb-3">
                            <button type="submit" class="btn btn-primary btn-block">
                                Edit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
        @include('includes.footer')
    </body>
</html>
