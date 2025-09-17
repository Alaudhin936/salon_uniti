<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
            background: linear-gradient(135deg, #0ba18c 0%, #00ff3d21 100%);
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
            justify-content: space-between;
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
            padding: 20px !important;
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
            position: relative;
        }

        .custom-table {
            margin: 0;
            border: none;
        }

        .custom-table thead th {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
            border: none !important;
            font-weight: 600 !important;
            color: #495057 !important;
            padding: 1.25rem 1rem !important;
            font-size: 0.95rem !important;
            letter-spacing: 0.5px !important;
            text-transform: uppercase !important;
            position: relative !important;
            cursor: default !important;
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

        /* Remove DataTables sorting classes and styles */
        .custom-table thead th.sorting,
        .custom-table thead th.sorting_asc,
        .custom-table thead th.sorting_desc,
        .custom-table thead th.sorting_asc_disabled,
        .custom-table thead th.sorting_desc_disabled {
            cursor: default !important;
            position: relative;
        }

        .custom-table thead th.sorting:before,
        .custom-table thead th.sorting:after,
        .custom-table thead th.sorting_asc:before,
        .custom-table thead th.sorting_asc:after,
        .custom-table thead th.sorting_desc:before,
        .custom-table thead th.sorting_desc:after,
        .custom-table thead th.sorting_asc_disabled:before,
        .custom-table thead th.sorting_asc_disabled:after,
        .custom-table thead th.sorting_desc_disabled:before,
        .custom-table thead th.sorting_desc_disabled:after {
            display: none !important;
            content: none !important;
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
            margin: 0 2px;
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

        .action-btn.btn-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        }

        .action-btn.btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        }

        .btn-outline-primary i {
    color: #0d6efd; /* Primary blue */
}
.btn-outline-danger i {
    color: #dc3545; /* Red */
}

