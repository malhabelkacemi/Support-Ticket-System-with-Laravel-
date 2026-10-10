@extends('layouts.dashboardLayout')

@section('title', 'Edit user')

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card text-dark">
            <div class="card-body">
                <h4 class="card-title">Edit a user</h4>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form
                    action="{{ route('users.update', $user) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="forms-sample"
                >
                    @method('PUT')
                    @csrf

                    <div class="form-group">
                        <label for="name">Username</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            id="name"
                            placeholder="name"
                            value="{{ old('name', $user->name) }}"
                            required
                        >
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input
                            type="text"
                            name="email"
                            class="form-control"
                            id="email"
                            placeholder="email"
                            value="{{ old('email', $user->email) }}"
                            required
                        >
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select
                            class="form-control"
                            id="role"
                            name="role"
                            required
                        >
                            <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>
                                User
                            </option>
                            <option value="agent" {{ old('role', $user->role) === 'agent' ? 'selected' : '' }}>
                                Agent
                            </option>
                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>
                        </select>
                    </div>

                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" value={{ old('password') }} class="form-control" name="password" id="password"  placeholder="Password">
                      </div>

                      <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" value={{ old('password_confirmation') }} class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password">
                      </div>


                    <button type="submit" class="btn btn-primary mr-2">
                        Update
                    </button>

                    <a href="{{ route("users.index") }}" class="btn btn-light">Cancel</a>


                </form>
            </div>
        </div>
    </div>
@endsection
