<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.head')
        <title>Login User</title>
    </head>
    <body>
        <header>
            @include('includes.navbar')
        </header>

        <main>
            <div class="container p-0 mt-5 rounded">
                <h2 class="p-3 bg-primary text-white">Login</h2>

                <form class="p-3" action="{{route('auth.login')}}" method="POST">
                    @csrf

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
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        placeholder="Your password" name="password" value="{{old('password')}}">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col text-center mb-3">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>

                    <div class="d-flex justify-content-end">
                        <p class="px-3"><em>Not already register ? <a href="{{ route('users.create')}}">Register</a></em></p>
                    </div>
                </form>
            </div>

        </main>
        @include('includes.footer')
    </body>
</html>