.btn-outline-primary:hover i,
.btn-outline-danger:hover i {
    color: #fff; /* White on hover */
}
        /* Register Button Styling */
        .register-btn {
            background: linear-gradient(135deg, #0ba18c 0%, #00ff3d21 100%);
            border: none;
            border-radius: 15px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .register-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .register-btn:hover::before {
            left: 100%;
        }

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
        }

        /* Loading States */
        .table-loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            backdrop-filter: blur(2px);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .table-loading-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .loading-content {
            text-align: center;
            color: #0a566d;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid #e3f2fd;
            border-top: 3px solid #0a566d;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Status Badge Styling */
        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: capitalize;
            letter-spacing: 0.3px;
            display: inline-flex;
            align-items: center;
        }

        .status-active {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            border: 1px solid #b8dacc;
        }

        .status-inactive {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
            border: 1px solid #f1b0b7;
        }

        /* Modal Enhancements */
        .modal-content-custom {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .modal-header-custom {
            background: linear-gradient(135deg, #0a566d 0%, #007bff 100%);
            color: white;
            border: none;
            padding: 1.5rem 2rem;
            border-radius: 20px 20px 0 0;
        }

        .modal-title-custom {
            display: flex;
            align-items: center;
            font-weight: 600;
        }

        .modal-title-icon {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem;
            border-radius: 10px;
            margin-right: 0.75rem;
        }

        .btn-close-custom {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 0.5rem;
            opacity: 1;
        }

        /* Form Enhancements */
        .form-control-custom {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-control-custom:focus {
            border-color: #0a566d;
            box-shadow: 0 0 0 0.2rem rgba(10, 86, 109, 0.25);
            background: white;
        }

        .form-label-custom {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
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
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
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

        /* DataTable Enhancements */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px;
            margin: 0 2px;
            transition: all 0.3s ease;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, #0a566d 0%, #007bff 100%) !important;
            color: white !important;
            border: none !important;
        }

        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_length {
            color: #6c757d;
            font-weight: 500;
        }

        .dataTables_processing {
            position: absolute !important;
            top: 50% !important;
            left: 50% !important;
            width: auto !important;
            height: auto !important;
            margin: 0 !important;
            border: none !important;
            border-radius: 15px !important;
            background: rgba(255, 255, 255, 0.95) !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
            color: #0a566d !important;
            font-weight: 600 !important;
            padding: 1rem 2rem !important;
            transform: translate(-50%, -50%) !important;
            backdrop-filter: blur(5px) !important;
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

            .action-btn {
                width: 36px;
                height: 36px;
            }

            .register-btn {
                padding: 0.6rem 1.5rem;
                font-size: 0.9rem;
            }
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-up {
            animation: slideUp 0.4s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
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
                                <i class="fas fa-cut me-1"></i>Salons
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Main Content Card -->
            <div class="row">
                <div class="col-12">
                    <div class="main-card slide-up">
                        <div class="card-header-custom">
                            <div class="card-header-title">
                                <div class="d-flex align-items-center">
                                    <div class="title-icon">
                                        <i class="fas fa-cut"></i>
                                    </div>
                                    <div>
                                        <div>Salon Management</div>
                                        <small style="opacity: 0.8; font-size: 0.9rem;">
                                            Manage all registered salons and vendors
                                        </small>
                                    </div>
                                </div>
                                <button class="btn register-btn" data-bs-toggle="modal"
                                    data-bs-target="#registerSalonModal">
                                    <i class="fas fa-plus me-2"></i>Register New Salon
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <!-- Salons Table -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-container">
                                        <!-- Loading Overlay -->
                                        <div class="table-loading-overlay" id="tableLoadingOverlay">
                                            <div class="loading-content">
                                                <div class="loading-spinner"></div>
                                                <div class="fw-semibold">Loading salons...</div>
                                                <small class="text-muted">Please wait while we fetch the data</small>
                                            </div>
                                        </div>

                                        <table id="salonTable" class="table custom-table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        <i class="fas fa-hashtag me-2"></i>
                                                    </th>
                                                    <th>
                                                        Business Name
                                                    </th>
                                                    <th class="text-center">
                                                        Type
                                                    </th>
                                                    <th>
                                                        Location
                                                    </th>
                                                    <th>
                                                        Vendor Name
                                                    </th>
                                                    <th>
                                                        Email
                                                    </th>
                                                    <th class="text-center">
                                                        Action
                                                    </th>
                                                    <th class="text-center">
                                                        Status
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Table body will be populated by DataTables -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Salon Details Modal -->
    <div class="modal fade" id="salonModal" tabindex="-1" aria-labelledby="salonModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-content-custom">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title modal-title-custom" id="salonModalLabel">
                        <div class="modal-title-icon">
                            <i class="fas fa-store"></i>
                        </div>
                        Salon Details
                    </h5>
                    <button type="button" class="btn-close btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times text-white"></i>
                    </button>
                </div>

                <div class="modal-body p-0">
                    <!-- Cover Photo Section -->
                    <div class="position-relative mb-3"
                        style="height: 200px; background: linear-gradient(45deg, #f8f9fa, #e9ecef);">
                        <img id="salonCoverPhoto"
                            src="https://via.placeholder.com/600x150/667eea/ffffff?text=Salon+Cover+Photo" alt="Cover Photo"
                            class="w-100 h-100" style="object-fit: cover;">
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
                                            <h6 class="fw-bold text-success mb-0">Email</h6>
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
                                        <span class="fw-semibold text-dark" id="salonLocation">123 Main Street, City,
                                            State</span>
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
                                <div class="info-item bg-success rounded-3 p-3 h-100 shadow-sm text-white">
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

    <!-- Register Salon Modal -->
    <div class="modal fade" id="registerSalonModal" tabindex="-1" aria-labelledby="registerSalonModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-content-custom">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title modal-title-custom" id="registerSalonModalLabel">
                        <div class="modal-title-icon">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        Register New Salon
                    </h5>
                    <button type="button" class="btn-close btn-close-custom" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fas fa-times text-white"></i>
                    </button>
                </div>

                <form id="registerSalonForm">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label form-label-custom">Vendor Name</label>
                                <input type="text" name="name" class="form-control form-control-custom" required>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label form-label-custom">Vendor Email</label>
                                <input type="email" name="email" class="form-control form-control-custom" required>
                            </div>

                            <div class="col-md-6">
                                <label for="phone" class="form-label form-label-custom">Phone</label>
                                <input type="text" name="phone" class="form-control form-control-custom" required>
                            </div>

                            <div class="col-md-6">
                                <label for="business_name" class="form-label form-label-custom">Business Name</label>
                                <input type="text" name="business_name" class="form-control form-control-custom"
                                    required>
                            </div>

                            <div class="col-md-6">
                                <label for="slogan" class="form-label form-label-custom">Slogan</label>
                                <input type="text" name="slogan" class="form-control form-control-custom">
                            </div>

                            <div class="col-md-6">
                                <label for="salon_type_id" class="form-label form-label-custom">Type</label>
                                <select id="salon_type_id" name="salon_type_id" class="form-control form-control-custom">
                                    <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($type->id); ?>">
                                            <?php echo e($type->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="location" class="form-label form-label-custom">Location</label>
                                <input type="text" name="location" class="form-control form-control-custom" required>
                            </div>

                            <div class="col-md-6">
                                <label for="gst_number" class="form-label form-label-custom">GST Number (optional)</label>
                                <input type="text" name="gst_number" class="form-control form-control-custom">
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="form-label form-label-custom">Password</label>
                                <input type="password" name="password" class="form-control form-control-custom">
                            </div>

                            <div class="col-md-6">
                                <label for="is_active" class="form-label form-label-custom">Status</label>
                                <select id="is_active" name="is_active" class="form-control form-control-custom">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="lattitude" class="form-label form-label-custom">Latitude (Optional)</label>
                                <input type="text" name="lattitude" class="form-control form-control-custom">
                            </div>

                            <div class="col-md-3">
                                <label for="longitude" class="form-label form-label-custom">Longitude (Optional)</label>
                                <input type="text" name="longitude" class="form-control form-control-custom">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-0 p-4">
                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Close
                        </button>
                        <button type="submit" class="btn register-btn rounded-pill px-4" id="saveSalonBtn">
                            <i class="fas fa-save me-2"></i>Save Salon
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/counter/jquery.waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/counter/jquery.counterup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/counter/counter-custom.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/support-ticket-custom.js')); ?>"></script>

    <script>
        function showTableLoading() {
            $('#tableLoadingOverlay').addClass('show');
        }

        function hideTableLoading() {
            $('#tableLoadingOverlay').removeClass('show');
        }

        $(document).ready(function() {
            // Initialize DataTable with enhanced loading states
            var table = $('#salonTable').DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: {
                    url: "<?php echo e(route('salonData')); ?>",
                    beforeSend: function() {
                        showTableLoading();
                    },
                    complete: function() {
                        hideTableLoading();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: "text-center",
                        render: function(data, type, row) {
                            return `
                                <div class="fw-semibold text-primary bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                    ${data}
                                </div>
                            `;
                        }
                    },
                    {
                        data: 'business_name',
                        name: 'vd.business_name',
                        orderable: false,
                        render: function(data, type, row) {
                            return `
                                <div class="d-flex align-items-center">

                                    <div>
                                        <div class="fw-semibold">${data || 'N/A'}</div>
                                    </div>
                                </div>
                            `;
                        }
                    },
                    {
                        data: 'salon_type_name',
                        name: 'st.name',
                        className: "text-center",
                        orderable: false,
                        render: function(data, type, row) {
                            return `
                                <span class="badge bg-secondary bg-opacity-20 text-dark rounded-pill px-3 py-2">
                                    <i class="fas fa-tag me-1"></i>${data || 'N/A'}
                                </span>
                            `;
                        }
                    },
                    {
                        data: 'location',
                        name: 'vd.location',
                        orderable: false,
                        render: function(data, type, row) {
                            return `
                                <div class="d-flex align-items-center">

                                    <div>
                                        <div class="fw-semibold text-truncate" style="max-width: 200px;" title="${data || 'N/A'}">${data || 'N/A'}</div>
                                    </div>
                                </div>
                            `;
                        }
                    },
                    {
                        data: 'vendor_name',
                        name: 'u.name',
                        orderable: false,
                        render: function(data, type, row) {
                            return `
                                <div class="d-flex align-items-center">

                                    <div>
                                        <div class="fw-semibold">${data || 'N/A'}</div>
                                    </div>
                                </div>
                            `;
                        }
                    },
                    {
                        data: 'email',
                        name: 'u.email',
                        orderable: false,
                        render: function(data, type, row) {
                            return `
                                <div class="d-flex align-items-center">

                                    <div>
                                        <div class="fw-semibold small">${data || 'N/A'}</div>
                                    </div>
                                </div>
                            `;
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: "text-center",
                        render: function(data, type, row) {
                            return `
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="btn btn-sm btn-outline-primary viewSalonBtn" data-id="${row.id}" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="deleteSalon(${row.id})" title="Delete Salon">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            `;
                        }

                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false,
                        className: "text-center",
                        render: function(data, type, row) {
                            if (parseInt(data) === 1) {
                                console.log(data);
                                return `
                <span class="status-badge status-active">
                    <i class="fas fa-check-circle me-1"></i>Active
                </span>
            `;
                            } else {
                                return `
                <span class="status-badge status-inactive">
                    <i class="fas fa-times-circle me-1"></i>Inactive
                </span>
            `;
                            }
                        }
                    }
                ],
                pageLength: 10,
                lengthMenu: [
                    [5, 10, 25, 50],
                    [5, 10, 25, 50]
                ],
                responsive: true,
                language: {
                    emptyTable: `
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="fas fa-store-slash"></i>
                            </div>
                            <h4>No Salons Found</h4>
                            <p>No salons have been registered yet. Click "Register New Salon" to add one.</p>
                        </div>
                    `,
                    processing: `
                        <div class="d-flex align-items-center justify-content-center p-3">
                            <div class="loading-spinner me-3"></div>
                            <div>
                                <div class="fw-semibold text-primary">Loading salons...</div>
                                <small class="text-muted">Please wait while we fetch the data</small>
                            </div>
                        </div>
                    `,
                    search: "Search salons:",
                    lengthMenu: "Show _MENU_ salons per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ salons",
                    infoEmpty: "No salons to show",
                    infoFiltered: "(filtered from _MAX_ total salons)",
                    zeroRecords: "No matching salons found",
                    paginate: {
                        first: '<i class="fas fa-angle-double-left"></i>',
                        last: '<i class="fas fa-angle-double-right"></i>',
                        next: '<i class="fas fa-angle-right"></i>',
                        previous: '<i class="fas fa-angle-left"></i>'
                    }
                },
                drawCallback: function(settings) {
                    // Add fade-in animation to new rows
                    $('#salonTable tbody tr').addClass('fade-in');

                    // Initialize tooltips for action buttons
                    $('[title]').tooltip({
                        placement: 'top',
                        trigger: 'hover'
                    });
                }
            });

            // Handle salon registration form submission
            $('#registerSalonForm').submit(function(e) {
                e.preventDefault();

                const $submitBtn = $('#saveSalonBtn');
                const originalHtml = $submitBtn.html();

                // Show loading state
                $submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Saving...').prop('disabled',
                    true);

                $.ajax({
                    url: "<?php echo e(route('salons.store')); ?>",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $submitBtn.html(originalHtml).prop('disabled', false);

                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: `Salon ${response.data} Successfully`,
                                confirmButtonColor: '#0a566d',
                                confirmButtonText: 'OK',
                                timer: 3000,
                                showConfirmButton: true
                            }).then(function(result) {
                                $('#registerSalonModal').modal('hide');
                                $('#registerSalonForm')[0].reset();
                                table.ajax.reload(null, false);
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message || 'Error saving salon',
                                confirmButtonColor: '#dc3545',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr) {
                        $submitBtn.html(originalHtml).prop('disabled', false);

                        let errorText = 'Something went wrong.';

                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            errorText = Object.values(errors).flat().join('\n');
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorText = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorText,
                            confirmButtonColor: '#dc3545',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            // Handle view salon details
            $(document).on('click', '.viewSalonBtn', function() {
                const $button = $(this);
                const salonId = $button.data('id');
                const originalHtml = $button.html();

                // Show loading state
                $button.html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);

                let myUrl = "<?php echo e(route('salon.details', ':id')); ?>".replace(':id', salonId);

                $.ajax({
                    url: myUrl,
                    type: 'POST',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                    },
                    success: function(response) {
                        $button.html(originalHtml).prop('disabled', false);

                        $('#salonName').text(response.business_name || 'N/A');
                        $('#salonEmail').text(response.email || 'N/A');
                        $('#salonType').text(response.name || 'N/A');
                        $('#salonPhone').text(response.phone || 'N/A');
                        $('#salonLocation').text(response.location || 'N/A');
                        $('#salonGst').text(response.gst_number || 'N/A');
                        $('#salonRevenue').text('₹' + (response.total_revenue || '0'));

                        if (response.cover_photo) {
                            $('#salonCoverPhoto').attr('src', '<?php echo e(asset('storage')); ?>/' +
                                response.cover_photo);
                        }

                        $('#salonModal').modal('show');
                    },
                    error: function(xhr) {
                        $button.html(originalHtml).prop('disabled', false);

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to load salon details',
                            confirmButtonColor: '#dc3545',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();

            // Add smooth scrolling when pagination is clicked
            $('#salonTable').on('page.dt', function() {
                $('html, body').animate({
                    scrollTop: $('.table-container').offset().top - 100
                }, 500);
            });

            // Handle window resize for responsive behavior
            $(window).on('resize', function() {
                table.columns.adjust().responsive.recalc();
            });
        });

        function deleteSalon(salonId) {
            Swal.fire({
                title: 'Delete Salon?',
                text: 'Are you sure you want to delete this salon? This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({

                    })
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'Salon has been deleted successfully.',
                        confirmButtonColor: '#0a566d',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    // Reload table
                    $('#salonTable').DataTable().ajax.reload(null, false);
                }
            });
        }

        // Additional utility functions
        function refreshSalons() {
            showTableLoading();
            $('#salonTable').DataTable().ajax.reload(function() {
                hideTableLoading();
            }, false);
        }

        // Export function (can be called from other parts of the application)
        window.salonManager = {
            refresh: refreshSalons,
            showLoading: showTableLoading,
            hideLoading: hideTableLoading
        };
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp8.2\htdocs\salon_unitiii\resources\views/salons.blade.php ENDPATH**/ ?>