@extends('layouts.dashboardLayout')

@section('title', 'Tickets')

@section('content')
    <div class="table-responsive">
        <div class="d-flex align-items-center gap-4">
            <h4 class="card-title">Tickets Table</h4>
                    <div class="mb-4">
                        <a href="{{ route('tickets.create') }}" class="btn btn-primary">+ Create New Ticket</a>
                    </div>

        </div>

        <form method="GET" action="{{ route('tickets.index') }}">
            <div class="row mb-3 row align-items-end">

                {{-- Status --}}
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="filtrestatus">Status</label>
                        <select class="form-control" id="filtrestatus" name="filter_status" onchange="this.form.submit()">
                            <option value="">All Status</option>
                            <option value="open" {{ request('filter_status') === 'open' ? 'selected' : '' }}>Open</option>
                            <option value="in_progress" {{ request('filter_status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="archived" {{ request('filter_status') === 'archived' ? 'selected' : '' }}>Archived</option>
                            <option value="closed" {{ request('filter_status') === 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>
                </div>

                {{-- Priority --}}
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="filtrepriority">Priority</label>
                        <select class="form-control" id="filtrepriority" name="filter_priority" onchange="this.form.submit()">
                            <option value="all">All Priorities</option>
                            <option value="low" {{ request('filter_priority') === 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ request('filter_priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ request('filter_priority') === 'high' ? 'selected' : '' }}>High</option>
                            <option value="urgent" {{ request('filter_priority') === 'urgent' ? 'selected' : '' }}>Urgent</option>
                        </select>
                    </div>
                </div>

                {{-- Category --}}
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="filtrecategory">Category</label>
                        <select class="form-control" id="filtrecategory" name="filter_category" onchange="this.form.submit()">
                            <option value="">All Categories</option>
                            @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}"
                                    {{ request('filter_category') == $categorie->id ? 'selected' : '' }}>
                                    {{ $categorie->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Assigned To --}}
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="filtreassigned_to">Assigned To</label>
                        <select class="form-control" id="filtreassigned_to" name="filter_assigned_to" onchange="this.form.submit()">
                            <option value="">All Agents</option>
                            @foreach($agents as $agent)
                                <option value="{{ $agent->id }}"
                                    {{ request('filter_assigned_to') == $agent->id ? 'selected' : '' }}>
                                    {{ $agent->name }}
                                </option>
                            @endforeach
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

                            @if(
                                request('filter_search') ||
                                request()->filled('filter_status') ||
                                request()->filled('filter_priority') ||
                                request()->filled('filter_category') ||
                                request()->filled('filter_assigned_to')
                            )
                                <a href="{{ route('tickets.index') }}"
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

        @if($tickets->isEmpty())
            <div class="alert alert-info">
                No data available for these filters.
            </div>
        @else

        <table class="table table-sm mb-2">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Created_By</th>
                    <th>Assigned-To</th>
                    <th>Category</th>
                    <th>Labels</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->title }}</td>
                        <td>{{ $ticket->status }}</td>
                        <td>{{ $ticket->priority }}</td>
                        <td>{{ $ticket->creator->name ?? 'Inconnu' }}</td>
                        <td>{{ $ticket->assignedAgent ? $ticket->assignedAgent->name : 'Not assigned' }}</td>
                        <td>{{ $ticket->category->name ?? 'Aucune catégorie'}}</td>
                        <td>
                            {{ $ticket->labels->pluck('name')->implode(' | ') }}
                        </td>
                        <td>
                            <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-warning text-dark">Update</a>

                            <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer ce ticket ?')">
                                    X
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $tickets->links() }}
        @endif
    </div>
@endsection
