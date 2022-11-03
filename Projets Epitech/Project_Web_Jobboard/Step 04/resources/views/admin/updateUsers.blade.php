<!doctype html>
<html lang="en">
    <head>
        @include('includes.head')
        <title>Edit {{$user->firstname}}</title>
    </head>
    <body>
        <header>
            @include('includes.navbar')
        </header>

        <main class="container p-5">
            <a class="arrowBack mt-4" href="{{route('admin.users.index')}}">
                <i class="fa-solid fa-circle-arrow-left text-primary"></i>
            </a>
            <div class="content">
                <h1 class="pb-3 pl-3 pr-3 pt-2 tslateYh1 border-0 rounded"><span class="btn btn-outline-success btn-lg">Edit</span> {{$user->firstname}} {{$user->lastname}}</h1>

                <form class="p-3" action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <h4 class="mt-3">Name</h4>
                    <hr>
                    <div class="d-flex">
                        <div class="form-group col">
                            <label for="firstname">Firstname</label>
                            <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                            id="firstname" placeholder="Your firstname" name="firstname"
                            value="{{$user->firstname}}">
                            @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for="lastname">Lastname</label>
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                            id="lastname" placeholder="Your lastname" name="lastname"
                            value="{{$user->lastname}}">
                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    @if($user->role == 1)
                        <h4 class="mt-3">Your description</h4>
                        <hr>
                        <div class="form-group col">
                            <label for="description">Description</label>
                            <textarea type="text" rows="10" class="form-control @error('description') is-invalid @enderror"
                            id="description" placeholder="Talk about you..."
                            name="description">{{$user->description ?? ''}}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    @endif

                    <h4 class="mt-3">Email / Age</h4>
                    <hr>
                    <div class="d-flex">
                        <div class="form-group col">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" placeholder="Your email" name="email"
                            value="{{$user->email}}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for="age">Age</label>
                            <input type="date" class="form-control @error('age') is-invalid @enderror"
                            id="age" placeholder="Your age" name="age"
                            value="{{$user->age}}">
                            @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group col">
                        <label for="phone">Phone</label>
                        <input type="number" class="form-control @error('phone') is-invalid @enderror"
                        id="phone" placeholder="Your phone" name="phone" min="10"
                        value="{{$user->phone}}">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    @if($user->role == 1)
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
                    @endif

                    <div class="d-flex">
                        <div class="col text-center mb-3">
                            <a href="{{route('admin.users.index')}}" class="btn btn-secondary btn-block">Cancel</a>
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
