<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Your Services</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Apps</li>
                        <li class="breadcrumb-item active">Services</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="col-12">
            <div class="card ecommerce-widget pro-gress h-100 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="fa fa-cut me-2"></i>Services Management
                        </h5>
                        <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                            <i class="fa fa-plus me-2"></i>Add Service
                        </button>
                    </div>
                </div>

                <div class="card-body support-ticket-font p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 5%;">#</th>
                                    <th scope="col" style="width: 30%;">Service Name</th>
                                    <th scope="col" style="width: 15%;">Price</th>
                                    <th scope="col" style="width: 15%;">Duration</th>
                                    <th scope="col" style="width: 15%;">Status</th>
                                    <th scope="col" style="width: 20%;" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="align-middle">
                                        <td class="fw-bold text-primary"><?php echo e($index + 1); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                                                    style="width: 35px; height: 35px;">
                                                    <i class="fa fa-scissors text-white small"></i>
                                                </div>
                                                <strong class="text-dark"><?php echo e($service->name); ?></strong>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">
                                                <i class="fa fa-rupee-sign me-1"></i><?php echo e($service->price); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                <i class="fa fa-clock me-1"></i><?php echo e($service->duration); ?> min
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">Active</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-outline-warning edit-service"
                                                    data-id="<?php echo e($service->id); ?>" data-name="<?php echo e($service->name); ?>"
                                                    data-duration="<?php echo e($service->duration); ?>"
                                                    data-price="<?php echo e($service->price); ?>">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-outline-danger delete-service"
                                                    data-id="<?php echo e($service->id); ?>">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fa fa-cut mb-3 display-4 opacity-25"></i>
                                                <h6 class="text-muted">No services available</h6>
                                                <p class="small mb-3">Add your first service to get started</p>
                                                <button class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#addServiceModal">
                                                    <i class="fa fa-plus me-2"></i>Add Service
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php if(count($services) > 0): ?>
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">Total: <strong><?php echo e(count($services)); ?></strong> services</small>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                                <i class="fa fa-plus me-2"></i>Add Another Service
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addServiceLabel">Add New Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addServiceForm" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="serviceName" class="form-label">Service Name</label>
                            <input type="text" class="form-control" id="serviceName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="servicePrice" class="form-label">Price</label>
                            <input type="number" class="form-control" id="servicePrice" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="serviceDuration" class="form-label">Duration (minutes)</label>
                            <input type="number" class="form-control" id="serviceDuration" name="duration" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Service Modal -->
    <div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="editServiceForm" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="service_id" id="editServiceId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editServiceModalLabel">Edit Service</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editServiceName" class="form-label">Service Name</label>
                            <input type="text" class="form-control" id="editServiceName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editServicePrice" class="form-label">Price</label>
                            <input type="number" class="form-control" id="editServicePrice" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="editServiceDuration" class="form-label">Duration (mins)</label>
                            <input type="number" class="form-control" id="editServiceDuration" name="duration"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Service</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Toast container -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
        <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Service added successfully!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
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

            $("#addServiceForm").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: "<?php echo e(route('services.store')); ?>",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $("#addServiceModal").modal('hide');

                        if (response.status) {
                            let toastEl = document.getElementById('successToast');
                            let toast = new bootstrap.Toast(toastEl);
                            toast.show();

                            // Get current service count for serial number
                            let currentCount = $("tbody tr").length;
                            if ($("tbody tr td[colspan='6']").length > 0) {
                                currentCount = 0; // Reset if empty state exists
                                $("tbody").empty(); // Remove empty state row
                            }

                            $("tbody").append(`
        <tr class="align-middle">
            <td class="fw-bold text-primary">${currentCount + 1}</td>
            <td>
                <div class="d-flex align-items-center">
                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px;">
                        <i class="fa fa-scissors text-white small"></i>
                    </div>
                    <strong class="text-dark">${$('#serviceName').val()}</strong>
                </div>
            </td>
            <td>
                <span class="badge bg-success">
                    <i class="fa fa-rupee-sign me-1"></i>${$('#servicePrice').val()}
                </span>
            </td>
            <td>
                <span class="text-muted">
                    <i class="fa fa-clock me-1"></i>${$('#serviceDuration').val()} min
                </span>
            </td>
            <td>
                <span class="badge bg-primary">Active</span>
            </td>
            <td class="text-center">
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-warning edit-service"
                        data-id="${response.services.id}"
                        data-name="${$('#serviceName').val()}"
                        data-duration="${$('#serviceDuration').val()}"
                        data-price="${$('#servicePrice').val()}">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-outline-danger delete-service" data-id="${response.services.id}">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
    `);

                            // Update footer count
                            let newCount = $("tbody tr").length;
                            if ($(".card-footer").length > 0) {
                                $(".card-footer small").html(
                                    `Total: <strong>${newCount}</strong> services`);
                            } else {
                                // Add footer if it doesn't exist
                                $(".card").append(`
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">Total: <strong>${newCount}</strong> services</small>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                        <i class="fa fa-plus me-2"></i>Add Another Service
                    </button>
                </div>
            </div>
        `);
                            }
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

                $('#editServiceId').val(id);
                $('#editServiceName').val(name);
                $('#editServicePrice').val(price);
                $('#editServiceDuration').val(duration);

                $('#editServiceModal').modal('show');
            });


            $('#editServiceForm').submit(function(e) {
                e.preventDefault();

                let id = $('#editServiceId').val();
                let url_1 = "<?php echo e(route('services.update', ':id')); ?>".replace(':id', id);
                $.ajax({
                    url: url_1,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status) {
                            // Update the service in the table row
                            let tableRow = $(`.edit-service[data-id="${id}"]`).closest('tr');

                            // Update service name in the second column
                            tableRow.find('td:nth-child(2) strong').text(response.service.name);

                            // Update price badge in the third column
                            tableRow.find('td:nth-child(3) .badge').html(`
        <i class="fa fa-rupee-sign me-1"></i>${response.service.price}
    `);

                            // Update duration in the fourth column
                            tableRow.find('td:nth-child(4) span').html(`
        <i class="fa fa-clock me-1"></i>${response.service.duration} min
    `);

                            // Update button data attributes with new values
                            tableRow.find('.edit-service')
                                .attr('data-name', response.service.name)
                                .attr('data-price', response.service.price)
                                .attr('data-duration', response.service.duration);

                            // Show success toast
                            let toastEl = document.getElementById('successToast');
                            let toast = new bootstrap.Toast(toastEl);
                            toast.show();

                            // Hide modal
                            $('#editServiceModal').modal('hide');
                        }
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



            $(document).on('click', '.delete-service', function() {
                let id = $(this).data('id');

                if (confirm('Are you sure you want to delete this service?')) {
                    let url = "<?php echo e(route('services.destroy', ':id')); ?>".replace(':id', id);

                    $.ajax({
                        url: url,
                        type: 'POST', // use POST if route is POST
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>'
                            // If using DELETE route instead, add:
                            // _method: 'DELETE'
                        },
                        success: function(response) {
                            if (response.status) {
                                // Remove from DOM
                                $(`.delete-service[data-id="${id}"]`).closest('li').remove();

                                // Show success toast
                                let toastEl = document.getElementById('successToast');
                                let toast = new bootstrap.Toast(toastEl);
                                toast.show();
                            }
                        },
                        error: function() {
                            alert('Something went wrong while deleting!');
                        }
                    });
                }
            });

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp8.2\htdocs\salon_unitiii\resources\views/services.blade.php ENDPATH**/ ?>