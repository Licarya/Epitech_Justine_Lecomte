@foreach ($posts as $jobs)
    <div class="container mt-5">
        <div class=" bg-danger text-white center-block text-center col-2 pt-2 pb-3 ml-5 tslateY rounded">
            <h5 class="" id="secteur">{{ $jobs->secteur }}</h5>
        </div>

        <div class="card" id="jobAlert">
            <div id="module" class="container">
                <div class="collapse" id="collapseExample{{ $jobs->id }}" aria-expanded="false">
                    <h5 class="card-header bg-primary text-white" id="title">
                        <b>{{ $jobs->title }}</b> / {{ $jobs->job_type }}
                    </h5>

                    <div class="card-body d-flex justify-content-end p-2">
                        <h6><em class="mr-3">{{ $jobs->updated_at }}</em></h6>
                    </div>

                    <div class="px-4 justify-content">
                        <h5><b class="text-danger"> Post description</b></h5>
                        <p>{{ $jobs->content }}</p>
                        <b><p>Wage : {{ $jobs->wage }}€ {{ $jobs->wage_type }}</p>
                        </b>
                    </div>

                    <div class="d-flex">
                        <button class="btn btn-primary text-white col-1 ml-3 mb-1"
                            data-toggle="collapse"
                            data-target="#updateJob{{ $jobs->id }}"
                            aria-expanded="false" aria-controls="updateJob">
                            Edit Job
                        </button>

                        <form action="{{route('postalert.show',$jobs->id)}}" method="GET" class="col ml-1 mb-1 p-0">
                            @csrf
                            <button class="btn btn-warning text-white">
                                See candidate
                            </button>
                        </form>

                        <form action="{{route('jobsalert.destroy',$jobs->id)}}" method="POST" class="col mr-3 mb-1 p-0 text-right">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger text-white">
                                Delete Job
                            </button>
                        </form>
                    </div>
                </div>
                <a role="button" href="#collapseExample{{ $jobs->id }}"
                    class="collapsed btn btn-primary float-right m-3"
                    data-toggle="collapse" aria-expanded="false"
                    aria-controls="collapseExample">
                </a>
            </div>

            <div id="updateJob{{ $jobs->id }}" class="collapse">
                <div class="container p-0 mt-5 rounded">
                    <h5 class="p-2 bg-primary text-white text-center">Update {{ $jobs->title }}</h5>

                    <form action="{{ route('jobsalert.update', $jobs->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group col">
                            <label for="title">Title</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                id="title" placeholder="Job Title" name="title"
                                value="{{ $jobs->title }}">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="input-group-append">
                                    <select class="form-select btn btn-light border p-2 @error('job_type') is-invalid @enderror" name="job_type">
                                        <option value="{{ $jobs->job_type }}" selected>{{ $jobs->job_type }}</option>
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
                                        <option value="{{ $jobs->secteur }}" selected>{{ $jobs->secteur }}</option>
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
                            name="content">{{ $jobs->content }}</textarea>
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
                                value="{{ $jobs->wage }}">
                                @error('wage')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="input-group-append">
                                    <select class="form-select btn btn-light border p-2 @error('wage_type') is-invalid @enderror"
                                    name="wage_type">
                                        <option value="{{ $jobs->wage_type }}" selected>{{ $jobs->wage_type }}</option>
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

                        <div class="col text-center mb-3">
                            <button type="submit" class="btn btn-primary btn-block">
                                Update job
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
