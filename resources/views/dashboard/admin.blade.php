@extends('layouts.dashboardLayout')

@section('title', 'Admin')

@section('content')
     <!-- content -->

          <div>
            <div class="row" id="proBanner">
              <div class="col-12">
                <span class="d-flex align-items-center purchase-popup">
                  <p>Like what you see? Check out more about the Tickets </p>

				<i class="mdi mdi-close" id="bannerClose"></i>
                </span>
              </div>
            </div>
            <div class="d-xl-flex justify-content-between align-items-start">
              <h2 class="text-dark font-weight-bold mb-2"> Overview dashboard </h2>
              <div class="d-sm-flex justify-content-xl-between align-items-center mb-2">

                <div class="dropdown ml-0 ml-md-4 mt-2 mt-lg-0">

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton1">
                    <h6 class="dropdown-header">Settings</h6>
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="d-sm-flex justify-content-between align-items-center transaparent-tab-border {">
                  <ul class="nav nav-tabs tab-transparent" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link" id="home-tab" data-toggle="tab" href="#" role="tab" aria-selected="true">Users</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" id="business-tab" data-toggle="tab" href="{{route("tickets.index") }}" role="tab" aria-selected="false">Tickets</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="performance-tab" data-toggle="tab" href="#" role="tab" aria-selected="false">Catgories</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="conversion-tab" data-toggle="tab" href="#" role="tab" aria-selected="false">Labels</a>
                    </li>
                  </ul>

                </div>

                <div class="tab-content tab-transparent-content">

				 <div class="tab-pane fade show active" id="business-1" role="tabpanel" aria-labelledby="business-tab">
                    <div class="row">
                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card bg-secondary">
                          <div class="card-body text-center">
                            <h5 class="mb-2 text-dark font-weight-normal">Total Tickets </h5>
                            <h2 class="mb-4 text-dark font-weight-bold">{{ $stats['total'] }}</h2>
                            <div class="dashboard-progress dashboard-progress-1 d-flex align-items-center justify-content-center item-parent"></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card bg-warning">
                          <div class="card-body text-center">
                            <h5 class="mb-2 text-dark font-weight-normal">Opened Tickets</h5>
                            <h2 class="mb-4 text-dark font-weight-bold">{{ $stats['open'] }}</h2>
                            <div class="dashboard-progress dashboard-progress-2 d-flex align-items-center justify-content-center item-parent"></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3  col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card bg-info">
                          <div class="card-body text-center">
                            <h5 class="mb-2 text-dark font-weight-normal">Tickets in progress</h5>
                            <h2 class="mb-4 text-dark font-weight-bold">{{ $stats['in_progress'] }}</h2>
                            <div class="dashboard-progress dashboard-progress-3 d-flex align-items-center justify-content-center item-parent"></div>
                          </div>
                        </div>
                      </div>


                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card bg-success">
                          <div class="card-body text-center">
                            <h5 class="mb-2 text-dark font-weight-normal">Closed Tickets</h5>
                            <h2 class="mb-4 text-dark font-weight-bold">{{ $stats['closed'] }}</h2>
                            <div class="dashboard-progress dashboard-progress-4 d-flex align-items-center justify-content-center item-parent"></div>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>

@endsection
