@extends('layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
            box-shadow: 0 8px 25px rgba(10, 86, 109, 0.3);
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
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            color: #0a566d;
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
                                <i class="fas fa-layer-group me-1"></i>Service Categories
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
                                        <i class="fas fa-layer-group"></i>
                                    </div>
                                    <div>
                                        <div>Service Categories Management</div>
                                        <small style="opacity: 0.8; font-size: 0.9rem;">
                                            Organize services into categories
                                        </small>
                                    </div>
                                </div>
                                <button class="btn add-btn" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                                    <i class="fas fa-plus-circle me-2"></i>Add Category
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <!-- Service Categories Table -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-container">
                                        <!-- Loading Overlay -->
                                        <div class="table-loading-overlay" id="tableLoadingOverlay">
                                            <div class="loading-content">
                                                <div class="loading-spinner"></div>
                                                <div class="fw-semibold">Loading categories...</div>
                                                <small class="text-muted">Please wait while we fetch the data</small>
                                            </div>
                                        </div>

                                        <table id="categoriesTable" class="table custom-table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        <i class="fas fa-hashtag me-2"></i>ID
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-layer-group me-2"></i>Name
                                                    </th>
                                                    <th class="text-center">
                                                        <i class="fas fa-cogs me-2"></i>Actions
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($categories as $category)
                                                    <tr class="fade-in">
                                                        <td class="text-center">
                                                            <span class="id-badge">{{ $category->id }}</span>
                                                        </td>
                                                        <td>
                                                            <div class="name-content">
                                                                <div class="name-icon">
                                                                    <i class="fas fa-folder"></i>
                                                                </div>
                                                                <div>
                                                                    <div class="fw-semibold">{{ $category->name }}</div>
                                                                    <small class="text-muted">Service Category</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <button class="action-btn btn-warning editBtn me-2"
                                                                    data-id="{{ $category->id }}"
                                                                    data-name="{{ $category->name }}"
                                                                    title="Edit Category">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button class="action-btn btn-danger deleteBtn"
                                                                    data-id="{{ $category->id }}"
                                                                    title="Delete Category">
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

    <!-- Add Service Category Modal -->
    <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-custom">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title modal-title-custom" id="addServiceModalLabel">
                        <div class="modal-title-icon">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        Add Service Category
                    </h5>
                    <button type="button" class="btn-close btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times text-white"></i>
                    </button>
                </div>
                <form id="addServiceCategoryForm">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label for="categoryName" class="form-label form-label-custom">
                                <i class="fas fa-layer-group me-2"></i>Category Name
                            </label>
                            <input type="text" class="form-control form-control-custom" id="categoryName" name="name"
                                   placeholder="Enter category name (e.g., Hair Care, Nail Care)" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4">
                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Cancel
                        </button>
                        <button type="submit" class="btn add-btn rounded-pill px-4" id="addCategoryBtn">
                            <i class="fas fa-save me-2"></i>Save Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Service Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-custom">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title modal-title-custom" id="editCategoryLabel">
                        <div class="modal-title-icon">
                            <i class="fas fa-edit"></i>
                        </div>
                        Edit Service Category
                    </h5>
                    <button type="button" class="btn-close btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times text-white"></i>
                    </button>
                </div>
                <form id="editCategoryForm" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <input type="hidden" id="editCategoryId" name="id">
                        <div class="mb-3">
                            <label for="editCategoryName" class="form-label form-label-custom">
                                <i class="fas fa-layer-group me-2"></i>Category Name
                            </label>
                            <input type="text" class="form-control form-control-custom" id="editCategoryName" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4">
                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Cancel
                        </button>
                        <button type="submit" class="btn add-btn rounded-pill px-4" id="editCategoryBtn">
                            <i class="fas fa-save me-2"></i>Update Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function showTableLoading() {
            $('#tableLoadingOverlay').addClass('show');
        }

        function hideTableLoading() {
            $('#tableLoadingOverlay').removeClass('show');
        }

        $(document).ready(function() {
            // Initialize DataTable with enhanced styling
            var table = $('#categoriesTable').DataTable({
                responsive: true,
                ordering: false,
                pageLength: 10,
                lengthMenu: [[5, 10, 25, 50], [5, 10, 25, 50]],
                processing: true,
                language: {
                    search: "Search categories:",
                    searchPlaceholder: "Type to search...",
                    lengthMenu: "Show _MENU_ categories per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ categories",
                    infoEmpty: "No categories to show",
                    infoFiltered: "(filtered from _MAX_ total categories)",
                    zeroRecords: "No matching categories found",
                    emptyTable: `
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="fas fa-layer-group"></i>
                            </div>
                            <h4>No Service Categories Found</h4>
                            <p>No service categories have been created yet. Click "Add Category" to create one.</p>
                        </div>
                    `,
                    processing: `
                        <div class="d-flex align-items-center justify-content-center p-3">
                            <div class="loading-spinner me-3"></div>
                            <div>
                                <div class="fw-semibold text-primary">Loading categories...</div>
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
                    $('#categoriesTable tbody tr').addClass('fade-in');

                    // Initialize tooltips for action buttons
                    $('[title]').tooltip({
                        placement: 'top',
                        trigger: 'hover'
                    });
                }
            });

            // Handle edit button click
            $(document).on('click', '.editBtn', function() {
                let id = $(this).data('id');
                let name = $(this).data('name');

                $('#editCategoryId').val(id);
                $('#editCategoryName').val(name);

                $('#editCategoryModal').modal('show');
            });
            $('#addServiceCategoryForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('services.categories.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#addServiceModal').modal('hide');
                        Swal.fire('Success!', response.message, 'success')
                            .then(() => location.reload());
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', 'Could not add category.', 'error');
                    }
                });
            });

            $('#editCategoryForm').on('submit', function(e) {
                e.preventDefault();

                let id = $('#editCategoryId').val();
                let name = $('#editCategoryName').val();
                let url_1 = "{{ route('services.categories.update', ':id') }}".replace(':id',
                    id);

                $.ajax({
                    url: url_1,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: name
                    },
                    success: function(response) {
                        $('#editCategoryModal').modal('hide');
                        Swal.fire('Updated!', 'Category updated successfully.',
                                'success')
                            .then(() => location.reload());
                    },
                    error: function() {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    }
                });
            });

            // Delete Category

            $('.deleteBtn').on('click', function() {
                let id = $(this).data('id');
                let url_1 = "{{ route('services.categories.destroy', ':id') }}".replace(':id',
                    id);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This category will be deleted permanently!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url_1,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function() {
                                Swal.fire('Deleted!',
                                        'Category has been deleted.',
                                        'success')
                                    .then(() => location.reload());
                            },
                            error: function() {
                                Swal.fire('Error!', 'Something went wrong.',
                                    'error');
                            }
                        });
                    }
                });
            });

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "{{ session('success') }}",
                    timer: 2000,
                    showConfirmButton: false
                });
            @endif
        });
    </script>
@endsection
