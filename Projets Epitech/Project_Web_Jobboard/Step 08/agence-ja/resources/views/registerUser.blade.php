<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.head')
        <title>Register User</title>
    </head>
    <body>
        <header>
            @include('includes.navbar')
        </header>

        <main>
            <div class="container p-0 mt-5 rounded">
                <form action="{{ route('users.store') }}" method="POST">
                    <h2 class="p-3 bg-primary text-white">Register</h2>
                        @csrf
                        <div class="form-check ml-3 mb-2 col">
                            <input type="radio" class="form-check-input  @error('role') is-invalid @enderror" id="exampleRadios1"
                            value="1" {{ old('role') == 1 ? 'checked' : '' }} name="role">
                            <label class="form-check-label" for="exampleRadios1">Particular</label><br>

                            <input type="radio" class="form-check-input @error('role') is-invalid @enderror" id="exampleRadios2"
                            value="2" {{ old('role') == 2 ? 'checked' : '' }} name="role">
                            <label class="form-check-label" for="exampleRadios2">Company</label><br>

                            @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    <div class="d-flex">
                        <div class="form-group col">
                            <label for="firstname">Firstname</label>
                            <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname"
                            placeholder="Your firstname" name="firstname" value="{{old('firstname')}}">

                            @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for="lastname">Lastname</label>
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname"
                            placeholder="Your lastname" name="lastname" value="{{old('lastname')}}">

                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group col">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            placeholder="Your email" name="email" value="{{old('email')}}">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for="age">Age</label>
                            <input type="date" class="form-control @error('age') is-invalid @enderror" id="age"
                            placeholder="Your age" name="age" value="{{old('age')}}">

                            @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="form-group col">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            placeholder="Your password" name="password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for="password_confirmation">Confirm</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirmPassword"
                            placeholder="Confirm your password" name="password_confirmation">

                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col text-center mb-3">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>

                    <div class="d-flex justify-content-end">
                        <p class="px-3"><em>Already register ? <a href="{{route('login')}}">Login</a></em></p>
                    </div>
                </form>
            </div>

        </main>
        @include('includes.footer')
    </body>
</html>
