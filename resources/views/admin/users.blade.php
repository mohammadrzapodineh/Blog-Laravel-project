@extends('shared.dashboard.main-layout')


@section('title', 'Users')

@section('content')
                   <div class="col-sm-12 col-xl-12">

                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">The Last 10 Users</h6>
                            <table class="table table-dark">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">UserId</th>
                                        <th scope="col">isAdmin</th>
                                        <th scope="col">isAuthor</th>
                                        <th scope="col">isStaff</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->is_admin ? "True" : "False" }}</td>
                                        <td>{{ $user->is_author ? "True" : "False" }}</td>
                                        <td>{{ $user->is_staff ? "True" : "False" }}</td>
                                        <td>
                                        <a href="{{ route('admin.users.edit', $user) }}" class="text-warning">
                                            <button class="btn btn-warning">
                                            Edit
                                            </button>
                                        </a>
                                        <form method="post" action="{{ route('admin.users.destroy', $user) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Delete</button></form>
                                        
                                        </td>
                                    </tr>
                                @empty
                                <div class="alert alert-danger" role="alert">
                               The User List If Empty!
                            </div>
                                @endforelse

                                </tbody>
                            </table>
                        </div>
                       <div class="d-flex justify-content-center mt-3">
    {{ $users->links() }}
</div>

                    </div>
@endsection