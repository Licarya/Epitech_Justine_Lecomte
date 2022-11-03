<html lang="en">
<head>
    @include('includes.head')
    <title>Add job</title>
</head>
    <header>
        @include('includes.navbar')
    </header>
    <body>

        <main class="container mt-5">
            <a class="arrowBack mt-2" href="{{route('dashboard')}}">
                <i class="fa-solid fa-circle-arrow-left text-primary"></i>
            </a>
            <div class="container p-0 mt-5 rounded">
                <h2 class="p-3 bg-primary text-white">Add a JobAlert</h2>

                <form class="p-3" action="{{ route('jobsalert.store') }}" method="POST">
                    @csrf
                    <div class="form-group col">
                        <label for="title">Title</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                            id="title" placeholder="Job Title" name="title"
                            value="{{ old('title') }}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <div class="input-group-append">
                                <select class="form-select btn btn-light border p-2 @error('job_type') is-invalid @enderror" name="job_type">
                                    <option value="unrenseigned" selected>Job Type</option>
                                    <option value="CDI">CDI</option>
                                    <option value="CDD">CDD</option>
                                    <option value="alternance">Alternance</option>
                                    <option value="seasonal">Seasonal</option>
                                    <option value="freelance">Freelance</option>
                                    <option value="part time">Part-time</option>
                                </select>
                                @error('job_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <select class="form-select btn btn-light border ml-3 @error('secteur') is-invalid @enderror" name="secteur">
                                    <option value="unrenseigned" selected>Secteur</option>
                                    <option value="Agriculture">Agriculture</option>
                                    <option value="Agroalimentaire">Agroalimentaire</option>
                                    <option value="Banque assurance">Banque assurance</option>
                                    <option value="Communication">Communication</option>
                                    <option value="Informatique">Informatique</option>
                                    <option value="Artisanat">Artisanat</option>
                                    <option value="Logistique">Logistique</option>
                                    <option value="BTP">BTP</option>
                                    <option value="Commerce">Commerce</option>
                                    <option value="Medical">Medical</option>
                                    <option value="Automobile">Automobile</option>
                                </select>
                                @error('secteur')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="form-group col">
                        <label for="content">Job detail</label>
                        <textarea class="form-control @error('content') is-invalid @enderror"
                        id="content" rows="10" placeholder="Write a complete description of job"
                        name="content">{{ old('content') }}</textarea>
                        @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col">
                        <label for="wage">Wage</label>
                        <div class="input-group">
                            <input type="number" class="form-control @error('wage') is-invalid @enderror"
                            id="wage" placeholder="Write job wage" min="0" name="wage"
                            value="{{ old('wage') }}">
                            @error('wage')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <div class="input-group-append">
                                <select class="form-select btn btn-light border p-2 @error('wage_type') is-invalid @enderror" name="wage_type">
                                    <option value="" selected>Wage Type</option>
                                    <option value="/month">/month</option>
                                    <option value="/year">/year</option>
                                </select>
                                @error('wage_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col text-center">
                        <button type="submit" class="btn btn-primary btn-block">
                            Post Job
                        </button>
                    </div>
                </form>
            </div>

        </main>
        @include('includes.footer')
    </body>
</html>
