<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLongTitle">Create new post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('admin.posts.store') }}" method="POST">
                    @csrf

                    <div class="form-group ml-3">
                        <label for="name">Choose a company</label>
                        <select class="form-select" aria-label="Select user" name="companies_id">
                            <option disabled selected value>...</option>
                            @foreach ($companies as $company)
                                <option id="userSelect{{$company->id}}" value="{{$company->id}}">
                                    {{$company->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('companies_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col">
                        <label for="title">Title</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                            id="title" placeholder="Job Title" name="title"
                            value="">
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

                    <div class="col text-center mb-3">
                        <button type="submit" class="btn btn-primary btn-block">
                            Add Job
                        </button>
                    </div>
                </form>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
