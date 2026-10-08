@extends('layouts.dashboardLayout')

@section('title', 'Edit Ticket')

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card text-dark">
            <div class="card-body">
                <h4 class="card-title">Edit a ticket</h4>

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
                    action="{{ route('tickets.update', $ticket) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="forms-sample"
                >
                    @method('PUT')
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputName1">Title</label>
                        <input
                            type="text"
                            name="title"
                            class="form-control"
                            id="exampleInputName1"
                            placeholder="Title"
                            value="{{ old('title', $ticket->title) }}"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="exampleSelectPriority">Priority</label>
                        <select
                            class="form-control"
                            id="exampleSelectPriority"
                            name="priority"
                            required
                        >
                            <option value="medium" {{ old('priority', $ticket->priority) === 'medium' ? 'selected' : '' }}>
                                medium
                            </option>
                            <option value="low" {{ old('priority', $ticket->priority) === 'low' ? 'selected' : '' }}>
                                low
                            </option>
                            <option value="high" {{ old('priority', $ticket->priority) === 'high' ? 'selected' : '' }}>
                                high
                            </option>
                            <option value="urgent" {{ old('priority', $ticket->priority) === 'urgent' ? 'selected' : '' }}>
                                urgent
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleSelectStatus">Status</label>
                        <select
                            class="form-control"
                            id="exampleSelectStatus"
                            name="status"
                            required
                        >
                            <option value="open" {{ old('status', $ticket->status) === 'open' ? 'selected' : '' }}>
                                open
                            </option>
                            <option value="in_progress" {{ old('status', $ticket->status) === 'in_progress' ? 'selected' : '' }}>
                                in_progress
                            </option>
                            <option value="archived" {{ old('status', $ticket->status) === 'archived' ? 'selected' : '' }}>
                                archived
                            </option>
                            <option value="closed" {{ old('status', $ticket->status) === 'closed' ? 'selected' : '' }}>
                                closed
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleSelectCategory">Category</label>
                        <select
                            class="form-control"
                            id="exampleSelectCategory"
                            name="category_id"
                            required
                        >
                            @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}"
                                    {{ old('category_id', $ticket->category_id) == $categorie->id ? 'selected' : '' }}>
                                    {{ $categorie->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleSelectLabel">Labels</label>
                        <select
                            class="form-control"
                            id="exampleSelectLabel"
                            name="label[]"
                            multiple
                        >
                            @foreach($labels as $label)
                                <option value="{{ $label->id }}"
                                    @if(in_array($label->id, old('label', $ticket->labels->pluck('id')->toArray())))
                                        selected
                                    @endif
                                >
                                    {{ $label->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleSelectAgent">Assigned_To </label>
                        <select
                            class="form-control"
                            id="exampleSelectAgent"
                            name="assigned_to"
                            required
                        >

                            @foreach($agents as $agent)
                                <option value="{{ $agent->id }}"
                                    {{ old('agent_id', $ticket->agent_id) == $agent->id ? 'selected' : '' }}>
                                    {{ $agent->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label>Upload Attachment</label>
                        <div class="input-group col-xs-12">
                            <input
                                class="file-upload-browse btn btn-secondary"
                                type="file"
                                id="formFileMultiple"
                                name="attachment[]"
                                multiple
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleTextarea1">Message</label>
                        <textarea
                            class="form-control"
                            id="exampleTextarea1"
                            rows="4"
                            name="message"
                            required
                        >{{ old('message', $ticket->message) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">
                        Update
                    </button>

                    <a href="{{ route("tickets.index") }}" class="btn btn-light">Cancel</a>


                </form>
            </div>
        </div>
    </div>
@endsection
