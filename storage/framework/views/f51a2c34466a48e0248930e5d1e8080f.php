<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
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
                        <div class="card-header bg-primary text-white">
                            <h4 class="card-title mb-0">
                                <i class="fas fa-cut me-2"></i>Salon Directory
                            </h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col" class="text-center" style="width: 5%;">#</th>
                                            <th scope="col" style="width: 20%;">
                                                <i class="fas fa-store me-1"></i>Business Name
                                            </th>
                                            <th scope="col" style="width: 15%;">
                                                <i class="fas fa-quote-left me-1"></i>Slogan
                                            </th>
                                            <th scope="col" class="text-center" style="width: 10%;">
                                                <i class="fas fa-tags me-1"></i>Type
                                            </th>
                                            <th scope="col" style="width: 15%;">
                                                <i class="fas fa-map-marker-alt me-1"></i>Location
                                            </th>
                                            <th scope="col" style="width: 15%;">
                                                <i class="fas fa-user me-1"></i>Vendor Name
                                            </th>
                                            <th scope="col" style="width: 10%;">
                                                <i class="fas fa-envelope me-1"></i>Email
                                            </th>
                                            <th scope="col" class="text-center" style="width: 10%;">
                                                <i class="fas fa-phone me-1"></i>Phone
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $salons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $salon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="align-middle">
                                                <td class="text-center fw-bold text-primary">
                                                    <?php echo e($index + 1); ?>

                                                </td>
                                                <td class="fw-semibold">
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2"
                                                            style="width: 32px; height: 32px; font-size: 12px; color: white;">
                                                            <?php echo e(strtoupper(substr($salon->business_name, 0, 1))); ?>

                                                        </div>
                                                        <?php echo e($salon->business_name); ?>

                                                    </div>
                                                </td>
                                                <td class="text-muted fst-italic">
                                                    <?php echo e($salon->slogan); ?>

                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-secondary rounded-pill">
                                                        <?php echo e($salon->type); ?>

                                                    </span>
                                                </td>
                                                <td>
                                                    <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                                    <?php echo e($salon->location); ?>

                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-success rounded-circle d-flex align-items-center justify-content-center me-2"
                                                            style="width: 24px; height: 24px; font-size: 10px; color: white;">
                                                            <?php echo e(strtoupper(substr($salon->name, 0, 1))); ?>

                                                        </div>
                                                        <?php echo e($salon->name); ?>

                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="mailto:<?php echo e($salon->email); ?>"
                                                        class="text-decoration-none text-primary">
                                                        <i class="fas fa-envelope me-1"></i>
                                                        <small><?php echo e($salon->email); ?></small>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="tel:<?php echo e($salon->phone); ?>"
                                                        class="btn btn-outline-success btn-sm">
                                                        <i class="fas fa-phone me-1"></i>
                                                        <?php echo e($salon->phone); ?>

                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-light text-muted">
                            <small>
                                <i class="fas fa-info-circle me-1"></i>
                                Total Salons: <span class="fw-bold"><?php echo e(count($salons)); ?></span>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="registerSalonModal" tabindex="-1" aria-labelledby="registerSalonModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="registerSalonModalLabel">Register New Salon</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form id="registerSalonForm">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="row">
                                <!-- Vendor Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Vendor Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Vendor Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control" required>
                                </div>

                                <!-- Business Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="business_name" class="form-label">Business Name</label>
                                    <input type="text" name="business_name" class="form-control" required>
                                </div>

                                <!-- Slogan -->
                                <div class="col-md-6 mb-3">
                                    <label for="slogan" class="form-label">Slogan</label>
                                    <input type="text" name="slogan" class="form-control">
                                </div>

                                <!-- Type -->
                                <div class="col-md-6 mb-3">
                                    <label for="type" class="form-label">Type</label>
                                    <select name="type" class="form-select" required>
                                        <option value="Men">Men</option>
                                        <option value="Women">Women</option>
                                        <option value="Unisex">Unisex</option>
                                    </select>
                                </div>

                                <!-- Location -->
                                <div class="col-md-12 mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" name="location" class="form-control" required>
                                </div>

                                <!-- GST -->
                                <div class="col-md-6 mb-3">
                                    <label for="gst_number" class="form-label">GST Number (optional)</label>
                                    <input type="text" name="gst_number" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="gst_number" class="form-label">Write New Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>

                                <!-- Latitude -->
                                <div class="col-md-3 mb-3">
                                    <label for="lattitude" class="form-label">Latitude (Optional)</label>
                                    <input type="text" name="lattitude" class="form-control">
                                </div>

                                <!-- Longitude -->
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

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/counter/jquery.waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/counter/jquery.counterup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/counter/counter-custom.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/support-ticket-custom.js')); ?>"></script>

    <script>
        $(document).ready(function() {
            $('#registerSalonForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: "<?php echo e(route('salons.store')); ?>", // You will define this route
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status === 'success') {
                            window.location.reload();
                        } else {
                            alert('Error saving salon.');
                        }
                    },
                    error: function(xhr) {
                        alert('Something went wrong.');
                    }
                });
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp8.2\htdocs\salon_unitiii\resources\views/salons.blade.php ENDPATH**/ ?>