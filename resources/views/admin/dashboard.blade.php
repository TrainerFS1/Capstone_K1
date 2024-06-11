@extends('admin.layouts.app')

@section('main')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Dashboard
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <!-- Card 1: Total Companies -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Total Companies</div>
                                <div class="ms-auto lh-1">
                                    <i class="fas fa-building fa-2x"></i>
                                </div>
                            </div>
                            <div class="h1 mb-3">{{ $totalCompanies }}</div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Total Job Seekers -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Total Job Seekers</div>
                                <div class="ms-auto lh-1">
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                            </div>
                            <div class="h1 mb-3">{{ $totalJobSeekers }}</div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Total Job Listings -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Total Job Listings</div>
                                <div class="ms-auto lh-1">
                                    <i class="fas fa-briefcase fa-2x"></i>
                                </div>
                            </div>
                            <div class="h1 mb-3">{{ $totalJobListings }}</div>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Total Applications -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Total Applications</div>
                                <div class="ms-auto lh-1">
                                    <i class="fas fa-file-alt fa-2x"></i>
                                </div>
                            </div>
                            <div class="h1 mb-3">{{ $totalApplications }}</div>
                        </div>
                    </div>
                </div>

                <!-- Card 5: New Job Listings -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">New Job Listings (Last 7 Days)</div>
                                <div class="ms-auto lh-1">
                                    <i class="fas fa-calendar-alt fa-2x"></i>
                                </div>
                            </div>
                            <div class="h1 mb-3">{{ $newJobListings }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


