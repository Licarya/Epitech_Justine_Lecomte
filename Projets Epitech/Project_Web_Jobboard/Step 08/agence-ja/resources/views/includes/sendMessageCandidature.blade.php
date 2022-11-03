<div class="modal fade" id="candidatureModal{{ $job->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLongTitle">Candidate for {{$job->title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('postalert.store', $job->id) }}" method="POST">
                    @csrf
                    <div class="d-flex">
                        <div class="form-group col">
                            <label for="firstname">Firstname</label>
                            <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                                id="firstname" placeholder="Your firstname" name="firstname">
                            @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for="lastname">Lastname</label>
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                                id="lastname" placeholder="Your lastname" name="lastname">
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
                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                id="email" placeholder="Your Email" name="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                id="phone" placeholder="Your phone" name="phone">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group col">
                        <label for="message">Message</label>
                        <textarea type="text" rows="10" class="form-control @error('message') is-invalid @enderror" id="message"
                            placeholder="If you want, you can display a message for company" name="message"></textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col text-center mb-3">
                        <button type="submit" class="btn btn-primary btn-block">Candidate for this job</button>
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
