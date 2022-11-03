<!doctype html>
<html lang="en">
    <head>
        @include('includes.head')
        <title>View Users</title>
    </head>
    <body>
        <header>
            @include('includes.navbar')
        </header>

        <main class="container-fluid p-5">

            <div class="content">
                <h1 class="btn btn-outline-success btn-lg">Users list</h1>
                <div class="d-flex justify-content-between mb-2">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{route('admin.users.index')}}" class="btn btn-primary">users</a>
                        <a href="{{route('admin.companies.index')}}" class="btn btn-primary">companies</a>
                        <a href="{{route('admin.posts.index')}}" class="btn btn-primary">posts</a>
                    </div>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal">
                        New User
                    </button>
                </div>

                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">ROLE</th>
                            <th scope="col">PASSWORD</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">FIRSTNAME</th>
                            <th scope="col">LASTNAME</th>
                            <th scope="col">AGE</th>
                            <th scope="col">PHONE</th>
                            <th scope="col">DESCRIPTION</th>
                            <th scope="col">ADMIN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        @foreach ($users as $user)
                            <tr>
                                <td class="inner-table">{{$i++}}</td>
                                <td class="inner-table">{{ $user->id }}</td>
                                <td class="inner-table">{{ $user->role }}</td>
                                <td class="inner-table" id="resizePassword"><p class="bg-dark text-white">{{ $user->password }}</p></td>
                                <td class="inner-table">{{ $user->email }}</td>
                                <td class="inner-table">{{ $user->firstname }}</td>
                                <td class="inner-table">{{ $user->lastname }}</td>
                                <td class="inner-table">{{ $user->age }}</td>
                                <td class="inner-table">{{ $user->phone }}</td>
                                <td class="inner-table" id="collapseUser">
                                    <div class="collapse text-left" id="collapseDescription{{$user->id}}" aria-expanded="false">
                                        @foreach ($companies as $company)
                                            @if ($user->role == 1)
                                                {{ $user->description }}
                                            @elseif ($user->role == 2 && $user->id == $company->users_id)
                                                {{$company->description}}
                                            @endif
                                        @endforeach
                                    </div>
                                    <button type="button" class="collapsed btn btn-info" data-toggle="collapse"
                                    href="#collapseDescription{{$user->id}}" aria-expanded="false"
                                    aria-controls="collapseDescription"></button>
                                </td>

                                <td class="inner-table d-flex justify-content-around  border-0">
                                    <form action="{{route('admin.users.edit',$user->id)}}" method="GET">
                                        @csrf

                                        <button type="submit" class="btn btn-primary">
                                            Edit
                                        </button>
                                    </form>

                                    <form action="{{route('admin.users.destroy',$user->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        @include('includes.adminFormUserCreate')
                    </tbody>
                </table>

                <div class="pagination justify-content-end">
                    {{$users->links()}}
                </div>
            </div>
        </main>
        @include('includes.footer')
    </body>
</html>
