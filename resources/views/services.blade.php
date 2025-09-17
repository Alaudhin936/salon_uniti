@extends('layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
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
            background: linear-gradient(135deg, #0ba18c 0%, #00ff3c8f 100%) !important;
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
             pointer-events: none;
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
        }

        .custom-table {
            margin: 0;
            border: none;
            width: 100%;
        }

        .custom-table thead th {
            background: linear-gradient(135deg, #0ba18c 0%, #00ff3c8f 100%) !important;
            border: none;
            font-weight: 600;
            color: white;
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
            background: rgba(255, 255, 255, 0.5);
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
            width: 38px;
            height: 38px;
            border-radius: 10px;
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

        .btn-danger-custom {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        }

        /* Status Badge Styling */
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: capitalize;
            letter-spacing: 0.3px;
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

        .price-badge {
            background: linear-gradient(135deg, #0ba18c 0%, #00ff3c8f 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
        }

        /* Service Icon Styling */
        .service-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0ba18c 0%, #00ff3c8f 100%);
            color: white;
            font-size: 1.1rem;
            margin-right: 1rem;
        }

        /* Service Image Styling */
        .service-image {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid #f1f3f4;
            transition: all 0.3s ease;
        }

        .service-image:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Modal Styling */
        .modal-content-custom {
            border-radius: 20px;
            border: none;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .modal-header-custom {
            background: linear-gradient(135deg, #0ba18c 0%, #00ff3c8f 100%);
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

        /* Button Styling */
        .btn-primary-custom {
            background: linear-gradient(135deg, #0ba18c 0%, #00ff3c8f 100%);
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(11, 161, 140, 0.3);
            color: white;
        }

        /* Form Styling */
        .form-control-custom {
            background: #f8f9fa;
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control-custom:focus {
            background: white;
            box-shadow: 0 0 0 3px rgba(11, 161, 140, 0.2);
            border-color: #0ba18c;
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
                                <i class="fas fa-concierge-bell me-1"></i>Services
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>



            <!-- Main Content Card -->
            <div class="row">
                <div class="col-12">
                    <div class="main-card slide-up">
                        <div class="card-header-custom d-flex justify-content-between align-items-center">
                            <div class="card-header-title d-flex align-items-center">
                                  <div class="service-icon">
                                                            <i class="fas fa-scissors"></i>
                                                        </div>
                                <div>
                                    <div>Salon Services</div>
                                    <small style="opacity: 0.8; font-size: 0.9rem;">
                                        Manage your salon services and pricing
                                    </small>
                                </div>
                            </div>
                            <button class="btn btn-light btn-md px-3 py-2 rounded-pill shadow-sm fw-semibold"
                                data-bs-toggle="modal" data-bs-target="#addServiceModal">
                                <i class="fas fa-plus-circle me-2 text-primary"></i> Add Service
                            </button>
                        </div>


                        <div class="card-body p-4">
                            <div class="table-container">
                                <table id="servicesTable" class="table custom-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>
                                                <i class="fas fa-concierge-bell me-2"></i>Service Name
                                            </th>
                                            <th>
                                                <i class="fas fa-tag me-2"></i>Price
                                            </th>
                                            <th>
                                                <i class="fas fa-clock me-2"></i>Duration
                                            </th>
                                            <th>
                                                <i class="fas fa-image me-2"></i>Service Image
                                            </th>
                                            <th>
                                                <i class="fas fa-info-circle me-2"></i>Status
                                            </th>
                                            <th class="text-center">
                                                <i class="fas fa-cogs me-2"></i>Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($services as $index => $service)
                                            <tr class="fade-in">
                                                <td class="fw-bold text-primary">{{ $index + 1 }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">

                                                        <div>
                                                            <div class="fw-semibold">{{ $service->name }}</div>
                                                            <small class="text-muted">Service ID:
                                                                #{{ $service->id }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="price-badge">
                                                        <i class="fas fa-rupee-sign me-1"></i>{{ $service->price }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-clock text-muted me-2"></i>
                                                        <span>{{ $service->duration }} min</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($service->service_img)
                                                        <img src="{{ asset('storage/' . $service->service_img) }}"
                                                            alt="Service Image" class="service-image">
                                                    @else
                                                        <div class="text-muted">
                                                            <i class="fas fa-image me-1"></i>No Image
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span
                                                        class="status-badge {{ $service->is_active ? 'status-active' : 'status-inactive' }}">
                                                        <i
                                                            class="fas {{ $service->is_active ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
                                                        {{ $service->is_active ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <button class="action-btn edit-service"
                                                            data-category_id="{{ $service->service_category_id }}"
                                                            data-id="{{ $service->id }}"
                                                            data-img="{{ $service->service_img }}"
                                                            data-name="{{ $service->name }}"
                                                            data-status="{{ $service->is_active }}"
                                                            data-duration="{{ $service->duration }}"
                                                            data-price="{{ $service->price }}" title="Edit Service">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="action-btn btn-danger-custom delete-service"
                                                            data-id="{{ $service->id }}" title="Delete Service">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-5">
                                                    <div class="empty-state">
                                                        <div class="empty-state-icon">
                                                            <i class="fas fa-concierge-bell"></i>
                                                        </div>
                                                        <h4>No Services Found</h4>
                                                        <p>You haven't added any services yet. Add your first service to get
                                                            started.</p>
                                                        <button class="btn btn-primary-custom mt-3" data-bs-toggle="modal"
                                                            data-bs-target="#addServiceModal">
                                                            <i class="fas fa-plus-circle me-2"></i>Add First Service
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Service Modal -->
    <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content modal-content-custom">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title modal-title-custom" id="addServiceLabel">
                        <div class="modal-title-icon">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        Add New Service
                    </h5>
                    <button type="button" class="btn-close btn-close-custom" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form id="addServiceForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="serviceName" class="form-label fw-semibold">
                                    <i class="fas fa-concierge-bell me-2 text-primary"></i>Service Name
                                </label>
                                <input type="text" class="form-control form-control-custom" id="serviceName"
                                    name="name" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="servicePrice" class="form-label fw-semibold">
                                    <i class="fas fa-tag me-2 text-primary"></i>Price (₹)
                                </label>
                                <input type="number" class="form-control form-control-custom" id="servicePrice"
                                    name="price" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="service_category_id" class="form-label fw-semibold">
                                    <i class="fas fa-list me-2 text-primary"></i>Service Category
                                </label>
                                <select class="form-select form-control-custom" id="service_category_id"
                                    name="service_category_id" required>
                                    <option value="">-- Select Category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="serviceDuration" class="form-label fw-semibold">
                                    <i class="fas fa-clock me-2 text-primary"></i>Duration (minutes)
                                </label>
                                <input type="number" class="form-control form-control-custom" id="serviceDuration"
                                    name="duration" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="addServiceImage" class="form-label fw-semibold">
                                    <i class="fas fa-image me-2 text-primary"></i>Service Image
                                </label>
                                <input type="file" class="form-control form-control-custom" id="addServiceImage"
                                    name="service_img" accept="image/*">
                                <div class="mt-3 text-center">
                                    <img id="previewAddCropped" class="service-image" style="display: none;" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary-custom px-4" id="storeBtn">
                            <i class="fa fa-save me-2"></i>
                            <span class="btn-text">Save Service</span>
                            <span class="spinner-border spinner-border-sm d-none" role="status"
                                aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Service Modal -->
    <div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form id="editServiceForm" method="POST" enctype="multipart/form-data"
                class="modal-content modal-content-custom">
                @csrf
                <input type="hidden" name="service_id" id="editServiceId">

                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title modal-title-custom" id="editServiceModalLabel">
                        <div class="modal-title-icon">
                            <i class="fas fa-edit"></i>
                        </div>
                        Edit Service
                    </h5>
                    <button type="button" class="btn-close btn-close-custom" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="editServiceName" class="form-label fw-semibold">
                                <i class="fas fa-concierge-bell me-2 text-primary"></i>Service Name
                            </label>
                            <input type="text" class="form-control form-control-custom" id="editServiceName"
                                name="name" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="editServicePrice" class="form-label fw-semibold">
                                <i class="fas fa-tag me-2 text-primary"></i>Price (₹)
                            </label>
                            <input type="number" class="form-control form-control-custom" id="editServicePrice"
                                name="price" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="editServiceDuration" class="form-label fw-semibold">
                                <i class="fas fa-clock me-2 text-primary"></i>Duration (mins)
                            </label>
                            <input type="number" class="form-control form-control-custom" id="editServiceDuration"
                                name="duration" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="editServiceCategory" class="form-label fw-semibold">
                                <i class="fas fa-list me-2 text-primary"></i>Service Category
                            </label>
                            <select id="editServiceCategory" name="service_category_id"
                                class="form-select form-control-custom" required>
                                <option value="">-- Select Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="is_active" class="form-label fw-semibold">
                                <i class="fas fa-info-circle me-2 text-primary"></i>Status
                            </label>
                            <select id="is_active" name="is_active" class="form-select form-control-custom">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="editServiceImage" class="form-label fw-semibold">
                                <i class="fas fa-image me-2 text-primary"></i>Service Image
                            </label>
                            <input type="file" class="form-control form-control-custom" id="editServiceImage"
                                name="service_img" accept="image/*">
                            <div class="mt-3 text-center">
                                <img id="previewEditCropped" class="service-image" style="display:none;" />
                                <img id="serviceImagePreview" class="service-image" style="display:none;" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary-custom px-4" id="saveBtn">
                        <i class="fa fa-save me-2"></i>
                        <span class="btn-text">Update Service</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Cropper Modal -->
    <div class="modal fade" id="cropperModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
        data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content modal-content-custom">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title modal-title-custom">
                        <div class="modal-title-icon">
                            <i class="fas fa-crop-alt"></i>
                        </div>
                        Crop Service Image
                    </h5>
                    <button type="button" class="btn-close btn-close-custom" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="cropperImage" style="max-width:100%; max-height:500px;">
                </div>
                <div class="modal-footer">
                    <button type="button" id="cropButton" class="btn btn-primary-custom">
                        <i class="fas fa-crop-alt me-2"></i>Crop & Save
                    </button>
                </div>
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
            let cropper, currentInput, currentPreview;
            const $modal = $('#cropperModal');
            const $cropperImage = $('#cropperImage');
            let bsModal = new bootstrap.Modal(document.getElementById('cropperModal'), {
                backdrop: 'static',
                keyboard: false
            });

            $('#addServiceImage, #editServiceImage').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    currentInput = this;
                    currentPreview = (this.id === "addServiceImage") ? $("#previewAddCropped") : $(
                        "#previewEditCropped");

                    const reader = new FileReader();
                    reader.onload = function() {
                        $cropperImage.attr('src', reader.result);
                        bsModal.show();
                    };
                    reader.readAsDataURL(file);
                }
            });

            $modal.on('shown.bs.modal', function() {
                cropper = new Cropper($cropperImage[0], {
                    aspectRatio: 200 / 200, // fixed ratio
                    viewMode: 1,
                    autoCropArea: 1,
                    responsive: true,
                    background: false,
                    zoomable: true,
                    scalable: true
                });
            }).on('hidden.bs.modal', function() {
                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }
            });

            $('#cropButton').on('click', function() {
                if (!cropper) return;

                const canvas = cropper.getCroppedCanvas({
                    width: 200,
                    height: 200,
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high'
                });

                // Show cropped preview
                currentPreview.attr('src', canvas.toDataURL("image/png", 1.0)).show();

                // Replace input file with cropped version
                canvas.toBlob(function(blob) {
                    const file = new File([blob], "cropped_service.png", {
                        type: "image/png"
                    });
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    currentInput.files = dataTransfer.files;
                }, "image/png", 1.0);

                bsModal.hide();
            });
            $('#servicesTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
                columnDefs: [{
                        orderable: false,
                        targets: [5]
                    } // Disable sorting for actions column
                ]
            });
            $("#addServiceForm").submit(function(e) {
                debugger
                e.preventDefault();
                let btn = $('#storeBtn');
                let formData = new FormData(this);
                // Disable button
                btn.prop('disabled', true);
                btn.find('.btn-text').text('Saving...');

                $.ajax({
                    url: "{{ route('services.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        debugger
                        $("#addServiceModal").modal('hide');

                        if (response.status) {

                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'New Service Created Successfully!',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }
                        $("#addServiceForm")[0].reset();

                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            alert("Validation error: " + Object.values(errors).join(", "));
                        } else {
                            alert("Something went wrong!");
                        }
                    }
                });
            });

            $(document).on('click', '.edit-service', function() {

                let id = $(this).data('id');
                let name = $(this).data('name');
                let price = $(this).data('price');
                let duration = $(this).data('duration');
                let status = $(this).data('status');
                let service_img = $(this).data('img');
                let category_id = $(this).data('category_id');

                $('#editServiceId').val(id);
                $('#editServiceName').val(name);
                $('#editServicePrice').val(price);
                $('#editServiceDuration').val(duration);
                $('#is_active').val(status);
                $('#editServiceCategory').val(category_id);
                $('#serviceImagePreview').attr('src', '{{ asset('storage') }}/' + service_img);

                $('#editServiceModal').modal('show');
            });


            $('#editServiceForm').submit(function(e) {
                e.preventDefault();
                let btn = $('#saveBtn');
                let formData = new FormData(this);
                btn.prop('disabled', true);
                btn.find('.btn-text').text('Saving...');
                let id = $('#editServiceId').val();
                let url_1 = "{{ route('services.update', ':id') }}".replace(':id', id);
                $.ajax({
                    url: url_1,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Service Updated Successfully!',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });

                            $('#editServiceModal').modal('hide');
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something Went Wrong',
                            confirmButtonColor: 'red',
                            confirmButtonText: 'OK'
                        });

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                        } else {

                        }
                    }
                });
            });



            $(document).on('click', '.delete-service', function() {
                let id = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This Service will be deleted permanently!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = "{{ route('services.destroy', ':id') }}".replace(':id', id);

                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.status) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Service Deleted Successfully',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'OK'
                                    }).then(function(result) {
                                        if (result.isConfirmed) {
                                            window.location.reload();
                                        }
                                    });

                                    let toastEl = document.getElementById(
                                        'successToast');
                                    let toast = new bootstrap.Toast(toastEl);
                                    toast.show();
                                }
                            },
                            error: function() {
                                alert('Something went wrong while deleting!');
                            }
                        });
                    }

                })

            });

        });
    </script>
@endsection
