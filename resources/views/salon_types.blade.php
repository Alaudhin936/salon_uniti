@extends('layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Enhanced Professional Styling */
        .page-container {
            background: linear-gradient(135deg, #f8fafc 0%, #e8f5e8 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }

        .main-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(11, 161, 140, 0.08);
            border: 1px solid rgba(11, 161, 140, 0.05);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .main-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 50px rgba(11, 161, 140, 0.12);
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
            padding: 0.75rem 0;
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
            color: #0ba18c;
        }

        .breadcrumb-custom .breadcrumb-item.active {
            color: #0ba18c;
            font-weight: 600;
        }

        .page-title-main {
            color: #0ba18c;
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
            background: linear-gradient(90deg, #0ba18c, #20c997);
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
            background: linear-gradient(90deg, #0ba18c, #20c997);
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
            background: linear-gradient(135deg, #f8fafc 0%, #e8f5e8 100%);
            transform: scale(1.002);
        }

        .custom-table tbody tr:hover td {
            color: #0ba18c;
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
            background: linear-gradient(135deg, #0ba18c 0%, #20c997 100%);
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
            box-shadow: 0 8px 25px rgba(11, 161, 140, 0.3);
        }

        .action-btn.btn-warning {
            background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
        }

        .action-btn.btn-warning:hover {
            box-shadow: 0 8px 25px rgba(255, 193, 7, 0.3);
        }

        .action-btn.btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        }

        .action-btn.btn-danger:hover {
            box-shadow: 0 8px 25px rgba(220, 53, 69, 0.3);
        }

        /* Add Button Styling */
        .add-btn {
            background: linear-gradient(135deg, #0ba18c 0%, #20c997 100%);
            border: none;
            border-radius: 15px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .add-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .add-btn:hover::before {
            left: 100%;
        }

        .add-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(11, 161, 140, 0.3);
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
            color: #0ba18c;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid #e8f5e8;
            border-top: 3px solid #0ba18c;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Modal Enhancements */
        .modal-content-custom {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .modal-header-custom {
            background: linear-gradient(135deg, #0ba18c 0%, #20c997 100%);
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
            border-color: #0ba18c;
            box-shadow: 0 0 0 0.2rem rgba(11, 161, 140, 0.25);
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

        /* DataTable Enhancements */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px;
            margin: 0 2px;
            transition: all 0.3s ease;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, #0ba18c 0%, #20c997 100%) !important;
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
            color: #0ba18c !important;
            font-weight: 600 !important;
            padding: 1rem 2rem !important;
            transform: translate(-50%, -50%) !important;
            backdrop-filter: blur(5px) !important;
        }

        /* ID Column Styling */
        .id-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #0ba18c 0%, #20c997 100%);
            color: white;
            border-radius: 50%;
            font-weight: 600;
            font-size: 0.85rem;
        }

        /* Name Column Styling */
        .name-content {
            display: flex;
            align-items: center;
        }

        .name-icon {
            background: linear-gradient(135deg, #e3f2fd 0%, #e8f5e8 100%);
            color: #0ba18c;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
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

            .add-btn {
                padding: 0.6rem 1.5rem;
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
@endsection

@section('main_content')
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
                                <i class="fas fa-tags me-1"></i>Salon Types
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
                                        <i class="fas fa-tags"></i>
                                    </div>
                                    <div>
                                        <div>Salon Types Management</div>
                                        <small style="opacity: 0.8; font-size: 0.9rem;">
                                            Manage salon categories and types
                                        </small>
                                    </div>
                                </div>
                                <button class="btn add-btn" data-bs-toggle="modal" data-bs-target="#addSalonTypeModal">
                                    <i class="fas fa-plus-circle me-2"></i>Add Category
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <!-- Salon Types Table -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-container">
                                        <!-- Loading Overlay -->
                                        <div class="table-loading-overlay" id="tableLoadingOverlay">
                                            <div class="loading-content">
                                                <div class="loading-spinner"></div>
                                                <div class="fw-semibold">Loading salon types...</div>
                                                <small class="text-muted">Please wait while we fetch the data</small>
                                            </div>
                                        </div>

                                        <table id="salonTypesTable" class="table custom-table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        <i class="fas fa-hashtag me-2"></i>ID
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-tag me-2"></i>Name
                                                    </th>
                                                    <th class="text-center">
                                                        <i class="fas fa-cogs me-2"></i>Actions
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($salonTypes as $type)
                                                    <tr class="fade-in">
                                                        <td class="text-center">
                                                            <span class="id-badge">{{ $type->id }}</span>
                                                        </td>
                                                        <td>
                                                            <div class="name-content">
                                                                <div class="name-icon">
                                                                    <i class="fas fa-cut"></i>
                                                                </div>
                                                                <div>
                                                                    <div class="fw-semibold">{{ $type->name }}</div>
                                                                    <small class="text-muted">Salon Category</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <button class="action-btn btn-warning editBtn me-2"
                                                                    data-id="{{ $type->id }}"
                                                                    data-name="{{ $type->name }}"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#editSalonTypeModal"
                                                                    title="Edit Type">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button class="action-btn btn-danger deleteBtn"
                                                                    data-id="{{ $type->id }}"
                                                                    title="Delete Type">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
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

    <!-- Add Salon Type Modal -->
    <div class="modal fade" id="addSalonTypeModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-custom">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title modal-title-custom">
                        <div class="modal-title-icon">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        Add Salon Type
                    </h5>
                    <button type="button" class="btn-close btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times text-white"></i>
                    </button>
                </div>
                <form id="addSalonTypeForm">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label for="add_name" class="form-label form-label-custom">
                                <i class="fas fa-tag me-2"></i>Salon Type Name
                            </label>
                            <input type="text" name="name" id="add_name" class="form-control form-control-custom"
                                   placeholder="Enter Salon Type (e.g., Premium, Budget, Luxury)" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4">
                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Cancel
                        </button>
                        <button type="submit" class="btn add-btn rounded-pill px-4" id="addSalonTypeBtn">
                            <i class="fas fa-save me-2"></i>Save Type
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Salon Type Modal -->
    <div class="modal fade" id="editSalonTypeModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-custom">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title modal-title-custom">
                        <div class="modal-title-icon">
                            <i class="fas fa-edit"></i>
                        </div>
                        Edit Salon Type
                    </h5>
                    <button type="button" class="btn-close btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times text-white"></i>
                    </button>
                </div>
                <form id="editSalonTypeForm">
                    @csrf
                    <input type="hidden" name="id" id="edit_id">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label form-label-custom">
                                <i class="fas fa-tag me-2"></i>Salon Type Name
                            </label>
                            <input type="text" name="name" id="edit_name" class="form-control form-control-custom" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4">
                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Cancel
                        </button>
                        <button type="submit" class="btn add-btn rounded-pill px-4" id="editSalonTypeBtn">
                            <i class="fas fa-save me-2"></i>Update Type
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        function showTableLoading() {
            $('#tableLoadingOverlay').addClass('show');
        }

        function hideTableLoading() {
            $('#tableLoadingOverlay').removeClass('show');
        }

        $(document).ready(function() {
            // Initialize DataTable with enhanced styling
            var table = $('#salonTypesTable').DataTable({
                responsive: true,
                ordering: false,
                pageLength: 10,
                lengthMenu: [[5, 10, 25, 50], [5, 10, 25, 50]],
                processing: true,
                language: {
                    search: "Search salon types:",
                    searchPlaceholder: "Type to search...",
                    lengthMenu: "Show _MENU_ types per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ salon types",
                    infoEmpty: "No salon types to show",
                    infoFiltered: "(filtered from _MAX_ total types)",
                    zeroRecords: "No matching salon types found",
                    emptyTable: `
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="fas fa-tags"></i>
                            </div>
                            <h4>No Salon Types Found</h4>
                            <p>No salon types have been created yet. Click "Add Category" to create one.</p>
                        </div>
                    `,
                    processing: `
                        <div class="d-flex align-items-center justify-content-center p-3">
                            <div class="loading-spinner me-3"></div>
                            <div>
                                <div class="fw-semibold text-primary">Loading salon types...</div>
                                <small class="text-muted">Please wait while we fetch the data</small>
                            </div>
                        </div>
                    `,
                    paginate: {
                        first: '<i class="fas fa-angle-double-left"></i>',
                        last: '<i class="fas fa-angle-double-right"></i>',
                        next: '<i class="fas fa-angle-right"></i>',
                        previous: '<i class="fas fa-angle-left"></i>'
                    }
                },
                drawCallback: function(settings) {
                    // Add fade-in animation to new rows
                    $('#salonTypesTable tbody tr').addClass('fade-in');

                    // Initialize tooltips for action buttons
                    $('[title]').tooltip({
                        placement: 'top',
                        trigger: 'hover'
                    });
                }
            });

            // Handle add salon type form submission
            $("#addSalonTypeForm").submit(function(e) {
                e.preventDefault();

                const $submitBtn = $('#addSalonTypeBtn');
                const originalHtml = $submitBtn.html();

                // Show loading state
                $submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Saving...').prop('disabled', true);

                $.ajax({
                    url: "{{ route('admin.salon.types.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(res) {
                        $submitBtn.html(originalHtml).prop('disabled', false);

                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Salon type added successfully',
                                confirmButtonColor: '#0ba18c',
                                confirmButtonText: 'OK',
                                timer: 3000,
                                showConfirmButton: true
                            }).then(function(result) {
                                $('#addSalonTypeModal').modal('hide');
                                $('#addSalonTypeForm')[0].reset();
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to add salon type',
                                confirmButtonColor: '#dc3545',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr) {
                        $submitBtn.html(originalHtml).prop('disabled', false);

                        let errorText = 'Something went wrong.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
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

            // Handle edit salon type form submission
            $("#editSalonTypeForm").submit(function(e) {
                e.preventDefault();

                const $submitBtn = $('#editSalonTypeBtn');
                const originalHtml = $submitBtn.html();
                const salon_type_id = $("#edit_id").val();
                const myUrl = "{{ route('admin.salon.types.edit', ':id') }}".replace(':id', salon_type_id);

                // Show loading state
                $submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Updating...').prop('disabled', true);

                $.ajax({
                    url: myUrl,
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(res) {
                        $submitBtn.html(originalHtml).prop('disabled', false);

                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Salon type updated successfully',
                                confirmButtonColor: '#0ba18c',
                                confirmButtonText: 'OK',
                                timer: 3000,
                                showConfirmButton: true
                            }).then(function(result) {
                                $('#editSalonTypeModal').modal('hide');
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to update salon type',
                                confirmButtonColor: '#dc3545',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr) {
                        $submitBtn.html(originalHtml).prop('disabled', false);

                        let errorText = 'Something went wrong.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
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

            // Handle edit button click
            $(document).on("click", ".editBtn", function() {
                const id = $(this).data("id");
                const name = $(this).data("name");

                $("#edit_id").val(id);
                $("#edit_name").val(name);
            });

            // Handle delete button click
            $(document).on("click", ".deleteBtn", function() {
                const $button = $(this);
                const id = $button.data("id");
                const myUrl = "{{ route('admin.salon.types.delete', ':id') }}".replace(':id', id);

                Swal.fire({
                    title: 'Delete Salon Type?',
                    text: 'Are you sure you want to delete this salon type? This action cannot be undone.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                }).then(function(result) {
                    if (result.isConfirmed) {
                        // Show loading state on button
                        const originalHtml = $button.html();
                        $button.html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);

                        $.ajax({
                            url: myUrl,
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(res) {
                                $button.html(originalHtml).prop('disabled', false);

                                if (res.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted!',
                                        text: 'Salon type has been deleted successfully.',
                                        confirmButtonColor: '#0ba18c',
                                        confirmButtonText: 'OK',
                                        timer: 3000,
                                        showConfirmButton: true
                                    }).then(function(result) {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Failed to delete salon type',
                                        confirmButtonColor: '#dc3545',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            },
                            error: function(xhr) {
                                $button.html(originalHtml).prop('disabled', false);

                                let errorText = 'Something went wrong.';
                                if (xhr.responseJSON && xhr.responseJSON.message) {
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
                    }
                });
            });

            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();

            // Add smooth scrolling when pagination is clicked
            $('#salonTypesTable').on('page.dt', function() {
                $('html, body').animate({
                    scrollTop: $('.table-container').offset().top - 100
                }, 500);
            });

            // Handle window resize for responsive behavior
            $(window).on('resize', function() {
                table.columns.adjust().responsive.recalc();
            });

            // Reset form when modals are hidden
            $('#addSalonTypeModal').on('hidden.bs.modal', function() {
                $('#addSalonTypeForm')[0].reset();
            });

            $('#editSalonTypeModal').on('hidden.bs.modal', function() {
                $('#editSalonTypeForm')[0].reset();
            });
        });

        // Additional utility functions
        function refreshSalonTypes() {
            showTableLoading();
            $('#salonTypesTable').DataTable().ajax.reload(function() {
                hideTableLoading();
            }, false);
        }

        // Export function (can be called from other parts of the application)
        window.salonTypesManager = {
            refresh: refreshSalonTypes,
            showLoading: showTableLoading,
            hideLoading: hideTableLoading
        };
    </script>
@endsection
