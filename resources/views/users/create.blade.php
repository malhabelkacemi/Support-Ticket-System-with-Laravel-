@extends('layouts.dashboardLayout')
@section('title', 'Users')
@section('content')

              <div class="grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Create A New User</h4>
                                    <div>
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    </div>

                    <form class="forms-sample" method="POST" action="{{ route("users.store") }}">
                    @csrf
                      <div class="form-group">
                        <label for="name">Username</label>
                        <input type="text" class="form-control" value="{{ old('name') }}" name="name"  id="name" placeholder="Username">
                      </div>
                      <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                        value="{{ old('email') }}"
                        >
                      </div>

                      <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" name="role" id="role">
                          <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
                          <option value="agent" {{ old('role') === 'agent' ? 'selected' : '' }}>Agent</option>
                          <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password"  placeholder="Password">
                      </div>
                      <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password">
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>




@endsection
