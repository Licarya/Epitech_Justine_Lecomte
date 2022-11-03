<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.head')
        <title>Home</title>
    </head>
    <body>
        <header>
            @include('includes.navbar')
        </header>

        <main>
            <img class="bg-img img-fluid" src="{{asset('img/job-head.jpg')}}" alt="Head job image">
            <div class="container mt-5 master-container">
                <h1 class="text-primary bg-transparent mb-5">New jobs</h1>

                @foreach ($alljob as $job)
                    <div>
                        <div class="bg-danger text-white center-block text-center col-2 pt-2 pb-3 ml-5 tslateY rounded">
                            <h5 class="" id="secteur">{{ $job->secteur }}</h5>
                        </div>

                        <div class="card mb-5" id="jobAlert">
                            <div id="module">
                                <div class="collapse" id="collapseExample{{ $job->id }}" aria-expanded="false">
                                    <h5 class="card-header bg-primary text-white" id="title">
                                        <b>{{ $job->title }}</b> / {{ $job->job_type }}
                                    </h5>

                                    <div class="card-body d-flex justify-content-end p-2">
                                        <h6><em class="pr-3">{{ $job->updated_at }}</em></h6>
                                    </div>

                                    <div class="px-4 justify-content">
                                        <h5 class="text-danger"><em> The company presentation</em></h5>
                                        <h5><b>{{ $job->name }}</b></h5>
                                        <p class="mt-1">{{ $job->description }}</p>
                                    </div>

                                    <div class="p-4 justify-content">
                                        <h5><b class="text-danger">Post description</b></h5>
                                        <p class="mt-1">{{ $job->content }}</p>
                                        <b><p>Wage : {{ $job->wage }}€ {{ $job->wage_type }}</p></b>
                                    </div>

                                    @if (session('role') == 1)
                                        @include('includes.sendMessageCandidature')
                                        <button type="button" class="d-flex btn btn-primary mx-auto mb-2" data-toggle="modal" data-target="#candidatureModal{{ $job->id }}">Candidate</button>
                                    @elseif(session('role') == 2)
                                        <p class="bg-primary text-white center-block text-center p-2">You are a company, you can not candidate for job</p>
                                    @else
                                        <p class="bg-primary text-white center-block text-center p-2">You aren't connected, please <b><a class="text-white no-c text-danger" href="{{ route('login') }}">login</a></b> you or <b><a
                                            class="text-white no-c text-danger" href="{{ route('users.create') }}">register</a> </b>you</p>
                                    @endif
                                </div>

                                <a role="button" href="#collapseExample{{ $job->id }}"
                                    class="collapsed btn btn-primary float-right m-3"
                                    data-toggle="collapse" aria-expanded="false"
                                    aria-controls="collapseExample">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="pagination justify-content-end">
                    {{$alljob->links()}}
                </div>
            </div>

        </main>
        @include('includes.footer')
    </body>
</html>
