<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
    <div class="container-fluid" style="padding:30px;background-color:white;">
        <div class="page-title">
            <div class="row align-items-center">
                <div >
                    <h3 style="color: #0a566d" class="underlined-heading"> Your Customers</h3>
                </div>
            </div>

            <div class="container mt-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white py-2">

                        <div class="card-header bg-primary text-white fw-bold px-3 py-3">
                            <i class="fas fa-user-friends me-2"></i>
                            Customers
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if($allCustomers->isEmpty()): ?>
                            <div class="alert alert-info mb-0">
                                No customers found yet.
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th class="text-center">Bookings and details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $allCustomers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($index + 1); ?></td>
                                                <td><?php echo e($customer->name); ?></td>
                                                <td><?php echo e($customer->email); ?></td>
                                                <td><?php echo e($customer->phone); ?></td>
                                                <td class="text-center">
                                                    <i class="fa fa-eye text-primary customer-info-btn"
                                                        style="cursor:pointer;" data-customer-id="<?php echo e($customer->id); ?>">
                                                    </i>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal fade" id="customerServicesModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Bookings</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Service Name</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="servicesTableBody"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        :root {
            --light-gray: #f8f9fa;
            --lighter-gray: #ffffff;
            --border-light: #e9ecef;
            --text-muted: #6c757d;
            --text-dark: #343a40;
            --light-blue: #e3f2fd;
            --success-light: #d4edda;
            --success-text: #155724;
            --info-light: #d1ecf1;
            --info-text: #0c5460;
            --warning-light: #fff3cd;
            --warning-text: #856404;
            --danger-light: #f8d7da;
            --danger-text: #721c24;
        }

        body {
            background-color: var(--light-gray);
        }

        /* Profile Greeting Card */
        .profile-greeting {
            background: linear-gradient(135deg, var(--lighter-gray) 0%, var(--light-gray) 100%);
            border: 1px solid var(--border-light);
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .greeting-user h4 {
            color: var(--text-dark);
            font-weight: 600;
        }

        .greeting-user h4 a {
            color: var(--text-dark);
            text-decoration: none;
        }

        .greeting-user h4 span {
            color: var(--text-muted);
        }

        /* Dots styling */
        .bg-info {
            background-color: var(--light-blue) !important;
        }

        .bg-primary {
            background-color: var(--info-light) !important;
        }

        /* Cards */
        .card {
            background: var(--lighter-gray);
            border: 1px solid var(--border-light);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        /* Revenue Card */
        .card.shadow.border-0.rounded-lg {
            background: var(--success-light) !important;
            border: 1px solid #c3e6cb !important;
        }

        .card.shadow.border-0.rounded-lg h6 {
            color: var(--success-text) !important;
        }

        .card.shadow.border-0.rounded-lg h3 {
            color: var(--success-text) !important;
        }

        /* Text colors */
        .text-primary {
            color: var(--info-text) !important;
        }

        .fw-bold.text-primary {
            color: var(--info-text) !important;
        }

        .fw-bold.text-success {
            color: var(--success-text) !important;
        }

        .text-muted {
            color: var(--text-muted) !important;
        }

        /* Card headers - replace bg-primary */
        .card-header.bg-primary {
            background: var(--light-gray) !important;
            color: var(--text-dark) !important;
            border-bottom: 2px solid var(--border-light);
        }

        /* Badges */
        .badge.bg-info {
            background: var(--info-light) !important;
            color: var(--info-text) !important;
        }

        .badge.bg-success {
            background: var(--success-light) !important;
            color: var(--success-text) !important;
        }

        .badge.bg-danger {
            background: var(--danger-light) !important;
            color: var(--danger-text) !important;
        }

        .badge.bg-secondary {
            background: var(--warning-light) !important;
            color: var(--warning-text) !important;
        }

        .badge.bg-light {
            background: var(--light-gray) !important;
            color: var(--text-dark) !important;
            border: 1px solid var(--border-light) !important;
        }

        /* Table styling */
        .table {
            background: var(--lighter-gray);
        }

        .table thead th {
            background: var(--light-gray) !important;
            color: var(--text-dark);
            border-bottom: 2px solid var(--border-light);
        }

        .table tbody tr {
            border-bottom: 1px solid var(--border-light);
        }

        .table tbody tr:hover {
            background: var(--light-gray);
        }

        .table-light {
            background: var(--light-gray) !important;
        }

        /* List group */
        .list-group-item {
            background: var(--lighter-gray);
            border-color: var(--border-light);
        }

        .list-group-item:hover {
            background: var(--light-gray);
        }

        /* Icons */
        .text-secondary {
            color: var(--text-muted) !important;
        }

        .fas.fa-user-circle {
            color: var(--text-muted);
        }

        /* Empty state */
        .text-center.py-5 i {
            color: var(--text-muted);
        }

        /* Breadcrumb */
        .breadcrumb {
            background: var(--lighter-gray);
            padding: 0px border: 1px solid var(--border-light);
        }

        .breadcrumb-item a {
            color: var(--info-text);
        }

        /* Chart container */
        .earning-chart {
            background: var(--lighter-gray);
            border: 1px solid var(--border-light);
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        /* Custom professional styling */
        .fw-semibold.text-primary {
            color: var(--text-dark) !important;
            font-weight: 500;
        }

        .right-circle i {
            color: var(--success-text);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .profile-vector {
                display: none;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.customer-info-btn', function() {
                let customerId = $(this).data('customer-id');

                $('#customerInfoContent').html('Loading...');
                $('#customerInfoModal').modal('show');

                $.ajax({
                    url: "<?php echo e(route('vendor.customer.services')); ?>",
                    method: "POST",
                    data: {
                        customer_id: customerId,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(response) {
                        if (response.status === 200) {
                            let rows = '';
                            response.data.forEach(service => {
                                rows += `
                        <tr>
                            <td>${service.name}</td>
                            <td>${service.date}</td>
                            <td>${service.status}</td>
                        </tr>
                    `;
                            });
                            $('#servicesTableBody').html(rows);
                            $('#customerServicesModal').modal('show');
                        }
                    },
                    error: function() {
                        $('#customerInfoContent').html(
                            '<div class="text-danger">Error loading data</div>');
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp8.2\htdocs\salon_unitiii\resources\views/customers.blade.php ENDPATH**/ ?>