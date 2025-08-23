@extends('layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/prism.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/vector-map.css') }}">

    <!-- DataTables Bootstrap 5 + Responsive -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <style>
        .underlined-heading {
            position: relative;
            display: inline-block
        }

        .underlined-heading::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 50%;
            height: 3px;
            background: #0a566d;
            border-radius: 2px
        }

        .profile-greeting {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            border: none
        }

        .stats-card {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: #fff;
            border: none;
            transition: transform .3s ease
        }

        .stats-card:hover {
            transform: translateY(-5px)
        }

        /* ---------- DataTables polish ---------- */
        /* Put toolbar in one line using Bootstrap grid via DOM option, then small spacing tweaks */
        .dataTables_wrapper .dt-header,
        .dataTables_wrapper .dt-footer {
            margin: .25rem 0 .75rem 0;
            padding: 0 30px 0 30px;
        }

        .dataTables_wrapper {
            padding: 20px !important;
        }

        .dataTables_wrapper .dataTables_length label,
        .dataTables_wrapper .dataTables_filter label {
            margin-bottom: 0;
            /* remove extra label spacing */
            font-weight: 500;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 10px;
            padding: 8px 12px;
            border: 1px solid #0a566d;
            outline: none;
            width: 220px;
            /* consistent width */
            max-width: 100%;
            margin-left: .5rem;
            /* space after "Search" (we'll hide the word via language below) */
        }

        .dataTables_wrapper .dataTables_length select {
            border-radius: 8px;
            padding: 6px 10px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: .35rem .6rem !important;
            margin: 0 .15rem !important;
            border-radius: .5rem !important;
        }

        .dataTables_wrapper .dataTables_info {
            padding-top: .6rem
        }

        /* Table look & cell spacing */
        .table.dataTable {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .08)
        }

        .table.dataTable thead th {
            background: #0a566d !important;
            color: #fff !important;
            text-align: center;
            padding: 14px 16px !important;
            font-size: 14px;
            vertical-align: middle;
            opacity: 1 !important;
            /* force visible if any theme sets opacity */
        }

        .table.dataTable tbody td {
            padding: 12px 16px !important;
            vertical-align: middle;
            font-size: 14px;
        }

        .table.dataTable tbody tr:hover {
            background: #f1faff
        }

        /* If any theme overrides header again, keep it blue */
        .table thead th {
            background: #0a566d !important;
            border-color: #0a566d !important;
            color: #fff !important;
            font-weight: 600;
            letter-spacing: .5px;
            opacity: 1 !important;
        }
    </style>
@endsection

