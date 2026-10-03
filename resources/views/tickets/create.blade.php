@extends('layouts.dashboardLayout')

@section('title', 'Create Ticket')

@section('content')
              <div class="col-12 grid-margin stretch-card">
                <div class="card text-dark"  >
                  <div class="card-body">
                    <h4 class="card-title">Create a new ticket</h4>
                    <form class="forms-sample">
                      <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Name">
                      </div>

                      <div class="form-group">
                        <label for="exampleSelectPriority">Priority</label>
                        <select class="form-control" id="exampleSelectPriority">
                          <option>medium</option>
                          <option>low</option>
                          <option>high</option>
                          <option>urgent</option>
                        </select>
                      </div>

                     <div class="form-group">
                        <label for="exampleSelectStatus">Status</label>
                        <select class="form-control" id="exampleSelectStatus">
                          <option>open</option>
                          <option>in_progress</option>
                          <option>archived</option>
                          <option>closed</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleSelectCategory">Category</label>
                        <select class="form-control" id="exampleSelectCategory">
                            @foreach($categories as $categorie)
                                <option> {{ $categorie->name }} </option>
                            @endforeach
                        </select>
                      </div>
                       <div class="form-group">
                        <label for="exampleSelectLabel">Labels</label>
                        <select class="form-control" id="exampleSelectLabel">
                            @foreach($labels as $label)
                                <option> {{ $label->name }} </option>
                            @endforeach
                        </select>
                      </div>
                      <div class="form" enctype="multipart/form-data">
                      <div class="form-group" >
                        <label>Upload Attachement </label>
                        <input type="file" name="img[]" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" >

                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                          </span>
                        </div>
                      </div>
                      </div>

                      <div class="form-group">
                        <label for="exampleTextarea1">Description </label>
                        <textarea class="form-control" id="exampleTextarea1" rows="4"></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>





@endsection
