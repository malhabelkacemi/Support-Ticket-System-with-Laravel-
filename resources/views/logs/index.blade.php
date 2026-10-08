@extends('layouts.dashboardLayout')

@section('title', 'Logs')

@section('content')
    <div class="table-responsive">
        <div class="d-flex align-items-center gap-4 mb-3">
            <h4 class="card-title">Logs Table</h4>

        </div>

        <form method="GET" action="{{ route('logs.index') }}">
            <div class="row align-items-end">

                {{-- Date --}}
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="filtre_Date">Date</label>
                        <select class="form-control" id="filtre_Date" name="filtre_Date" onchange="this.form.submit()">
                            <option value="all" @if(request('filtre_Date') === 'all' || !request('filtre_Date')) selected @endif>All</option>
                            <option value="today" @if(request('filtre_Date') === 'today') selected @endif>Today</option>
                            <option value="yesterday" @if(request('filtre_Date') === 'yesterday') selected @endif>Yesterday</option>
                            <option value="week" @if(request('filtre_Date') === 'week') selected @endif>This Week</option>
                            <option value="month" @if(request('filtre_Date') === 'month') selected @endif>This Month</option>
                            <option value="lastmonth" @if(request('filtre_Date') === 'lastmonth') selected @endif>Last Month</option>
                        </select>
                    </div>
                </div>

                {{-- Search + Clear --}}
                <div class="col-md-3">
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

                            @if(request('filter_search') || request()->filled('filtre_Date'))
                                <a href="{{ route('logs.index') }}"
                                   class="btn btn-danger btn-sm">
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

        @if($logs->isEmpty())
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
                        <th>Created At</th>
                        <th>User</th>
                        <th>Ticket title</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                        <tr>
                            <td class="py-3" >{{ $log->id }}</td>
                            <td class="py-3">{{ $log->log_name }}</td>
                            <td class="py-3">{{ $log->description }}</td>
                            <td class="py-3">{{ $log->created_at->format('d/m/y') }}</td>
                            <td class="py-3">{{ $log->user->name }}</td>
                            <td class="py-3">{{ $log->ticket->title }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $logs->links() }}
        @endif
    </div>
@endsection