@section('main_content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3 style="color:#0a566d" class="underlined-heading mb-4 fw-bold">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-end">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active text-primary">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Welcome Card -->
        <div class="row ">
            <div class="col-12">
                <div class="card profile-greeting shadow-lg border-0 rounded-4">
                    <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
                        <div class=""><i class="fas fa-user-shield fa-3x text-white opacity-75"></i></div>
                        <div class="greeting-user">
                            <h4 class="">
                                <span class="fw-light">Welcome Back,</span>
                                <span class="fw-bold" style="color: #0a566d">{{ auth()->user()->name }}</span>
                                <i class="fas fa-check-circle text-success ms-2"></i>
                            </h4>
                            <p class="text-white-50 mb-0">Manage your platform efficiently</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 mb-4">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-gradient text-dark border-0 rounded-top-4 py-3"
                        style="background:#00A08C !important">
                        <div class="d-flex align-items-center">
                            <div class="bg-white bg-opacity-20 rounded-circle p-2 me-3">
                                <i class="fas fa-star text-dark fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-bold">Top Rated Salons</h5>
                                <small class="opacity-75">Customer favorites based on reviews</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @forelse ($topRatedSalons as $index => $salon)
                            <div
                                class="d-flex justify-content-between align-items-center p-3 border-bottom {{ $loop->last ? 'border-0' : '' }} hover-bg-light">
                                <div class="d-flex align-items-center flex-grow-1">
                                    <!-- Ranking Badge -->
                                    <div class="me-3">
                                        @if ($index == 0)
                                            <span class="badge bg-warning text-dark fw-bold px-2 py-2 rounded-circle">
                                                <i class="fas fa-crown"></i>
                                            </span>
                                        @elseif($index == 1)
                                            <span class="badge bg-secondary fw-bold px-2 py-2 rounded-circle">2</span>
                                        @elseif($index == 2)
                                            <span class="badge bg-danger fw-bold px-2 py-2 rounded-circle">3</span>
                                        @else
                                            <span
                                                class="badge bg-light text-dark fw-bold px-2 py-2 rounded-circle">{{ $index + 1 }}</span>
                                        @endif
                                    </div>

                                    <!-- Salon Info -->
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 fw-semibold text-primary">{{ $salon->business_name }}</h6>
                                        <div class="d-flex align-items-center text-muted">
                                            <i class="fas fa-map-marker-alt me-1 text-danger"></i>
                                            <small>{{ $salon->location }}</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Rating Section -->
                                <div class="text-end">
                                    <div class="d-flex align-items-center justify-content-end mb-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= floor($salon->avg_rating))
                                                <i class="fas fa-star text-warning me-1"></i>
                                            @elseif($i - 0.5 <= $salon->avg_rating)
                                                <i class="fas fa-star-half-alt text-warning me-1"></i>
                                            @else
                                                <i class="far fa-star text-muted me-1"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <div>
                                        <span class="fw-bold text-dark">{{ number_format($salon->avg_rating, 1) }}/5</span>
                                        <small class="text-muted ms-1">({{ $salon->total_reviews }} reviews)</small>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card-body text-center py-5">
                                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                    style="width: 60px; height: 60px;">
                                    <i class="fas fa-star-o fa-2x text-muted"></i>
                                </div>
                                <h6 class="text-muted mb-1">No Ratings Available</h6>
                                <p class="text-muted small mb-0">Salons will appear here once they receive customer reviews
                                </p>
                            </div>
                        @endforelse
                    </div>

                    @if (!$topRatedSalons->isEmpty())
                        <div class="card-footer bg-light border-0 text-center py-2">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Ratings updated in upto date
                            </small>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-6 mb-4">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-gradient text-dark border-0 rounded-top-4 py-3"
                        style="background:#00A08C !important">
                        <div class="d-flex align-items-center">
                            <div class="bg-white bg-opacity-20 rounded-circle p-2 me-3">
                                <i class="fas fa-fire text-dark fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-bold">Trending Services</h5>
                                <small class="opacity-75">Most booked services this week</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @forelse ($trendingServices as $index => $service)
                            <div
                                class="d-flex align-items-center justify-content-between p-3 border-bottom {{ $loop->last ? 'border-0' : '' }}">

                                <!-- Rank -->
                                <div class="me-3">
                                    <span class="badge bg-primary rounded-circle px-3 py-2 fw-bold">
                                        {{ $index + 1 }}
                                    </span>
                                </div>

                                <!-- Service Info -->
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 fw-semibold text-dark">{{ $service->name }}</h6>
                                    <small class="text-muted">{{ $service->business_name }}</small>
                                </div>

                                <!-- Booking Count -->
                                <div class="text-end">
                                    <span class="fw-bold text-dark">{{ $service->total_bookings }}</span>
                                    <small class="text-muted">bookings</small>
                                </div>
                            </div>

                        @empty
                            <div class="card-body text-center py-5">
                                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                    style="width: 60px; height: 60px;">
                                    <i class="fas fa-fire fa-2x text-muted"></i>
                                </div>
                                <h6 class="text-muted mb-1">No Trending Services</h6>
                                <p class="text-muted small mb-0">Services will appear here once customers book frequently.
                                </p>
                            </div>
                        @endforelse
                    </div>

                    @if (!$trendingServices->isEmpty())
                        <div class="card-footer bg-light border-0 text-center py-2">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Based on bookings in the last 7 days
                            </small>
                        </div>
                    @endif
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-white border-0 rounded-top-4 py-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="fas fa-trophy text-warning fa-lg"></i>
                            </div>
                            <div>
                                <h4 style="color:#0a566d" class="mb-1 fw-bold">Top Performing Salons</h4>
                                <p class="text-muted mb-0">Revenue leaders and customer favorites</p>
                            </div>
                        </div>
                    </div>

                    @if ($salons->isEmpty())
                        <div class="card-body text-center py-5">
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width:80px;height:80px;">
                                <i class="fas fa-chart-line fa-2x text-muted"></i>
                            </div>
                            <h5 class="mt-3 mb-2">No Performance Data</h5>
                            <p class="text-muted">No completed appointments found to display performance metrics.</p>
                        </div>
                    @else
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table id="salonsTable" class="table table-hover align-middle mb-0 nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <style>
                                            </style>
                                            <th class="ps-4" style="background: #00A08C !important">Rank</th>
                                            <th style="background: #00A08C !important">Salon Details</th>
                                            <th style="background: #00A08C !important">Vendor</th>
                                            <th style="background: #00A08C !important" class="text-center">Total Visits
                                            </th>
                                            <th style="background: #00A08C !important" class="text-center">Revenue</th>
                                            <th style="background: #00A08C !important" class="pe-4 text-center">
                                                Performance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($salons as $index => $salon)
                                            <tr>
                                                <td class="ps-4">
                                                    @if ($index < 3)
                                                        <div class="d-flex align-items-center">
                                                            @if ($index == 0)
                                                                <i class="fas fa-crown text-warning fa-lg me-2"></i>
                                                                <span class="badge bg-warning text-dark fw-bold">1st</span>
                                                            @elseif($index == 1)
                                                                <i class="fas fa-medal text-secondary fa-lg me-2"></i>
                                                                <span class="badge bg-secondary fw-bold">2nd</span>
                                                            @else
                                                                <i class="fas fa-award text-danger fa-lg me-2"></i>
                                                                <span class="badge bg-danger fw-bold">3rd</span>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <span class="badge bg-light text-dark">{{ $index + 1 }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                                            <i class="fas fa-cut text-success"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-1 fw-semibold">{{ $salon->business_name }}</h6>
                                                            <small class="text-muted">Professional Salon</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3">
                                                            <i class="fas fa-user-tie text-info"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-1">{{ $salon->business_name }}</h6>
                                                            <small class="text-muted">Salon Owner</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <span
                                                            class="h5 mb-1 text-primary fw-bold">{{ $salon->total_visits }}</span>
                                                        <small class="text-muted">visits</small>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <span
                                                            class="h5 mb-1 text-success fw-bold">₹{{ number_format($salon->total_revenue) }}</span>
                                                        <small class="text-muted">total revenue</small>
                                                    </div>
                                                </td>
                                                <td class="pe-4 text-center">
                                                    @php
                                                        $avgPerVisit =
                                                            $salon->total_visits > 0
                                                                ? $salon->total_revenue / $salon->total_visits
                                                                : 0;
                                                    @endphp
                                                    <div class="d-flex flex-column align-items-center">
                                                        <span
                                                            class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-1">
                                                            ₹{{ number_format($avgPerVisit) }}/visit
                                                        </span>
                                                        @if ($index < 3)
                                                            <small class="text-success fw-semibold">Top Performer</small>
                                                        @else
                                                            <small class="text-muted">Good Performance</small>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Vendors Section -->
        <div class="row mb-5">
            <div class="col-12">
                @if ($users->isEmpty())
                    <div class="alert alert-info border-0 rounded-4 shadow-sm d-flex align-items-center">
                        <i class="fas fa-info-circle fa-2x text-info me-3"></i>
                        <div>
                            <h6 class="alert-heading mb-1">No Recent Vendors</h6>
                            <p class="mb-0">No vendors were onboarded this week.</p>
                        </div>
                    </div>
                @else
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-header bg-white border-0 rounded-top-4 py-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                    <i class="fas fa-store text-primary fa-lg"></i>
                                </div>
                                <div>
                                    <h4 style="color:#0a566d" class="mb-1 fw-bold">Latest Vendor Onboards</h4>
                                    <p class="text-muted mb-0">Vendors registered in the last 7 days</p>
                                </div>
                                <div class="ms-auto">
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                                        {{ $users->count() }} New Vendors
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table id="vendorsTable" class="table table-hover align-middle mb-0 nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="ps-4" style="background: #00A08C !important">ID</th>
                                            <th style="background: #00A08C !important">Business Info</th>
                                            <th style="background: #00A08C !important">Contact</th>
                                            <th style="background: #00A08C !important">Vendor Details</th>
                                            <th style="background: #00A08C !important">Registration Date</th>
                                            <th style="background: #00A08C !important" class="pe-4">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="ps-4">
                                                    <span
                                                        class="badge bg-light text-dark fw-bold">#{{ $user->id }}</span>
                                                </td>
                                                <td>
                                                    <h6 class="mb-1 text-primary">
                                                        {{ $user->business_name ?? 'Not specified' }}</h6>
                                                    <small class="text-muted">Vendor since
                                                        {{ \Carbon\Carbon::parse($user->vendor_created_at ?? $user->created_at)->format('M Y') }}</small>
                                                </td>
                                                <td>
                                                    <div class="mb-1"><i
                                                            class="fas fa-envelope text-muted me-2"></i><small>{{ $user->email }}</small>
                                                    </div>
                                                    <div><i
                                                            class="fas fa-phone text-muted me-2"></i><small>{{ $user->phone ?? 'Not provided' }}</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                            <i class="fas fa-user text-primary"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-1 fw-semibold">{{ $user->name }}</h6>
                                                            <small class="text-muted">{{ $user->email }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="fw-semibold">
                                                        {{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}
                                                    </div>
                                                    <small
                                                        class="text-muted">{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</small>
                                                </td>
                                                <td class="pe-4">
                                                    <span
                                                        class="badge  bg-opacity-10 @if ($user->is_active) bg-success text-success @else bg-danger text-danger @endif px-3 py-2 rounded-pill">
                                                        <i
                                                            class="fas fa-check-circle me-1"></i>{{ $user->is_active ? 'Active' : 'In-active' }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>



        <style>
            .hover-bg-light:hover {
                background-color: #f8f9fa !important;
                transition: background-color 0.2s ease;
            }

            .bg-gradient {
                background: linear-gradient(135deg, #ffc107 0%, #ffeb3b 100%) !important;
            }
        </style>

        <!-- Top Performing Salons -->

    </div>
@endsection

@section('scripts')
    <!-- jQuery (ensure this is before DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables + Bootstrap 5 + Responsive -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <script>
        $(function() {
            const commonOpts = {
                responsive: true,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                language: {
                    search: "", // hide the "Search:" text
                    searchPlaceholder: "Search...", // nice placeholder
                    lengthMenu: "Show _MENU_ entries"
                },
                /* Bootstrap grid layout: header row with length (left) + search (right),
                   footer row with info (left) + pagination (right) */
                dom: "<'dt-header row g-2 align-items-center'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 text-md-end'f>>" +
                    "rt" +
                    "<'dt-footer row g-2 align-items-center'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 text-md-end'p>>"
            };

            $('#vendorsTable').DataTable({
                ...commonOpts,
                order: [
                    [4, 'desc']
                ],
                columnDefs: [{
                    orderable: false,
                    targets: [0, 5]
                }]
            });

            $('#salonsTable').DataTable({
                ...commonOpts,
                order: [
                    [4, 'desc']
                ],
                columnDefs: [{
                    orderable: false,
                    targets: [0, 5]
                }]
            });
        });
    </script>
@endsection
