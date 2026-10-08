@extends('layouts.dashboardLayout')

@section('title', 'Categories')

@section('content')
    <div class="table-responsive">
        <div class="d-flex align-items-center gap-4">
            <h4 class="card-title">Categories Table</h4>
                    <div class="mb-4">
                        <a href="{{ route('categories.create') }}" class="btn btn-primary">+ Create New Category</a>
                    </div>

        </div>

        <form method="GET" action="{{ route('categories.index') }}" >
            <div class="row mb-3 row align-items-end">

                {{-- visibility --}}
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="filtre_visible">Visible</label>
                        <select class="form-control" id="filtre_visible" name="filtre_visible" onchange="this.form.submit()">
                            <option value="all" @if(request('filtre_visible')==='all' || !request('filtre_visible')) selected @endif>All</option>
                            <option value="Yes" {{ request('filtre_visible') === 'Yes' ? 'selected' : '' }}>Yes</option>
                            <option value="No" {{ request('filtre_visible') === 'No' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                </div>

                {{-- Search + Clear --}}
                <div class="col-md-3 ">
                    <div class="form-group">
                        <div class="d-flex gap-2 align-items-center">

                            <input
                                type="text"
                                name="filter_search"
                                value="{{ request('filter_search') }}"
                                class="form-control"
                                placeholder="Search..."
                                oninput="this.form.submit()"
                            >

                            @if(request('filter_search') ||request()->filled('filtre_visible'))
                                <a href="{{ route('categories.index') }}"
                                   class="btn btn-danger text-gray-500 hover:text-gray-700 text-sm transition flex items-center gap-1">
                                    Clear
                                </a>
                            @endif
                            <button type="submit" class="d-none">Apply</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>

        {{-- Affichage de messages de succes --}}
        <div>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        @if($categories->isEmpty())
            <div class="alert alert-info">
                No data available for these filters.
            </div>
        @else

        <table class="table table-sm mb-2">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Slug</th>
                    <th>Is_visible</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->slug  }}</td>
                        <td>{{ $category->is_visible == "1" ? "Yes":"No" }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning text-dark">Update</a>

                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer cette category ?')">
                                    X
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $categories->links() }}
        @endif
    </div>
@endsection
