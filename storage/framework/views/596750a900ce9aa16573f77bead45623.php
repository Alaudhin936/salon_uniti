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

    padding: 10px;
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
            position: relative;
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

        /* Filter Button Styling */
        .filter-nav {
            background: white;
            border-radius: 15px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            position: relative;
        }

        .filter-btn {
            padding: 0.6rem 1.2rem;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            background: transparent;
            color: #6c757d;
            position: relative;
            overflow: hidden;
        }

        .filter-btn.active {
           background: linear-gradient(135deg, #0ba18c 0%, #00ff3ca1 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(10, 86, 109, 0.2);
        }

        .filter-btn:hover:not(.active) {
            background: rgba(10, 86, 109, 0.1);
            color: #0a566d;
        }

        .filter-btn.loading {
            pointer-events: none;
            opacity: 0.7;
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

        .filter-loading {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin-left: 8px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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

        .status-booked {
            background: linear-gradient(135deg, #cce7ff 0%, #b3d9ff 100%);
            color: #004085;
            border: 1px solid #9ec5fe;
        }

        .status-pending {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
            color: #856404;
            border: 1px solid #f5d975;
        }

        .status-completed {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            border: 1px solid #b8dacc;
        }

        .status-cancelled {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
            border: 1px solid #f1b0b7;
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
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
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

        /* DataTable Enhancements - Remove Sorting Styles */
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

        /* Ensure no sorting indicators appear */
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

            .filter-nav {
                padding: 0.75rem;
            }

            .filter-btn {
                padding: 0.5rem 1rem;
                font-size: 0.85rem;
            }

            .action-btn {
                width: 36px;
                height: 36px;
            }

            .filter-nav .nav-pills {
                flex-wrap: wrap;
                gap: 0.5rem !important;
            }

            .filter-nav .nav-pills .nav-item {
                flex: 1 1 45%;
                min-width: 120px;
            }

            .filter-btn {
                width: 100%;
                text-align: center;
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

        /* DataTable Processing Enhancement */
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
                                <i class="fas fa-users me-1"></i>Appointments
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
                                <div class="title-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div>
                                    <div>Appointment Management</div>
                                    <small style="opacity: 0.8; font-size: 0.9rem;">
                                        Manage all your customer appointments
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <!-- Filter Navigation -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="filter-nav d-flex justify-content-center">
                                        <ul class="nav nav-pills d-flex gap-2" id="appointmentFilter">
                                            <li class="nav-item">
                                                <button class="filter-btn active" data-filter="upcoming">
                                                    <i class="fas fa-clock me-1"></i>Upcoming
                                                </button>
                                            </li>
                                            <li class="nav-item">
                                                <button class="filter-btn" data-filter="completed">
                                                    <i class="fas fa-check-circle me-1"></i>Completed
                                                </button>
                                            </li>
                                            <li class="nav-item">
                                                <button class="filter-btn" data-filter="cancelled">
                                                    <i class="fas fa-times-circle me-1"></i>Cancelled
                                                </button>
                                            </li>
                                            <li class="nav-item">
                                                <button class="filter-btn" data-filter="all">
                                                    <i class="fas fa-list me-1"></i>All Appointments
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Appointments Table -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-container">
                                        <!-- Loading Overlay -->
                                        <div class="table-loading-overlay" id="tableLoadingOverlay">
                                            <div class="loading-content">
                                                <div class="loading-spinner"></div>
                                                <div class="fw-semibold">Loading appointments...</div>
                                                <small class="text-muted">Please wait while we fetch the data</small>
                                            </div>
                                        </div>

                                        <table id="appointmentsTable" class="table custom-table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <i class="fas fa-user me-2"></i>Customer
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-concierge-bell me-2"></i>Service
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-calendar me-2"></i>Date
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-clock me-2"></i>Time Slot
                                                    </th>
                                                    <th class="text-center">
                                                        <i class="fas fa-info-circle me-2"></i>Status
                                                    </th>
                                                    <th class="text-center">
                                                        <i class="fas fa-cogs me-2"></i>Actions
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

    <!-- Book Appointment Modal -->
    <div class="modal fade" id="bookAppointmentModal" tabindex="-1" aria-labelledby="bookAppointmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-custom">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title modal-title-custom" id="bookAppointmentModalLabel">
                        <div class="modal-title-icon">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        Book New Appointment
                    </h5>
                    <button type="button" class="btn-close btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <form id="bookAppointmentForm" method="GET" action="<?php echo e(route('bookings.index')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="mb-4">
                            <label for="user_id" class="form-label fw-semibold mb-2">Select Customer</label>
                            <select class="form-control p-3 rounded-3 border-0 shadow-sm" name="user_id" required style="background: #f8f9fa;">
                                <option value="">-- Choose Customer --</option>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="service_id" class="form-label fw-semibold mb-2">Select Service</label>
                            <select class="form-control p-3 rounded-3 border-0 shadow-sm" name="service_id" required style="background: #f8f9fa;">
                                <option value="">-- Choose Service --</option>
                                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option data-duration="<?php echo e($service->duration); ?>" value="<?php echo e($service->id); ?>">
                                        <?php echo e($service->name); ?> - $<?php echo e($service->price); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="date" class="form-label fw-semibold mb-2">Appointment Date</label>
                            <input type="text" class="form-control p-3 rounded-3 border-0 shadow-sm datepicker" name="date" id="date"
                                placeholder="Select Date" required
                                data-mindate="<?php echo e(\Carbon\Carbon::today()->format('Y-m-d')); ?>" style="background: #f8f9fa;">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg rounded-3 fw-semibold py-3">
                                <i class="fas fa-arrow-right me-2"></i>Proceed to Time Selection
                            </button>
                        </div>
                    </form>
                </div>
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
        function markAppointment(appointmentId, status) {
            let myUrl = "<?php echo e(route('appointments.markdone', [':id', ':status'])); ?>"
                .replace(':id', appointmentId)
                .replace(':status', status);

            // Show loading on the specific button
            const button = $(`.appointment-mark-${status === 'completed' ? 'done' : 'reject'}[data-appointment-id="${appointmentId}"]`);
            const originalHtml = button.html();
            button.html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);

            $.ajax({
                url: myUrl,
                type: "POST",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                success: function(response) {
                    if (response.status == 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: `Service ${response.data} Successfully`,
                            confirmButtonColor: '#0a566d',
                            confirmButtonText: 'OK',
                            timer: 3000,
                            showConfirmButton: true
                        }).then(function(result) {
                            table.ajax.reload(null, false); // Reload table without resetting pagination
                        });
                    }
                },
                error: function(xhr) {
                    button.html(originalHtml).prop('disabled', false);

                    let errorMessage = "An error occurred. Please try again.";
                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        errorMessage = "Validation error: " + Object.values(xhr.responseJSON.errors).join(", ");
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage,
                        confirmButtonColor: '#dc3545',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }

        function showTableLoading() {
            $('#tableLoadingOverlay').addClass('show');
        }

        function hideTableLoading() {
            $('#tableLoadingOverlay').removeClass('show');
        }

        $(document).ready(function() {
            // Initialize flatpickr
            flatpickr(".datepicker", {
                dateFormat: "Y-m-d",
                minDate: "today",
                disable: [
                    function(date) {
                        return;
                    }
                ],
                locale: {
                    firstDayOfWeek: 1
                }
            });

            // Initialize DataTable with enhanced loading states
            var table = $('#appointmentsTable').DataTable({
                serverSide: true,
                processing: true,
                ordering: false, // Disable all sorting
                ajax: {
                    url: "<?php echo e(route('appointments.data')); ?>",
                    data: function(d) {
                        d.status = $('#appointmentFilter .filter-btn.active').data('filter');
                    },
                    beforeSend: function() {
                        showTableLoading();
                    },
                    complete: function() {
                        hideTableLoading();
                    }
                },
                columns: [{
                        data: 'customer_name',
                        name: 'customers.name',
                        orderable: false,
                        render: function(data, type, row) {
                            return `
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-user text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">${data || 'N/A'}</div>
                                    </div>
                                </div>
                            `;
                        }
                    },
                    {
                        data: 'service_name',
                        name: 'services.name',
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
                        data: 'date',
                        name: 'appointments.date',
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
                        data: 'slot_start',
                        name: 'appointments.slot_start',
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
                        data: 'status',
                        name: 'appointments.status',
                        className: 'text-center',
                        orderable: false,
                        render: function(data, type, row) {
                            let statusClass = 'status-pending';
                            let icon = 'fas fa-clock';

                            if (data === 'completed') {
                                statusClass = 'status-completed';
                                icon = 'fas fa-check-circle';
                            } else if (data === 'cancelled') {
                                statusClass = 'status-cancelled';
                                icon = 'fas fa-times-circle';
                            } else if (data === 'booked') {
                                statusClass = 'status-booked';
                                icon = 'fas fa-calendar-check';
                            }

                            return `
                                <span class="status-badge ${statusClass}">
                                    <i class="${icon} me-1"></i>
                                    ${data || 'pending'}
                                </span>
                            `;
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,

                    }
                ],
                pageLength: 10,
                lengthMenu: [[5, 10, 25, 50], [5, 10, 25, 50]],
                responsive: true,
                language: {
                    emptyTable: `
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="fas fa-calendar-times"></i>
                            </div>
                            <h4>No Appointments Found</h4>
                            <p>You don't have any appointments with this status yet.</p>
                        </div>
                    `,
                    processing: `
                        <div class="d-flex align-items-center justify-content-center p-3">
                            <div class="loading-spinner me-3"></div>
                            <div>
                                <div class="fw-semibold text-primary">Loading appointments...</div>
                                <small class="text-muted">Please wait while we fetch the data</small>
                            </div>
                        </div>
                    `,
                    search: "Search appointments:",
                    lengthMenu: "Show _MENU_ appointments per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ appointments",
                    infoEmpty: "No appointments to show",
                    infoFiltered: "(filtered from _MAX_ total appointments)",
                    zeroRecords: "No matching appointments found",
                    paginate: {
                        first: '<i class="fas fa-angle-double-left"></i>',
                        last: '<i class="fas fa-angle-double-right"></i>',
                        next: '<i class="fas fa-angle-right"></i>',
                        previous: '<i class="fas fa-angle-left"></i>'
                    }
                },
                drawCallback: function(settings) {
                    // Add fade-in animation to new rows
                    $('#appointmentsTable tbody tr').addClass('fade-in');

                    // Initialize tooltips for action buttons
                    $('[title]').tooltip({
                        placement: 'top',
                        trigger: 'hover'
                    });
                }
            });

            // Handle filter button click with loading state
            $('#appointmentFilter .filter-btn').on('click', function() {
                const $this = $(this);
                const $allButtons = $('#appointmentFilter .filter-btn');

                // Prevent multiple clicks
                if ($this.hasClass('loading')) return;

                // Add loading state to clicked button
                $this.addClass('loading');
                const originalHtml = $this.html();
                $this.html(originalHtml + '<span class="filter-loading"></span>');

                // Remove active class from all buttons
                $allButtons.removeClass('active');

                // Add active class to clicked button
                $this.addClass('active');

                // Reload table with new filter
                table.ajax.reload(function() {
                    // Remove loading state after reload
                    setTimeout(() => {
                        $this.removeClass('loading');
                        $this.html(originalHtml);
                    }, 500);
                }, false);
            });

            // Handle action buttons with improved feedback
            $('#appointmentsTable tbody').on('click', '.appointment-mark-done, .appointment-mark-reject', function(e) {
                e.preventDefault();

                const $button = $(this);
                const appointmentId = $button.data('appointment-id');
                const status = $button.data('status');
                const actionType = status === 'completed' ? 'complete' : 'cancel';

                // Confirmation dialog
                Swal.fire({
                    title: `${actionType === 'complete' ? 'Complete' : 'Cancel'} Appointment?`,
                    text: `Are you sure you want to ${actionType} this appointment?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: actionType === 'complete' ? '#28a745' : '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: `Yes, ${actionType} it!`,
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        markAppointment(appointmentId, status);
                    }
                });
            });

            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();

            // Add smooth scrolling to top when pagination is clicked
            $('#appointmentsTable').on('page.dt', function() {
                $('html, body').animate({
                    scrollTop: $('.table-container').offset().top - 100
                }, 500);
            });

            // Auto-refresh every 5 minutes (optional)
            setInterval(function() {
                if (!$('#appointmentFilter .filter-btn').hasClass('loading')) {
                    table.ajax.reload(null, false);
                }
            }, 300000); // 5 minutes

            // Handle window resize for responsive behavior
            $(window).on('resize', function() {
                table.columns.adjust().responsive.recalc();
            });
        });

        // Additional utility functions
        function refreshAppointments() {
            if (typeof table !== 'undefined') {
                showTableLoading();
                table.ajax.reload(function() {
                    hideTableLoading();
                }, false);
            }
        }

        // Export function (can be called from other parts of the application)
        window.appointmentManager = {
            refresh: refreshAppointments,
            showLoading: showTableLoading,
            hideLoading: hideTableLoading
        };
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp8.2\htdocs\salon_unitiii\resources\views/appointments.blade.php ENDPATH**/ ?>