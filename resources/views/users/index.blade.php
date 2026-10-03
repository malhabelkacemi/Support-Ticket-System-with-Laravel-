@extends('layouts.dashboardLayout')

@section('title', 'Users')

@section('content')
            <div class="table-responsive">
                <h4 class="card-title">Users Table</h4>
                    <div class="mt-2 mb-5">

                            <a href="{{ route("users.create") }}" class="btn btn-primary btn-lg"> + Create New user</a>

                    </div>
                  <table class="table table-sm">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td> {{$user->name}}  </td>
                            {{-- <td> {{ Str::limit($user->title,15) }}  </td> --}}
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                               <a href="" class="btn btn-warning text-dark ">Update</a>
                               <a href="" class="btn btn-danger "> X </a>
                            </td>

                        </tr>
                        @endforeach
                        </tbody>
                   </table>
            </div>



{{ $users->links() }}

@endsection


