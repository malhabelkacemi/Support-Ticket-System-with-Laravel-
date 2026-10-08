@extends('layouts.dashboardLayout')

@section('title', 'Create Ticket')

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card text-dark">
            <div class="card-body">
                <h4 class="card-title">Create a new ticket</h4>

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


                <form
                    action="{{ route('tickets.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="forms-sample"
                >
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input
                            type="text"
                            name="title"
                            class="form-control"
                            id="exampleInputName1"
                            placeholder="Name"
                            value="{{ old('title') }}"
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
                            <option value="medium" {{ old('priority') === 'medium' ? 'selected' : '' }}>
                                medium
                            </option>
                            <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>
                                low
                            </option>
                            <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>
                                high
                            </option>
                            <option value="urgent" {{ old('priority') === 'urgent' ? 'selected' : '' }}>
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
                            <option value="open" {{ old('status') === 'open' ? 'selected' : '' }}>
                                open
                            </option>
                            <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>
                                in_progress
                            </option>
                            <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>
                                archived
                            </option>
                            <option value="closed" {{ old('status') === 'closed' ? 'selected' : '' }}>
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
                                    {{ old('category_id') == $categorie->id ? 'selected' : '' }}>
                                    {{ $categorie->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleSelectLabel">Labels</label>
                        <select class="form-control" id="exampleSelectLabel" name="label[]" multiple >
                            @foreach($labels as $label)
                                <option value="{{ $label->id }}"
                                    @if(in_array($label->id, old('label', []))) {{-- [] : signifie
                                                                                    si rien n’a été soumis avant,
                                                                                    utilise un tableau vide [] ».--}}
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
                        <option value=""> - None -</option>
                            @foreach($agents as $agent)
                                <option value="{{ $agent->id }}"
                                    {{ old('agent_id') == $agent->id ? 'selected' : '' }}>
                                    {{ $agent->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>





                    <div class="form-group">
                        <label>Upload Attachment</label>
                        <div class="input-group col-xs-12">
                             <input class="file-upload-browse btn btn-secondary" type="file" id="formFileMultiple" name="attachment[]" multiple readonly> </input>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleTextarea1">Description</label>
                        <textarea
                            class="form-control"
                            id="exampleTextarea1"
                            rows="4"
                            name="message"
                            required
                        >     {{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">
                        Submit
                    </button>

                 <a href="{{ route("tickets.index") }}" class="btn btn-light">Cancel</a>

                </form>
            </div>
        </div>
    </div>
@endsection
