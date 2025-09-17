@extends('layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0ba18c;
            --primary-light: #00ff3c8f;
            --primary-gradient: linear-gradient(135deg, #0ba18c 0%, #00ff3c8f 100%);
            --secondary-color: #6c757d;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --light-bg: #f8fafc;
            --white: #ffffff;
            --shadow-light: 0 2px 10px rgba(11, 161, 140, 0.1);
            --shadow-medium: 0 4px 20px rgba(11, 161, 140, 0.15);
            --shadow-heavy: 0 10px 40px rgba(11, 161, 140, 0.2);
            --border-radius: 12px;
            --border-radius-lg: 20px;
        }

        /* Base Page Styling */
        .page-container {
            background: linear-gradient(135deg, #f8fafc 0%, #e8f5f3 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }

        .main-card {
            background: var(--white);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-medium);
            border: 1px solid rgba(11, 161, 140, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .main-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-heavy);
        }

        /* Header Styling */
        .card-header-custom {
            background: var(--primary-gradient);
            color: white;
            padding: 2rem;
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: none;
        }

        .card-header-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.03)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.03)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .card-header-title {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
        }

        .title-icon {
            background: rgba(255, 255, 255, 0.2);
            padding: 1rem;
            border-radius: var(--border-radius);
            margin-right: 1.5rem;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
        }

        .title-content h5 {
            margin: 0;
            font-weight: 600;
            font-size: 1.5rem;
            letter-spacing: 0.5px;
        }

        .title-content small {
            opacity: 0.9;
            font-size: 1rem;
            display: block;
            margin-top: 0.25rem;
        }

        /* Add Button Styling */
        .btn-add-schedule {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            position: relative;
            z-index: 2;
        }

        .btn-add-schedule:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.2);
        }

        /* Breadcrumb Styling */
        .breadcrumb-custom {
            background: none;

    padding: 10px;
            margin: 0;
        }

        .breadcrumb-custom .breadcrumb-item {
            font-size: 1rem;
        }

        .breadcrumb-custom .breadcrumb-item a {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .breadcrumb-custom .breadcrumb-item a:hover {
            color: var(--primary-color);
        }

        .breadcrumb-custom .breadcrumb-item.active {
            color: var(--primary-color);
            font-weight: 600;
        }

        /* Page Title */
        .page-title-main {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 2.5rem;
            margin: 0;
            position: relative;
            display: inline-block;
        }

        .page-title-main::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 80px;
            height: 4px;
            background: var(--primary-gradient);
            border-radius: 2px;
        }

        /* Table Container */
        .table-container {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow-light);
            margin: 0;
        }

        /* Table Styling */
        .custom-table {
            margin: 0;
            border: none;
            width: 100%;
            font-size: 1rem;
        }

        .custom-table thead th {
            background: linear-gradient(135deg, #0ba18c 0%, #00ff3c8f 100%);
            border: none;
            font-weight: 600;
            color: white;
            padding: 1.5rem 1.25rem;
            font-size: 1rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            position: relative;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .custom-table thead th i {
            margin-right: 0.5rem;
            opacity: 0.9;
        }

        .custom-table tbody td {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid #f1f3f4;
            vertical-align: middle;
            font-size: 1rem;
            color: #495057;
            transition: all 0.3s ease;
        }

        .custom-table tbody tr {
            transition: all 0.3s ease;
        }

        .custom-table tbody tr:hover {
            background: linear-gradient(135deg, #f8fafc 0%, #e8f5f3 100%);
            transform: translateY(-1px);
            box-shadow: var(--shadow-light);
        }

        .custom-table tbody tr:hover td {
            color: var(--primary-color);
        }

        /* Day Column Styling */
        .day-info {
            display: flex;
            align-items: center;
        }

        .day-icon {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            border-radius: 50%;
            padding: 1rem;
            margin-right: 1rem;
            color: white;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            box-shadow: var(--shadow-light);
        }

        .day-name {
            font-weight: 600;
            font-size: 1.1rem;
            color: #2c3e50;
        }

        /* Editable Time Styling */
        .editable-time {
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 0.75rem;
            border-radius: 8px;
        }

        .editable-time:hover {
            background: rgba(11, 161, 140, 0.05);
        }

        .time-display {
            font-weight: 600;
            color: #2c3e50;
            font-size: 1.1rem;
        }

        .edit-time-btn {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0;
            transition: all 0.3s ease;
            background: var(--primary-color);
            border: none;
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            font-size: 0.8rem;
        }

        .editable-time:hover .edit-time-btn {
            opacity: 1;
        }

        .edit-time-btn:hover {
            background: #0a8a73;
            transform: translateY(-50%) scale(1.05);
        }

        /* Status Toggle Styling */
        .status-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 32px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            transition: .4s;
            border-radius: 32px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 24px;
            width: 24px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        input:checked + .slider {
            background: var(--primary-gradient);
        }

        input:checked + .slider:before {
            transform: translateX(28px);
        }

        /* Status Badge */
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: capitalize;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
        }

        .status-open {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            border: 1px solid #b8dacc;
        }

        .status-closed {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
            border: 1px solid #f1b0b7;
        }

        /* Modal Styling */
        .modal-content-custom {
            border-radius: var(--border-radius-lg);
            border: none;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .modal-header-custom {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 2rem;
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
            font-size: 1.5rem;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .modal-title-icon {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.75rem;
            border-radius: var(--border-radius);
            margin-right: 1rem;
            font-size: 1.2rem;
        }

        .btn-close-custom {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: var(--border-radius);
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            opacity: 1;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }

        .btn-close-custom:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        /* Form Styling */
        .form-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.75rem;
            font-size: 1rem;
        }

        .form-control {
            padding: 1rem;
            border: 2px solid #e9ecef;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(11, 161, 140, 0.25);
            background: white;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Button Styling */
        .btn-primary-custom {
            background: var(--primary-gradient);
            border: none;
            border-radius: var(--border-radius);
            padding: 1rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(11, 161, 140, 0.3);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--secondary-color);
        }

        .empty-state-icon {
            font-size: 5rem;
            color: #dee2e6;
            margin-bottom: 1.5rem;
        }

        .empty-state h4 {
            color: #495057;
            margin-bottom: 1rem;
            font-weight: 600;
            font-size: 1.5rem;
        }

        .empty-state p {
            margin: 0 0 2rem 0;
            font-size: 1.1rem;
            line-height: 1.6;
        }

        /* Edit Controls */
        .edit-controls {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .edit-controls .form-control {
            width: 120px;
            padding: 0.5rem;
            font-size: 0.9rem;
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 6px;
        }

        /* Notification Styling */
        .notification-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            max-width: 400px;
            padding: 1rem 1.25rem;
            border-radius: var(--border-radius);
            color: white;
            font-weight: 500;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }

        .notification-toast.show {
            transform: translateX(0);
        }

        .notification-toast.success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        }

        .notification-toast.error {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        }

        .notification-close {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: white;
            opacity: 0.8;
            cursor: pointer;
            font-size: 1.2rem;
            padding: 0;
            width: 20px;
            height: 20px;
        }

        .notification-close:hover {
            opacity: 1;
        }

        /* Loading States */
        .table-loading {
            position: relative;
            pointer-events: none;
        }

        .table-loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .spinner {
            width: 2rem;
            height: 2rem;
            border: 3px solid rgba(11, 161, 140, 0.3);
            border-top-color: var(--primary-color);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .page-container {
                padding: 1rem 0;
            }

            .main-card {
                margin: 0 0.5rem;
                border-radius: 15px;
            }

            .card-header-custom {
                padding: 1.5rem;
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .page-title-main {
                font-size: 2rem;
            }

            .custom-table thead th,
            .custom-table tbody td {
                padding: 1rem 0.75rem;
                font-size: 0.9rem;
            }

            .day-icon {
                width: 40px;
                height: 40px;
                padding: 0.75rem;
            }

            .modal-dialog {
                margin: 1rem;
            }

            .title-icon {
                width: 50px;
                height: 50px;
                margin-right: 1rem;
                font-size: 1.2rem;
            }

            .title-content h5 {
                font-size: 1.25rem;
            }

            .status-container {
                flex-direction: row;
                gap: 0.5rem;
            }

            .edit-controls {
                flex-direction: column;
                gap: 0.25rem;
            }

            .edit-controls .form-control {
                width: 100%;
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

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }

        /* DataTables Overrides */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            color: #495057;
            margin-bottom: 1rem;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            margin-left: 0.5rem;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 6px;
            margin: 0 2px;
            padding: 0.5rem 1rem;
            border: 1px solid #dee2e6;
            background: white;
            color: #495057;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            color: white !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--primary-gradient) !important;
            border-color: var(--primary-color) !important;
            color: white !important;
        }

        .dataTables_wrapper .dataTables_length select {
            border: 2px solid #e9ecef;
            border-radius: 6px;
            padding: 0.375rem 0.75rem;
            margin: 0 0.5rem;
        }

        .dataTables_wrapper .dataTables_length select:focus {
            border-color: var(--primary-color);
            outline: none;
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
                                <a href="#"><i class="fas fa-home me-2"></i>Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <i class="fas fa-clock me-2"></i>Time Slots
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
                                <div class="title-content">
                                    <h5>Schedule Management</h5>
                                    <small>Manage your salon's operating hours</small>
                                </div>
                            </div>
                            <button class="btn btn-add-schedule" data-bs-toggle="modal"
                                data-bs-target="#addScheduleModal">
                                <i class="fas fa-plus-circle me-2"></i>Add Schedule
                            </button>
                        </div>

                        <div class="card-body p-4">
                            @if ($weeklySchedules->isEmpty())
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-calendar-plus"></i>
                                    </div>
                                    <h4>No Schedule Configured</h4>
                                    <p>You haven't set up your weekly schedule yet. Add your operating hours to get started.</p>
                                    <button class="btn btn-primary-custom" data-bs-toggle="modal"
                                        data-bs-target="#addScheduleModal">
                                        <i class="fas fa-plus-circle me-2"></i>Create Schedule
                                    </button>
                                </div>
                            @else
                                <div class="table-container">
                                    <table class="table custom-table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <i class="fas fa-calendar-day"></i>Day
                                                </th>
                                                <th>
                                                    <i class="fas fa-door-open"></i>Open Time
                                                </th>
                                                <th>
                                                    <i class="fas fa-door-closed"></i>Close Time
                                                </th>
                                                <th class="text-center">
                                                    <i class="fas fa-toggle-on"></i>Status
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($weeklySchedules as $schedule)
                                                <tr class="fade-in">
                                                    <td>
                                                        <div class="day-info">
                                                            <div class="day-icon">
                                                                <i class="fas fa-calendar-day"></i>
                                                            </div>
                                                            <div class="day-name">{{ $daysOfWeek[$schedule->day_of_week] }}</div>
                                                        </div>
                                                    </td>
                                                    <td class="editable-time" data-field="open_time"
                                                        data-schedule-id="{{ $schedule->id }}">
                                                        <span class="time-display">{{ $schedule->open_time }}</span>
                                                        <button class="btn edit-time-btn">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </td>
                                                    <td class="editable-time" data-field="close_time"
                                                        data-schedule-id="{{ $schedule->id }}">
                                                        <span class="time-display">{{ $schedule->close_time }}</span>
                                                        <button class="btn edit-time-btn">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="status-container">
                                                            <label class="switch">
                                                                <input type="checkbox" class="schedule-status-toggle"
                                                                    data-schedule-id="{{ $schedule->id }}"
                                                                    {{ $schedule->is_closed ? '' : 'checked' }}>
                                                                <span class="slider"></span>
                                                            </label>
                                                            <span class="status-badge {{ $schedule->is_closed ? 'status-closed' : 'status-open' }}">
                                                                <i class="fas {{ $schedule->is_closed ? 'fa-times-circle' : 'fa-check-circle' }} me-1"></i>
                                                                {{ $schedule->is_closed ? 'Closed' : 'Open' }}
                                                            </span>
                                                        </div>
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
    {{-- Add Schedule Modal --}}
    <div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="scheduleForm" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addScheduleModalLabel">Add Weekly Schedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Day</label>
                        <select name="day_of_week" class="form-select" required>
                            @foreach ($daysOfWeek as $key => $day)
                                <option value="{{ $key }}">{{ $day }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Open Time</label>
                        <input type="time" name="open_time" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Close Time</label>
                        <input type="time" name="close_time" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Closed?</label>
                        <input type="checkbox" name="is_closed" value="1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Schedule</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Add Exception Modal --}}
    <div class="modal fade" id="addExceptionModal" tabindex="-1" aria-labelledby="addExceptionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="exceptionForm" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addExceptionModalLabel">Add Exception</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Open Time</label>
                        <input type="time" name="open_time" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Close Time</label>
                        <input type="time" name="close_time" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Closed?</label>
                        <input type="checkbox" name="is_closed" value="1">
                    </div>
                    <div class="mb-2">
                        <label>Note</label>
                        <textarea name="note" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Exception</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="editBreakModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editBreakForm" class="modal-content">
                @csrf

                <input type="hidden" name="break_id">
                <input type="hidden" name="schedule_id">
                <input type="hidden" name="type">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Break</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-2">
                        <label>Start Time</label>
                        <input type="time" name="start_time" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>End Time</label>
                        <input type="time" name="end_time" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Break</button>
                </div>
            </form>
        </div>
    </div>


@endsection

@section('scripts')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        $(function() {
            $('.table').DataTable();




            $(document).on('click', '.save-time-btn', function() {
                let $td = $(this).closest('.editable-time');
                let newTime = $td.find('.new-time-input').val();
                let field = $td.data('field');
                let scheduleId = $td.data('schedule-id');

                let myUrl = "{{ route('vendor.schedule.updateTime', ':id') }}".replace(':id', scheduleId);

                $.ajax({
                    url: myUrl,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        field: field,
                        value: newTime
                    },
                    success: function(response) {
                        if (response.status === 200) {
                            $td.html(`
                    <span class="time-display">${newTime}</span>
                    <button class="btn btn-xs text-dark btn-outline-success edit-time-btn">Edit</button>
                `);
                        } else {
                            alert('Failed to update time!');
                            restoreOriginalCell($td);
                        }
                    },
                    error: function() {
                        alert('Error updating time!');
                        restoreOriginalCell($td);
                    }
                });
            });



            $(document).on('click', '.edit-time-btn', function(e) {
                e.preventDefault();

                let $td = $(this).closest('.editable-time');
                let currentTime = $td.find('.time-display').text().trim();
                let field = $td.data('field'); // open_time | close_time
                let scheduleId = $td.data('schedule-id');

                // Replace display with input + save button
                $td.data('original-html', $td.html()); // store original in case of cancel
                $td.html(`
        <div class="d-flex align-items-center gap-1">
            <input type="time" class="form-control form-control-sm new-time-input" value="${currentTime}">
            <button class="btn btn-sm btn-success text-center save-time-btn">Save</button>
            <button class="btn btn-sm text-dark btn-light cancel-time-btn">Cancel</button>
        </div>
    `);

                $td.find('input').focus();
            });

            $(document).on('click', '.cancel-time-btn', function() {
                let $td = $(this).closest('.editable-time');
                restoreOriginalCell($td);
            });

            $(document).on('change', '.schedule-status-toggle', function() {
                let $toggle = $(this);
                let scheduleId = $toggle.data('schedule-id');
                let isClosed = !$toggle.is(':checked');
                let $statusBadge = $toggle.closest('td').find('.status-badge');
                let myUrl = "{{ route('vendor.schedule.status', ':id') }}".replace(':id', scheduleId)

                $.ajax({
                    url: myUrl,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        is_closed: isClosed ? 1 : 0
                    },
                    success: function(response) {
                        if (response.status === 200) {
                            if (isClosed) {
                                $statusBadge
                                    .removeClass('bg-success text-success bg-opacity-25')
                                    .addClass('bg-danger text-danger bg-opacity-25')
                                    .text('Closed');
                            } else {
                                $statusBadge
                                    .removeClass('bg-danger text-danger bg-opacity-25')
                                    .addClass('bg-success text-success bg-opacity-25')
                                    .text('Opened');
                            }
                        } else {
                            alert('Failed to update status!');
                            $toggle.prop('checked', !isClosed);
                        }
                    },
                    error: function() {
                        alert('Error updating status!');
                        $toggle.prop('checked', !isClosed);
                    }
                });
            });


            function restoreOriginalCell($td) {
                $td.html($td.data('original-html'));
            }

            $(document).on('click', '.edit-break-btn', function() {
                let modal = $('#editBreakModal');

                modal.find('input[name="break_id"]').val($(this).data('break-id'));
                modal.find('input[name="schedule_id"]').val($(this).data('schedule-id'));
                modal.find('input[name="type"]').val($(this).data('type'));

                modal.find('input[name="start_time"]').val($(this).data('start'));
                modal.find('input[name="end_time"]').val($(this).data('end'));

                modal.find('input[name="start_time"]').attr('min', $(this).data('open'));
                modal.find('input[name="end_time"]').attr('max', $(this).data('close'));

                modal.modal('show');
            });
            $('#editBreakForm').on('submit', function(e) {
                e.preventDefault();

                let breakId = $(this).find('input[name="break_id"]').val();
                let myUrl = "{{ route('vendor.break.update', ':id') }}".replace(':id', breakId)

                $.ajax({
                    url: myUrl,
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(res) {
                        $('#editBreakModal').modal('hide');
                        if (res.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Break Added',
                                text: 'Break saved successfully.',
                            }).then(() => window.location.reload());
                        }
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON?.message || 'Something went wrong');
                    }
                });
            });


            $(document).on('click', '.add-break-btn', function() {
                let scheduleId = $(this).data('schedule-id');
                let type = $(this).data('type');
                let openTime = $(this).data('open');
                let closeTime = $(this).data('close');

                $('#breakForm [name="schedule_id"]').val(scheduleId);
                $('#breakForm [name="type"]').val(type);

                $('#breakForm [name="start_time"]').attr('min', openTime).attr('max', closeTime);
                $('#breakForm [name="end_time"]').attr('min', openTime).attr('max', closeTime);

                $('#breakForm')[0].reset();

                $('#addBreakModal').modal('show');
            });

            $('#breakForm [name="start_time"]').on('change', function() {
                let start = $(this).val();
                $('#breakForm [name="end_time"]').attr('min', start);
            });


            $('#breakForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('vendor.breaks.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Break Added',
                                text: 'Break saved successfully.',
                            }).then(() => window.location.reload());
                        }
                    },
                    error: function(xhr) {
                        alert("Error: " + xhr.responseText);
                    }
                });
            });


            $('#scheduleForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('vendor.schedule.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Schedule Added Successfully',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then(function(result) {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        alert("Something went wrong: " + xhr.responseText);
                    }
                });
            });

            $('#exceptionForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('vendor.exception.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status == 200) {
                            if (response.status == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Exception Added Successfully',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                }).then(function(result) {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    }
                                });
                            }
                        }
                    },
                    error: function(xhr) {
                        alert("Something went wrong: " + xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
