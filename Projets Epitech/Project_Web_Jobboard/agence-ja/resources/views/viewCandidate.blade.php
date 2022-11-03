<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.head')
        <title>Add job</title>
    </head>
    <body>
        <header>
            @include('includes.navbar')
        </header>

        <main class="container mt-5 p-0">
            <a class="arrowBack" href="{{route('dashboard')}}">
                <i class="fa-solid fa-circle-arrow-left text-primary"></i>
            </a>

            @foreach ($notifs as $notif)
                <div class="mb-3">
                    <div class="card mb-3" id="jobAlert">
                        <div id="module" class="mb-3">
                            <h5 class="card-header bg-warning text-white" id="title">
                                <b>{{ $notif->firstname }} - {{ $notif->lastname }}</b>
                            </h5>

                            <div class="card-body d-flex justify-content-around p-2">
                                <h6 class="text-primary"><b class="text-danger">Email : </b>{{ $notif->email }}</h6>
                                <h6 class="text-primary"><b class="text-danger">Phone : </b>{{ $notif->phone }}</h6>
                            </div>

                            <div class="px-4 justify-content">
                                <h6 class="text-primary"><b class="text-danger">Message : </b></h6>
                                <p>{{ $notif->message }}</p>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

        </main>
        @include('includes.footer')
    </body>
</html>
