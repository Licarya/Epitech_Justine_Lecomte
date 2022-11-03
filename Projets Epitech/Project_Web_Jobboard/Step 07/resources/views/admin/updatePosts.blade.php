<!doctype html>
<html lang="en">
    <head>
        @include('includes.head')
        <title>Edit {{$post->name}}</title>
    </head>
    <body>
        <header>
            @include('includes.navbar')
        </header>

        <main class="container p-5">
            <a class="arrowBack mt-4" href="{{route('admin.posts.index')}}">
                <i class="fa-solid fa-circle-arrow-left text-primary"></i>
            </a>
            <div class="content">
                <h1 class="pb-3 pl-3 pr-3 pt-2 tslateYh1 border-0 rounded"><span class="btn btn-outline-success btn-lg">Edit</span> {{$post->title}}</h1>

                <form class="p-3" action="{{ route('admin.posts.update', $post->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group col">
                        <label for="title">Title</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                            id="title" placeholder="Job Title" name="title"
                            value="{{ $post->title }}">
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
                        name="content">{{ $post->content }}</textarea>
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
                            value="{{ $post->wage }}">
                            @error('wage')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <div class="input-group-append">
                                <select class="form-select btn btn-light border p-2 @error('wage_type') is-invalid @enderror"
                                name="wage_type">
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

                    <div class="d-flex">
                        <div class="col text-center mb-3">
                            <a href="{{route('admin.posts.index')}}" class="btn btn-secondary btn-block">Cancel</a>
                        </div>
                        <div class="col text-center mb-3">
                            <button type="submit" class="btn btn-primary btn-block">
                                Update job
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
        @include('includes.footer')
    </body>
</html>
