@extends('layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
@endsection

@section('main_content')
    <style>
        /* Enhanced Professional Styling */
        .page-container {
            background: linear-gradient(135deg, #f8fafc 0%, #e3f2fd 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }

        .main-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(10, 86, 109, 0.08);
            border: 1px solid rgba(10, 86, 109, 0.05);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .main-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 50px rgba(10, 86, 109, 0.12);
        }

        .card-header-custom {
            background: linear-gradient(135deg, #0ba18c 0%, #00ff3c8f 100%);
            color: white;
            padding: 1.5rem 2rem;
            position: relative;
            overflow: hidden;
        }
        .card-header-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.02)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.02)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }
        .card-header-title {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            font-weight: 600;
            font-size: 1.25rem;
            letter-spacing: 0.5px;
        }

        .title-icon {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.75rem;
            border-radius: 12px;
            margin-right: 1rem;
            font-size: 1.1rem;
        }

        .breadcrumb-custom {
            background: none;
            padding: 10px !important;
            margin: 0;
            border-radius: 10px;
        }

        .breadcrumb-custom .breadcrumb-item a {
            color: #6c757d;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .breadcrumb-custom .breadcrumb-item a:hover {
            color: #0a566d;
        }

        .breadcrumb-custom .breadcrumb-item.active {
            color: #0a566d;
            font-weight: 600;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-title-main {
            color: #0a566d;
            font-weight: 700;
            font-size: 2rem;
            margin: 0;
            position: relative;
            display: inline-block;
        }

        .page-title-main::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #0a566d, #007bff);
            border-radius: 2px;
        }

        /* Enhanced Table Styling */
        .table-container {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        }

        .custom-table {
            margin: 0;
            border: none;
        }

        .custom-table thead th {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: none;
            font-weight: 600;
            color: #495057;
            padding: 1.25rem 1rem;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            position: relative;
        }

        .custom-table thead th::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 1rem;
            right: 1rem;
            height: 2px;
            background: linear-gradient(90deg, #0a566d, #007bff);
            border-radius: 1px;
        }

        .custom-table tbody td {
            padding: 1.25rem 1rem;
            border-bottom: 1px solid #f1f3f4;
            vertical-align: middle;
            font-size: 0.95rem;
            color: #495057;
            transition: all 0.3s ease;
        }

        .custom-table tbody tr {
            transition: all 0.3s ease;
        }

        .custom-table tbody tr:hover {
            background: linear-gradient(135deg, #f8fafc 0%, #e3f2fd 100%);
            transform: scale(1.002);
        }

        .custom-table tbody tr:hover td {
            color: #0a566d;
        }

        /* Action Button Styling */
        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, #0a566d 0%, #007bff 100%);
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .action-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .action-btn:hover::before {
            left: 100%;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(10, 86, 109, 0.3);
        }

        /* Enhanced Modal Styling */
        .modal-content-custom {
            border-radius: 20px;
            border: none;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .modal-header-custom {
            background: linear-gradient(135deg, #0a566d 0%, #007bff 100%);
            color: white;
            border: none;
            padding: 1.5rem 2rem;
            position: relative;
        }

        .modal-header-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="modalGrain" width="50" height="50" patternUnits="userSpaceOnUse"><circle cx="12.5" cy="12.5" r="0.5" fill="rgba(255,255,255,0.03)"/><circle cx="37.5" cy="37.5" r="0.5" fill="rgba(255,255,255,0.03)"/></pattern></defs><rect width="100" height="100" fill="url(%23modalGrain)"/></svg>');
            opacity: 0.4;
        }

        .modal-title-custom {
            position: relative;
            z-index: 2;
            font-weight: 600;
            font-size: 1.3rem;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .modal-title-icon {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem;
            border-radius: 8px;
            margin-right: 0.75rem;
            font-size: 1rem;
        }

        .btn-close-custom {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 8px;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            opacity: 1;
            transition: all 0.3s ease;
        }

        .btn-close-custom:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        .modal-body-custom {
            padding: 0;
            background: #f8f9fa;
        }

        .modal-table {
            margin: 0;
            border: none;
        }

        .modal-table thead th {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border: none;
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            color: #495057;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .modal-table tbody td {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #e9ecef;
            color: #6c757d;
            font-size: 0.95rem;
        }

        .modal-table tbody tr:last-child td {
            border-bottom: none;
        }

        .modal-table tbody tr:hover {
            background: rgba(10, 86, 109, 0.02);
        }

        /* Status Badge Styling */
        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: capitalize;
            letter-spacing: 0.3px;
        }

        .status-active {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            border: 1px solid #b8dacc;
        }

        .status-pending {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
            color: #856404;
            border: 1px solid #f5d975;
        }

        .status-completed {
            background: linear-gradient(135deg, #cce7ff 0%, #b3d9ff 100%);
            color: #004085;
            border: 1px solid #9ec5fe;
        }

        /* Empty State Styling */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #6c757d;
        }

        .empty-state-icon {
            font-size: 4rem;
            color: #dee2e6;
            margin-bottom: 1rem;
        }

        .empty-state h4 {
            color: #495057;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .empty-state p {
            margin: 0;
            font-size: 0.95rem;
        }

        /* Responsive Enhancements */
        @media (max-width: 768px) {
            .page-container {
                padding: 1rem 0;
            }

            .main-card {
                margin: 0 0.5rem;
                border-radius: 15px;
            }

            .card-header-custom {
                padding: 1rem 1.5rem;
            }

            .page-title-main {
                font-size: 1.5rem;
            }

            .custom-table thead th,
            .custom-table tbody td {
                padding: 1rem 0.75rem;
                font-size: 0.9rem;
            }

            .modal-dialog {
                margin: 1rem;
            }

            .modal-table thead th,
            .modal-table tbody td {
                padding: 1rem;
                font-size: 0.9rem;
            }
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .slide-up {
            animation: slideUp 0.4s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <div class="page-container">
        <div class="container-fluid px-4">
            <!-- Breadcrumb -->
            <div class="row mb-4">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-custom">
                            <li class="breadcrumb-item">
                                <a href="#"><i class="fas fa-home me-1"></i>Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <i class="fas fa-users me-1"></i>Customers
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Page Header -->
            <div class="row page-header">

            </div>

            <!-- Main Content Card -->
            <div class="row">
                <div class="col-12">
                    <div class="main-card slide-up">
                        <div class="card-header-custom">
                            <div class="card-header-title">
                                <div class="title-icon">
                                    <i class="fas fa-address-book"></i>
                                </div>
                                <div>
                                    <div>Customer Directory</div>
                                    <small style="opacity: 0.8; font-size: 0.9rem;">
                                        Total Customers: {{ count($allCustomers) }}
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            @if ($allCustomers->isEmpty())
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-users-slash"></i>
                                    </div>
                                    <h4>No Customers Found</h4>
                                    <p>You don't have any customers registered yet. When customers make bookings, they will appear here.</p>
                                </div>
                            @else
                                <div class="table-container">
                                    <table class="table custom-table">
                                        <thead>
                                            <tr>
                                                <th style="width: 80px;">
                                                    <i class="fas fa-hashtag me-2"></i>ID
                                                </th>
                                                <th>
                                                    <i class="fas fa-user me-2"></i>Customer Name
                                                </th>
                                                <th>
                                                    <i class="fas fa-envelope me-2"></i>Email Address
                                                </th>
                                                <th>
                                                    <i class="fas fa-phone me-2"></i>Phone Number
                                                </th>
                                                <th class="text-center" style="width: 120px;">
                                                    <i class="fas fa-cogs me-2"></i>Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allCustomers as $index => $customer)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="bg-light rounded-circle p-2 me-2" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                                                <small class="fw-bold text-muted">{{ $index + 1 }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fas fa-user text-primary"></i>
                                                            </div>
                                                            <div>
                                                                <div class="fw-semibold">{{ $customer->name }}</div>
                                                                <small class="text-muted">Customer ID: #{{ str_pad($customer->id, 4, '0', STR_PAD_LEFT) }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-at text-muted me-2"></i>
                                                            <span>{{ $customer->email }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-mobile-alt text-muted me-2"></i>
                                                            <span>{{ $customer->phone }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="action-btn customer-info-btn"
                                                                data-customer-id="{{ $customer->id }}"
                                                                title="View Bookings">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Modal -->
    <div class="modal fade" id="customerServicesModal" tabindex="-1" aria-labelledby="customerServicesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content modal-content-custom">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title modal-title-custom" id="customerServicesModalLabel">
                        <div class="modal-title-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        Customer Booking History
                    </h5>
                    <button type="button" class="btn-close btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body modal-body-custom">
                    <table class="table modal-table">
                        <thead>
                            <tr>
                                <th>
                                    <i class="fas fa-concierge-bell me-2"></i>Service Name
                                </th>
                                <th>
                                    <i class="fas fa-calendar-alt me-2"></i>Booking Date
                                </th>
                                <th>
                                    <i class="fas fa-info-circle me-2"></i>Status
                                </th>
                            </tr>
                        </thead>
                        <tbody id="servicesTableBody">
                            <!-- Dynamic content will be loaded here -->
                        </tbody>
                    </table>
                    <div id="loadingSpinner" class="text-center py-4" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="mt-2 text-muted">Loading booking data...</div>
                    </div>
                    <div id="noDataMessage" class="text-center py-4" style="display: none;">
                        <div class="empty-state-icon mb-3" style="font-size: 3rem;">
                            <i class="fas fa-calendar-times text-muted"></i>
                        </div>
                        <h5 class="text-muted">No Bookings Found</h5>
                        <p class="text-muted mb-0">This customer hasn't made any bookings yet.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Enhanced customer info button click handler
            $(document).on('click', '.customer-info-btn', function() {
                let customerId = $(this).data('customer-id');
                let $button = $(this);

                // Show loading state
                $button.html('<i class="fas fa-spinner fa-spin"></i>').addClass('disabled');
                $('#servicesTableBody').empty();
                $('#loadingSpinner').show();
                $('#noDataMessage').hide();
                $('#customerServicesModal').modal('show');

                $.ajax({
                    url: "{{ route('vendor.customer.services') }}",
                    method: "POST",
                    data: {
                        customer_id: customerId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#loadingSpinner').hide();
                        $button.html('<i class="fas fa-eye"></i>').removeClass('disabled');

                        if (response.status === 200) {
                            if (response.data && response.data.length > 0) {
                                let rows = '';
                                response.data.forEach((service, index) => {
                                    let statusClass = '';

                                    // Determine status styling
                                    switch(service.status.toLowerCase()) {
                                        case 'completed':
                                            statusClass = 'status-completed';
                                            statusIcon = 'fas fa-check-circle';
                                            break;
                                        case 'pending':
                                            statusClass = 'status-pending';
                                            statusIcon = 'fas fa-clock';
                                            break;
                                        case 'active':
                                            statusClass = 'status-active';
                                            statusIcon = 'fas fa-play-circle';
                                            break;
                                        default:
                                            statusClass = 'status-pending';
                                            statusIcon = 'fas fa-question-circle';
                                    }

                                    rows += `
                                        <tr class="fade-in" style="animation-delay: ${index * 0.1}s;">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-concierge-bell text-primary" style="font-size: 0.8rem;"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold">${service.name}</div>
                                                        <small class="text-muted">Service #${index + 1}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-calendar text-muted me-2"></i>
                                                    <span>${service.date}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="status-badge ${statusClass}">
                                                    <i class="${statusIcon} me-1"></i>
                                                    ${service.status}
                                                </span>
                                            </td>
                                        </tr>
                                    `;
                                });
                                $('#servicesTableBody').html(rows);
                            } else {
                                $('#noDataMessage').show();
                            }
                        } else {
                            $('#noDataMessage').show();
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#loadingSpinner').hide();
                        $button.html('<i class="fas fa-eye"></i>').removeClass('disabled');
                        $('#servicesTableBody').html(`
                            <tr>
                                <td colspan="3" class="text-center text-danger py-4">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    Error loading booking data. Please try again.
                                </td>
                            </tr>
                        `);
                    }
                });
            });

            // Enhanced modal events
            $('#customerServicesModal').on('shown.bs.modal', function () {
                $(this).find('.fade-in').each(function(index) {
                    $(this).css('animation-delay', (index * 0.1) + 's');
                });
            });

            $('#customerServicesModal').on('hidden.bs.modal', function () {
                $('#servicesTableBody').empty();
                $('#loadingSpinner').hide();
                $('#noDataMessage').hide();
            });

            // Add smooth scrolling and hover effects
            $('.custom-table tbody tr').hover(
                function() {
                    $(this).find('.action-btn').addClass('shadow-sm');
                },
                function() {
                    $(this).find('.action-btn').removeClass('shadow-sm');
                }
            );

            // Initialize tooltips if Bootstrap tooltips are available
            if (typeof bootstrap !== 'undefined') {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            }
        });
    </script>
@endsection
