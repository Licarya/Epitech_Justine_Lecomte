<!doctype html>
<html lang="en">
    <head>
        @include('includes.head')
        <title>View Posts</title>
    </head>
    <body>
        <header>
            @include('includes.navbar')
        </header>

        <main class="container-fluid p-5">

            <div class="content">
                <h1 class="btn btn-outline-success btn-lg">Posts list</h1>
                <div class="d-flex justify-content-between mb-2">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{route('admin.users.index')}}" class="btn btn-primary">users</a>
                        <a href="{{route('admin.companies.index')}}" class="btn btn-primary">companies</a>
                        <a href="{{route('admin.posts.index')}}" class="btn btn-primary">posts</a>
                    </div>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal">
                        New Post
                    </button>
                </div>
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">COMPANIES_ID</th>
                            <th scope="col">JOB_TYPE</th>
                            <th scope="col">SECTEUR</th>
                            <th scope="col">CONTENT</th>
                            <th scope="col">WAGE / WAGE_TYPE</th>
                            <th scope="col">ADMIN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        @foreach ($posts as $post)
                            <tr>
                                <td class="inner-table">{{$i++}}</td>
                                <td class="inner-table">{{ $post->id }}</td>
                                <td class="inner-table">{{ $post->companies_id }}</td>
                                <td class="inner-table">{{ $post->job_type }}</td>
                                <td class="inner-table">{{ $post->secteur }}</td>
                                <td class="inner-table" id="collapseUser">
                                    <div class="collapse text-left" id="collapseDescription{{$post->id}}"
                                    aria-expanded="false">
                                                {{$post->content}}
                                    </div>
                                    <button type="button" class="collapsed btn btn-info" data-toggle="collapse"
                                    href="#collapseDescription{{$post->id}}" aria-expanded="false"
                                    aria-controls="collapseDescription"></button>
                                </td>
                                <td class="inner-table">{{ $post->wage }}€ {{ $post->wage_type }}</td>
                                <td class="inner-table d-flex justify-content-around  border-0">

                                    <form action="{{route('admin.posts.edit',$post->id)}}" method="GET">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            Edit
                                        </button>
                                    </form>

                                    <form action="{{route('admin.posts.destroy',$post->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        @include('includes.adminFormPostCreate')
                    </tbody>
                </table>

                <div class="pagination justify-content-end">
                    {{$posts->links()}}
                </div>

            </div>
        </main>
        @include('includes.footer')
    </body>
</html>
