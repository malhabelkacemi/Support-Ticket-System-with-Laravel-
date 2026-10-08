@extends('layouts.dashboardLayout')

@section('title', 'Edit category')

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card text-dark">
            <div class="card-body">
                <h4 class="card-title">Edit a category</h4>

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
                    action="{{ route('categories.update', $category) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="forms-sample"
                >
                    @method('PUT')
                    @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            id="name"
                            placeholder="Name"
                            value="{{ old('name', $category->name) }}"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input
                            type="text"
                            name="description"
                            class="form-control"
                            id="description"
                            placeholder="Description"
                            value="{{ old('description', $category->description) }}"
                            required
                        >
                    </div>


                    <div class="form-group">
                        <label for="is_visible">Is visible</label>
                        <select
                            class="form-control"
                            id="is_visible"
                            name="is_visible"
                            required
                        >
                            <option value="1" {{ old('is_visible', $category->is_visible) === '1' ? 'selected' : '' }}>
                                Yes
                            </option>
                            <option value="0" {{ old('is_visible', $category->is_visible) === '0' ? 'selected' : '' }}>
                                No
                            </option>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary mr-2">
                        Update
                    </button>

                    <a href="{{ route("categories.index") }}" class="btn btn-light">Cancel</a>


                </form>
            </div>
        </div>
    </div>
@endsection
