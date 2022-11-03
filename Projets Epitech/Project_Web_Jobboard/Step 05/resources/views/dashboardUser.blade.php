<html lang="en">
    <head>
        @include('includes.head')
        <title>Hello {{Session::get('firstname')}}</title>
    </head>
    <body>
        <header>
            @include('includes.navbar')
        </header>

        <main class="container mt-5 mb-5">
            @if (session('role') == 2 && Session::has('name'))
                <h1 class="pb-3 pl-3 pr-3 pt-2 tslateYh1 rounded">{{Session::get('name')}}</h1>
            @endif

            <div class="card cardBorderTop" id="dashboard_profil">
                <a class="arrowBack" href="{{route('/')}}">
                    <i class="fa-solid fa-circle-arrow-left text-primary"></i>
                </a>
                <h5 class="card-header text-danger" id="title">{{Session::get('firstname')}} {{Session::get('lastname')}}</h5>

                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="informations-tab" data-toggle="tab" href="#informations" role="tab" aria-controls="informations" aria-selected="true">Informations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="false">Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Settings</a>
                        </li>
                        @if (session('role') == 2)
                            <li class="nav-item">
                                <a class="nav-link" id="company-tab" data-toggle="tab" href="#company" role="tab" aria-controls="company" aria-selected="false">Company</a>
                            </li>
                        @endif
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="informations" role="tabpanel" aria-labelledby="informations-tab">
                            <ul class="list-group">

                                <li class="list-group-item">
                                    <h5>My presentation</h5>
                                    @if (Session::has('description'))
                                        <p class="mt-2">{{Session::get('description')}}</p>
                                    @else
                                        <p>Please make your own description...</p>
                                    @endif
                                </li>

                                <li class="list-group-item">
                                    <div class="d-flex">
                                        <p class="font-weight-bold mr-2"> born : </p>
                                        <p>{{Session::get('age')}}</p>
                                    </div>

                                    <div class="d-flex">
                                        <p class="font-weight-bold mr-2"> Address : </p>
                                        @if (session('address1') == NULL)
                                            <p>I'm living nowhere...</p>
                                        @else
                                            <p>{{Session::get('address1')}} @if (Session::has('address2'))
                                                {{', ' .Session::get('address2')}}
                                            @endif</p>
                                        @endif
                                    </div>

                                    <div class="d-flex">
                                        <p class="font-weight-bold mr-2"> City : </p>
                                        @if (session('city') == NULL)
                                            <p>..................................................</p>
                                        @else
                                            <p>{{Session::get('city')}}</p>
                                        @endif
                                    </div>

                                    <div class="d-flex">
                                        <p class="font-weight-bold mr-2"> Postal code : </p>
                                        @if (session('postal_code') == NULL)
                                            <p>..................................</p>
                                        @else
                                            <p>{{Session::get('postal_code')}}</p>
                                        @endif
                                    </div>

                                    <div class="d-flex">
                                        <p class="font-weight-bold mr-2"> Phone : </p>
                                        @if (session('phone') == NULL)
                                            <p>.............................................</p>
                                        @else
                                            <p>{{Session::get('phone')}}</p>
                                        @endif
                                    </div>

                                    <div class="d-flex">
                                        <p class="font-weight-bold mr-2"> Email : </p>
                                        <p>{{Session::get('email')}}</p>
                                    </div>

                                    <li class="list-group-item d-flex justify-content-between pl-5 pr-5">
                                        <h2><a class="" href="mailto:{{Session::get('email')}}">
                                            <i class="fa-solid fa-envelope"></i>
                                        </a></h2>
                                        <h2><a class="" href="">
                                            <i class="fa-brands fa-linkedin"></i>
                                        </a></h2>
                                        <h2><a class="" href="">
                                            <i class="fa-brands fa-github"></i>
                                        </a></h2>
                                    </li>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                            @if (Session::get('role') == 2 && Session::has('name'))
                                <form action="{{ route('jobsalert.create') }}">
                                    <button type="submit" class="btn btn-outline-primary float-right top-0 right-0 mr-3">
                                        Add job
                                    </button>
                                </form>
                                @include('includes.postsCompany')
                            @elseif(Session::get('role') == 2 && !Session::has('name'))
                                <h4 class="m-4 text-center">Create a company to add Job alert</h4>
                            @elseif (Session::get('role') == 1)

                                @if ($postJob != null)
                                    <div class="container mt-5">
                                        @foreach ($postJob as $job)
                                            <div class="bg-danger text-white center-block text-center col-2 pt-2 pb-3 ml-5 tslateY rounded">
                                                <h5 id="secteur">{{ $job['secteur'] }}</h5>
                                            </div>
                                            <div class="card mb-5" id="candidateJob">
                                                <div id="module" class="container">
                                                    <div class="collapse" id="candidateJob{{ $job['id']}}" aria-expanded="false">
                                                        <h5 class="card-header bg-primary text-white" id="title">
                                                            <b>{{ $job['title'] }}</b> / {{ $job['job_type'] }}
                                                        </h5>

                                                        <div class="card-body d-flex justify-content-end p-2">
                                                            <h6><em class="pr-3">{{ $job['updated_at'] }}</em></h6>
                                                        </div>

                                                        <div class="px-4 justify-content">
                                                            <h5 class="text-danger"><em>The company presentation</em></h5>
                                                            <h5><b>{{ $job['name'] }}</b></h5>
                                                            <p class="mt-1">{{ $job['description'] }}</p>
                                                        </div>

                                                        <div class="p-4 justify-content">
                                                            <h5><b class="text-danger"> Post description</b></h5>
                                                            <p class="mt-1">{{ $job['content'] }}</p>
                                                            <b><p>Wage : {{ $job['wage'] }}€ {{ $job['wage_type'] }}</p>
                                                            </b>
                                                        </div>
                                                    </div>

                                                    <a role="button" href="#candidateJob{{ $job['id'] }}"
                                                        id="button" class="collapsed btn btn-primary float-right m-3"
                                                        data-toggle="collapse" aria-expanded="false"
                                                        aria-controls="candidateJob"></a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p>See your candidatures for job</p>
                                @endif

                            @endif
                        </div>

                        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                            <form action="{{ route('users.update', Session::get('id')) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <h4 class="mt-3">Name</h4>
                                <hr>
                                <div class="d-flex">
                                    <div class="form-group col">
                                        <label for="firstname">Firstname</label>
                                        <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname"
                                        placeholder="Your firstname" name="firstname" value="{{Session::get('firstname')}}">
                                        @error('firstname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col">
                                        <label for="lastname">Lastname</label>
                                        <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname"
                                        placeholder="Your lastname" name="lastname" value="{{Session::get('lastname')}}">
                                        @error('lastname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <h4 class="mt-3">Email / Age</h4>
                                <hr>
                                <div class="d-flex">
                                    <div class="form-group col">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                        placeholder="Your email" name="email" value="{{Session::get('email')}}" readonly>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col">
                                        <label for="age">Age</label>
                                        <input type="date" class="form-control @error('age') is-invalid @enderror" id="age"
                                        placeholder="Your age" name="age" value="{{Session::get('age')}}" readonly>
                                        @error('age')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <label for="phone">Phone</label>
                                    <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                    placeholder="Your phone" name="phone" min="10" value="{{Session::get('phone')}}">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                @if (session('role') == 1)
                                    <h4 class="mt-3">Your description</h4>
                                    <hr>
                                    <div class="form-group col">
                                        <label for="description">Description</label>
                                        <textarea type="text" rows="10" class="form-control @error('description') is-invalid @enderror" id="description"
                                        placeholder="Talk about you..." name="description">{{Session::get('description')}}</textarea>
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
                                        <input type="text" class="form-control @error('address1') is-invalid @enderror" id="address1"
                                        placeholder="Your address 1" name="address1" value="{{Session::get('address1')}}">
                                        @error('address1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col">
                                        <label for="address2">Address 2</label>
                                        <input type="text" class="form-control @error('address2') is-invalid @enderror" id="address2"
                                        placeholder="Your address 2" name="address2" value="{{Session::get('address2')}}">
                                        @error('address2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="d-flex">
                                        <div class="form-group col">
                                            <label for="country">Country</label>
                                            <input type="text" class="form-control @error('country') is-invalid @enderror" id="country"
                                            placeholder="Your country" name="country" value="{{Session::get('country')}}">
                                            @error('country')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"
                                            placeholder="Your city" name="city" value="{{Session::get('city')}}">
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col">
                                            <label for="postal_code">Postal code</label>
                                            <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code"
                                            placeholder="Your postal code" name="postal_code" value="{{Session::get('postal_code')}}">
                                            @error('postal_code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                <div class="col text-center mb-3">
                                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                                </div>
                            </form>

                            <h4 class="mt-3">Delete Account</h4>
                            <hr>
                            <p class="m-3">Before to delete your account, Be sure of your choice, this will result in a total deletion of your personal information linked to your account, the deletion of your ads.</p>
                            <div class="col text-center mb-3">
                                <form action="{{route('users.destroy', Session::get('id'))}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-block text-white">Delete</button>
                                </form>
                            </div>
                        </div>

                        @if (session('role') == 2)
                            <div class="tab-pane fade" id="company" role="tabpanel" aria-labelledby="settings-tab">
                                <form action="{{ route('companies.update', Session::get('id')) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <h4 class="mt-3">Company Name</h4>
                                    <hr>
                                    <div class="d-flex">
                                        <div class="form-group col">
                                            <label for="name">Company Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                                placeholder="The company name" name="name"
                                                value="{{ Session::get('name') }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <h4 class="mt-3">Email</h4>
                                    <hr>
                                    <div class="d-flex">
                                        <div class="form-group col">
                                            <label for="email">Email</label>
                                            <input type="email"
                                                class="form-control @error('email') is-invalid @enderror" id="email"
                                                placeholder="Your email" name="email"
                                                value="{{ Session::get('email') }}" readonly>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <h4 class="mt-3">Description</h4>
                                    <hr>
                                    <div class="form-group col">
                                        <label for="description">Description's company</label>
                                        <textarea type="text" rows="10" class="form-control @error('description') is-invalid @enderror" id="description"
                                            placeholder="Talk about your company"
                                            name="description">{{ Session::get('description') }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <h4 class="mt-3">Siret</h4>
                                    <hr>
                                    <div class="form-group col">
                                        <label for="siret" class="text-secondary">SIRET (Fonctionality incoming)</label>
                                        <input type="number" class="form-control @error('siret') is-invalid @enderror"
                                            id="siret" placeholder="Fonctionality incoming" name="siret"
                                            value="{{-- Session::get('siret') --}}" disabled>
                                        @error('siret')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <h4 class="mt-3">Company address</h4>
                                    <hr>
                                    <div class="form-group col">
                                        <label for="address1">Address 1</label>
                                        <input type="text" class="form-control @error('address1') is-invalid @enderror" id="address1"
                                            placeholder="Your address 1" name="address1"
                                            value="{{ Session::get('address1') }}">
                                        @error('address1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col">
                                        <label for="address2">Address 2</label>
                                        <input type="text" class="form-control @error('address2') is-invalid @enderror" id="address2"
                                            placeholder="Your address 2" name="address2"
                                            value="{{ Session::get('address2') }}">
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
                                                value="{{ Session::get('country') }}">
                                            @error('country')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"
                                                placeholder="Your city" name="city"
                                                value="{{ Session::get('city') }}">
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
                                                value="{{ Session::get('postal_code') }}">
                                            @error('postal_code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col text-center mb-3">
                                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                                    </div>
                                </form>

                                <h4 class="mt-3">Delete Company</h4>
                                <hr>
                                <p class="m-3">Before to delete your company, Be sure of your choice, this will result in a total deletion of your company's informations linked to your account, the deletion of your ads. </p>
                                <div class="col text-center mb-3">
                                    <form action="{{route('companies.destroy', Session::get('id'))}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-block text-white">
                                            Delete
                                        </button>
                                    </form>
                                </div>

                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </main>
        @include('includes.footer')
    </body>
</html>
