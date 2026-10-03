@extends('layouts.dashboardLayout')

@section('title', 'Tickets')

@section('content')
            <div class="table-responsive">
                <h4 class="card-title">Tickets Table</h4>
                    <div class="mt-2 mb-5">

                            <a href="{{ route("tickets.create") }}" class="btn btn-primary btn-lg"> + Create New Ticket</a>

                    </div>
                  <table class="table table-sm">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Date</th>
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
                            <td> {{$ticket->title}}  </td>
                            {{-- <td> {{ Str::limit($ticket->title,15) }}  </td> --}}
                            <td>{{ $ticket->status }}</td>
                            <td>{{ $ticket->priority }}</td>
                            <td>{{ $ticket->created_by }}</td>
                            <td>{{ $ticket->assignedAgent ? $ticket->assignedAgent->name :"Not assigned" }}</td>
                            <td>{{ $ticket->category->name }}</td>
                            <td>
                                {{ $ticket->labels->pluck('name')->implode(' | ') }}
                            </td>
                            <td>
                               <a href="" class="btn btn-warning text-dark ">Update</a>
                               <a href="" class="btn btn-danger "> X </a>
                            </td>

                        </tr>
                        @endforeach
                        </tbody>
                   </table>
            </div>



{{ $tickets->links() }}

@endsection


