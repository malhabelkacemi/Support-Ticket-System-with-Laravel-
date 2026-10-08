@extends('layouts.dashboardLayout')

@section('title', 'Users')

@section('content')
<div class="table-responsive">

    <div class="d-flex align-items-center gap-4 mb-3">
        <h4 class="card-title">Users Table</h4>
        <div>
            <a href="{{ route('users.create') }}" class="btn btn-primary">+ Create New User</a>
        </div>
    </div>

    <form method="GET" action="{{ route('users.index')}}">
        <div class="row align-items-end">
            {{-- role --}}
            <div class="col-md-2">
                <div class="form-group">
                    <label for="filtre_role">Role</label>
                    <select class="form-control" id="filtre_role" name="filtre_role" onchange="this.form.submit()">
                        <option value="all" @if(request('filtre_role')==='all' || !request('filtre_role')) selected @endif>All</option>
                        <option value="admin" @if(request('filtre_role')==='admin' ) selected @endif>Admin</option>
                        <option value="agent" @if(request('filtre_role')==='agent' ) selected @endif>Agent</option>
                        <option value="user" @if(request('filtre_role')==='user' ) selected @endif>User</option>
                    </select>

                </div>

            </div>

            {{-- Search + Clear --}}
            <div class="col-md-3">
                <div class="form-group">
                    <div class="d-flex gap-2 align-items-center">
                        <input type="text" name="filter_search" value="{{ request('filter_search') }}" class="form-control" placeholder="Search..." oninput="this.form.submit()">
                        @if(request('filter_search') || request()->filled('filtre_role'))
                        <a href="{{ route('users.index') }}" class="btn btn-danger btn-sm">
                            Clear
                        </a>
                        @endif
                        <button type="submit" class="d-none">Apply</button>
                    </div>
                </div>
            </div>

        </div>
    </form>

    {{-- Messages de succès --}}
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if($users->isEmpty())
    <div class="alert alert-info">
        No data available for these filters.
    </div>
    @else
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
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <a href="{{ route("users.edit",$user) }}" class="btn btn-warning text-dark">Update</a>

                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer cet utilisateur ?')">
                                    X
                                </button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
    @endif

</div>
@endsection
