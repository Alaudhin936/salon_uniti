@extends('layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('main_content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3>All Salons</h3>
                </div>
                <div class="col-sm-6 text-sm-end text-start">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registerSalonModal">
                        <i class="fa fa-plus"></i> Register New Salon
                    </button>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white py-2">
                            <i class="fas fa-cut me-2"></i> All Vendor Lists
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table id="salonTable" class="table table-striped table-hover table-bordered mb-0">
                                    <thead class="">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Business Name</th>
                                            <th class="text-center">Type</th>
                                            <th>Location</th>
                                            <th>Vendor Name</th>
                                            <th>Email</th>
                                            <th class="text-center">Action</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($salons as $index => $salon)
                                            <tr>
                                                <td class="text-center fw-bold text-primary">{{ $index + 1 }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2"
                                                            style="width: 32px; height: 32px; font-size: 12px; color: white;">
                                                            {{ strtoupper(substr($salon->business_name, 0, 1)) }}
                                                        </div>
                                                        {{ $salon->business_name }}
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-secondary rounded-pill">{{ $salon->type }}</span>
                                                </td>
                                                <td><i
                                                        class="fas fa-map-marker-alt text-danger me-1"></i>{{ $salon->location }}
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-success rounded-circle d-flex align-items-center justify-content-center me-2"
                                                            style="width: 24px; height: 24px; font-size: 10px; color: white;">
                                                            {{ strtoupper(substr($salon->name, 0, 1)) }}
                                                        </div>
                                                        {{ $salon->name }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="mailto:{{ $salon->email }}"
                                                        class="text-decoration-none text-primary">
                                                        <i
                                                            class="fas fa-envelope me-1"></i><small>{{ $salon->email }}</small>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-primary btn-sm viewSalonBtn"
                                                        style="padding: 2px 8px; font-size: 12px;"
                                                        data-id={{ $salon->id }}>View</button>
                                                </td>
                                                <td class="text-center">
                                                    @if ($salon->is_active)
                                                        <i class="fa fa-check-circle text-success"></i>
                                                    @else
                                                        <i class="fa fa-times-circle text-danger"></i>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-light text-muted">
                            <small><i class="fas fa-info-circle me-1"></i>
                                Total Salons: <span class="fw-bold">{{ count($salons) }}</span>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



<div class="modal fade" id="salonModal" tabindex="-1" aria-labelledby="salonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header text-white bg-primary position-relative">
                <div class="d-flex align-items-center">
                    <div>
                        <h3 class="modal-title fw-bold mb-1" id="salonModalLabel">Salon Details</h3>
                        <p class="mb-0 text-white-50 fs-5">business information</p>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 mt-3 me-3 fs-4" data-bs-dismiss="modal"></button>
            </div>

            <!-- Enhanced Body -->
            <div class="modal-body p-0">
                <!-- Cover Photo Section -->
                <div class="position-relative mb-3" style="height: 200px; background: linear-gradient(45deg, #f8f9fa, #e9ecef);">
                    <img id="salonCoverPhoto" src="https://via.placeholder.com/600x150/667eea/ffffff?text=Salon+Cover+Photo"
                         alt="Cover Photo" class="w-100 h-100" style="object-fit: cover;">
                    <div class="position-absolute bottom-0 start-0 p-2">
                        <div class="bg-white rounded-pill px-2 py-1 shadow-sm">
                            <i class="fas fa-camera text-primary me-1"></i>
                            <small class="text-muted fw-semibold">Cover</small>
                        </div>
                    </div>
                </div>

                <!-- Information Grid -->
                <div class="container-fluid px-4 pb-4">
                    <div class="row g-3">
                        <!-- Vendor Information -->
                        <div class="col-md-6">
                            <div class="info-item bg-light rounded-3 p-3 h-100 shadow-sm">
                                <div class="d-flex align-items-center mb-2">

                                    <div>
                                        <h6 class="fw-bold text-primary mb-0">Vendor</h6>
                                    </div>
                                </div>
                                <div class="bg-white rounded-2 p-2 border">
                                    <span class="text-dark fw-semibold" id="salonName">John Doe</span>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="col-md-6">
                            <div class="info-item bg-light rounded-3 p-3 h-100 shadow-sm">
                                <div class="d-flex align-items-center mb-2">

                                    <div>
                                        <h6 class="fw-bold  text-success mb-0">Email</h6>
                                    </div>
                                </div>
                                <div class="bg-white text-dark rounded-2 p-2 border">
                                    <span class="fw-semibold" id="salonEmail">salon@example.com</span>
                                </div>
                            </div>
                        </div>

                        <!-- Business Type & Phone -->
                        <div class="col-md-6">
                            <div class="info-item bg-light rounded-3 p-3 h-100 shadow-sm">
                                <div class="d-flex align-items-center mb-2">

                                    <div>
                                        <h6 class="fw-bold text-info mb-0">Type</h6>
                                    </div>
                                </div>
                                <div class="bg-white rounded-2 p-2 border">
                                    <span class="badge bg-info rounded-pill" id="salonType">Premium Salon</span>
                                </div>
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div class="col-md-6">
                            <div class="info-item bg-light rounded-3 p-3 h-100 shadow-sm">
                                <div class="d-flex align-items-center mb-2">

                                    <div>
                                        <h6 class="fw-bold text-warning mb-0">Phone</h6>
                                    </div>
                                </div>
                                <div class="bg-white text-dark rounded-2 p-2 border">
                                    <span class="fw-semibold" id="salonPhone">+1 234 567 8900</span>
                                </div>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="col-12">
                            <div class="info-item bg-light rounded-3 p-3 shadow-sm">
                                <div class="d-flex align-items-center mb-2">

                                    <div>
                                        <h6 class="fw-bold text-danger mb-0">Location</h6>
                                    </div>
                                </div>
                                <div class="bg-white rounded-2 p-2 border">
                                    <span class="fw-semibold text-dark" id="salonLocation">123 Main Street, City, State</span>
                                </div>
                            </div>
                        </div>

                        <!-- Business Details Row -->
                        <div class="col-md-4">
                            <div class="info-item bg-white rounded-3 p-3 h-100 shadow-sm border">
                                <div class="text-center">

                                    <h6 class="text-muted mb-1 small">GST Number</h6>
                                    <span class="fw-bold text-dark small" id="salonGst">GST123456789</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="info-item bg-white rounded-3 p-3 h-100 shadow-sm border">
                                <div class="text-center">

                                    <h6 class="text-muted mb-1 small">Hours</h6>
                                    <div class="d-flex justify-content-center gap-1">
                                        <span class="badge bg-success small" id="salonOpen">9:00 AM</span>
                                        <span class="badge bg-danger small" id="salonClose">8:00 PM</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="info-item bg-primary rounded-3 p-3 h-100 shadow-sm text-white">
                                <div class="text-center">

                                    <h6 class="text-white-50 mb-1 small">Revenue</h6>
                                    <span class="fw-bold text-white" id="salonRevenue">$25,450</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 <style>
        .modal-content {
            border: none;
            border-radius: 20px;
            overflow: hidden;
        }
        .modal-header {
            border-bottom: none;
        }
        .info-item {
            transition: all 0.3s ease;
        }
        .info-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
    </style>

    <div class="modal fade" id="registerSalonModal" tabindex="-1" aria-labelledby="registerSalonModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="registerSalonModalLabel">Register New Salon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="registerSalonForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Vendor Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Vendor Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="business_name" class="form-label">Business Name</label>
                                <input type="text" name="business_name" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="slogan" class="form-label">Slogan</label>
                                <input type="text" name="slogan" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select name="type" class="form-select" required>
                                    <option value="Men">Men</option>
                                    <option value="Women">Women</option>
                                    <option value="Unisex">Unisex</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" name="location" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="gst_number" class="form-label">GST Number (optional)</label>
                                <input type="text" name="gst_number" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="gst_number" class="form-label">Write New Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="shop_open" class="form-label">Shop Opening Time</label>
                                <input type="time" name="shop_open" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="shop_close" class="form-label">Shop Closing Time</label>
                                <input type="time" name="shop_close" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="lattitude" class="form-label">Latitude (Optional)</label>
                                <input type="text" name="lattitude" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="longitude" class="form-label">Longitude (Optional)</label>
                                <input type="text" name="longitude" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Salon</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/counter/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/counter/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/counter/counter-custom.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/support-ticket-custom.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#salonTable').DataTable({
                "pageLength": 10,
                "ordering": true,
                "searching": true,
                "lengthChange": true,
                "language": {
                    "search": "Search Salon:",
                    "lengthMenu": "Show _MENU_ entries",
                    "info": "Showing _START_ to _END_ of _TOTAL_ salons"
                }
            });

            $('#registerSalonForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('salons.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status === 'success') {
                            location.reload();
                        } else {
                            alert('Error saving salon.');
                        }
                    },
                    error: function() {
                        alert('Something went wrong.');
                    }
                });
            });


            $(document).on('click', '.viewSalonBtn', function() {
                let salonId = $(this).data('id');
                let myUrl = "{{ route('salon.details', ':id') }}".replace(':id', salonId);
                $.ajax({
                    url: myUrl,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        $('#salonName').text(response.business_name);
                        $('#salonEmail').text(response.email);
                        $('#salonType').text(response.type);
                        $('#salonPhone').text(response.phone);
                        $('#salonLocation').text(response.location);
                        $('#salonGst').text(response.gst_number);
                        $('#salonOpen').text(response.shop_open);
                        $('#salonClose').text(response.shop_close);
                        $('#salonRevenue').text('₹' + response.total_revenue);
                        $('#salonCoverPhoto').attr('src', '{{ asset('storage') }}/' + response
                            .cover_photo);

                        $('#salonModal').modal('show');
                    }
                });
            });

        });
    </script>
@endsection
