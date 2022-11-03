<!doctype html>
<html lang="en">
    <head>
        @include('includes.head')
        <title>View Companies</title>
    </head>
    <body>
        <header>
            @include('includes.navbar')
        </header>

        <div class="container-fluid p-5">
            <div class="content">
                <h1 class="btn btn-outline-success btn-lg">Companies list</h1>
                <div class="d-flex justify-content-between mb-2">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{route('admin.users.index')}}" class="btn btn-primary">users</a>
                        <a href="{{route('admin.companies.index')}}" class="btn btn-primary">companies</a>
                        <a href="{{route('admin.posts.index')}}" class="btn btn-primary">posts</a>
                    </div>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal">
                        New Company
                    </button>
                </div>

                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">USER_ID</th>
                            <th scope="col">NAME</th>
                            <th scope="col">ADDRESS</th>
                            <th scope="col">DESCRIPTION</th>
                            <th scope="col">ADMIN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        @foreach ($companies as $company)
                            <tr>
                                <td class="inner-table">{{$i++}}</td>
                                <td class="inner-table">{{ $company->id }}</td>
                                <td class="inner-table">{{ $company->users_id }}</td>
                                <td class="inner-table">{{ $company->name }}</td>
                                <td class="inner-table" id="collapseUser">
                                    <div class="collapse text-left" id="collapseAddress{{$company->id}}" aria-expanded="false">
                                        @foreach($addresses as $address)
                                            @if ($address->users_id == $company->users_id)
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item d-flex">
                                                        <p class="text-primary font-weight-bold">Address1 : &nbsp;</p>
                                                        {{$address->address1}}
                                                    </li>
                                                    <li class="list-group-item d-flex">
                                                        <p class="text-primary font-weight-bold">Address2 : &nbsp;</p>
                                                        {{$address->address2}}
                                                    </li>
                                                    <li class="list-group-item d-flex">
                                                        <p class="text-primary font-weight-bold">Country : &nbsp;</p>
                                                        {{$address->country}}
                                                        </li>
                                                    <li class="list-group-item d-flex">
                                                        <p class="text-primary font-weight-bold">City : &nbsp;</p>
                                                        {{$address->city}}
                                                        </li>
                                                    <li class="list-group-item d-flex">
                                                        <p class="text-primary font-weight-bold">Postal code : &nbsp;</p>
                                                        {{$address->postal_code}}
                                                    </li>
                                                </ul>
                                            @endif
                                        @endforeach
                                    </div>
                                    <button type="button" class="collapsed btn btn-info" data-toggle="collapse"
                                    href="#collapseAddress{{$company->id}}" aria-expanded="false"
                                    aria-controls="collapseDescription"></button>
                                </td>

                                <td class="inner-table" id="collapseUser">
                                    <div class="collapse text-left" id="collapseDescription{{$company->id}}" aria-expanded="false">
                                        {{$company->description}}
                                    </div>
                                    <button type="button" class="collapsed btn btn-info" data-toggle="collapse"
                                    href="#collapseDescription{{$company->id}}" aria-expanded="false"
                                    aria-controls="collapseDescription"></button>
                                </td>

                                <td class="inner-table d-flex justify-content-around border-0">
                                    <form action="{{route('admin.companies.edit',$company->id)}}" method="GET">
                                        @csrf

                                        <button type="submit" class="btn btn-primary">
                                            Edit
                                        </button>
                                    </form>

                                    <form action="{{route('admin.companies.destroy',$company->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>


                        @endforeach

                        @include('includes.adminFormCompanyCreate')

                    </tbody>
                </table>
                <div class="pagination justify-content-end">
                    {{$companies->links()}}
                </div>
            </div>
        </div>
        @include('includes.footer')
    </body>
</html>
