<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLongTitle">Create new company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('admin.companies.store') }}" method="POST">
                    @csrf

                    <div class="form-group ml-3">
                        <label for="name">Choose a user</label>
                        <select class="form-select" aria-label="Select user" name="users_id">
                            <option selected>...</option>
                            @foreach ($usersClear as $user)
                                <option id="userSelect{{$user->id}}" value="{{$user->id}}">
                                    {{$user->firstname}} {{$user->lastname}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex">
                        <div class="form-group col">
                            <label for="name">Company Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" placeholder="The company name" name="name"
                            value="{{old('name')}}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for="siret">SIRET (Fonctionality incoming)</label>
                            <input type="number" class="form-control @error('siret') is-invalid @enderror"
                            id="siret" placeholder="Fonctionality incoming" name="siret"
                            value="{{old('siret')}}" disabled>
                            @error('siret')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group col">
                        <label for="description">Description's company</label>
                        <textarea type="text" rows="10" class="form-control @error('description') is-invalid @enderror"
                        id="description" placeholder="Talk about your company"
                        name="description">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col text-center mb-3">
                        <button type="submit" class="btn btn-primary btn-block">
                            Add company
                        </button>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
