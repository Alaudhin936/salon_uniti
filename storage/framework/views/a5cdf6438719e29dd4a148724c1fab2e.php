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