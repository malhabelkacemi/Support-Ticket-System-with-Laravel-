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
                        <th>Date</th>
                        <th>Hour</th>
                        <th>Causer</th>
                        <th>Subject</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                        <tr>
                            <td class="py-3">{{ $log->id }}</td>
                            <td class="py-3">{{ $log->log_name }}</td>


                            <td class="py-3 description-cell">
                                <span
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="{{ $log->description }}"
                                >
                                @if(Str::length($log->description) > 55)
                                    {{ Str::limit($log->description, 50) }}
                                    <i class="mdi mdi-information-outline text-primary ms-1" style="font-size: 1.3rem;"></i>
                                @else
                                    {{ $log->description }}
                                @endif
                                </span>
                            </td>


                            <td class="py-3">{{ $log->created_at->format('d/m/y') }}</td>
                            <td class="py-3">{{ $log->created_at->format('H:i') }}</td>

                            {{-- CAUSER : flexible selon le modèle --}}
                            <td class="py-3">
                                @if($log->causer)
                                   <span class="badge bg-warning text-dark fw-bold">
                                        {{ class_basename($log->causer_type) }}
                                    </span>
                                    {{ $log->causer->name ?? $log->causer->title ?? '—' }}
                                @else
                                    <span class="text-muted">System</span>
                                @endif
                            </td>


                            {{--  SUBJECT : flexible selon le modèle --}}
                            <td class="py-3">
                                @if($log->subject)
                                    <span class="badge bg-primary ">
                                        {{ class_basename($log->subject_type) }}
                                    </span>
                                    {{ $log->subject->title ?? $log->subject->name ?? '—' }}
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $logs->links() }}
        @endif

<style>
    .description-cell {
        max-width: 250px; /* Adjust the width as needed */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>


    </div>
@endsection
