<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
    <div class="container">
        <h2 class="mb-4" style="color: #0a566d;">Your Profile</h2>

        <form id="vendorForm" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        Vendor Details
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" id="name" name="name" value="<?php echo e(auth()->user()->name); ?>"
                                class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo e(auth()->user()->email); ?>"
                                class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" id="phone" name="phone" value="<?php echo e(auth()->user()->phone); ?>"
                                class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password (leave blank to keep current)</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        Business Details
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="cover_photo" class="form-label">Cover Photo</label>
                            <input type="file" id="cover_photo" name="cover_photo" class="form-control" accept="image/*">
                            <?php if($vendor->cover_photo): ?>
                                <div class="mt-2">
                                    <img src="<?php echo e(asset('storage/' . $vendor->cover_photo)); ?>" alt="Cover Photo"
                                        class="img-fluid rounded" style="max-height: 150px;">
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <label for="business_name" class="form-label">Business Name</label>
                            <input type="text" id="business_name" name="business_name"
                                value="<?php echo e($vendor->business_name); ?>" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="slogan" class="form-label">Slogan</label>
                            <input type="text" id="slogan" name="slogan" value="<?php echo e($vendor->slogan); ?>"
                                class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="type" class="form-label">Type</label>
                            <select id="type" name="type" class="form-select">
                                <option value="Unisex" <?php echo e($vendor->type == 'Unisex' ? 'selected' : ''); ?>>Unisex</option>
                                <option value="Male" <?php echo e($vendor->type == 'Male' ? 'selected' : ''); ?>>Male</option>
                                <option value="Female" <?php echo e($vendor->type == 'Female' ? 'selected' : ''); ?>>Female</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" id="location" name="location" value="<?php echo e($vendor->location); ?>"
                                class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="gst_number" class="form-label">GST Number</label>
                            <input type="text" id="gst_number" placeholder="ABCDE1234F" name="gst_number"
                                value="<?php echo e($vendor->gst_number); ?>" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="shop_open" class="form-label">Shop Open Time</label>
                            <input type="time" id="shop_open" name="shop_open" value="<?php echo e($vendor->shop_open); ?>"
                                class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="shop_close" class="form-label">Shop Close Time</label>
                            <input type="time" id="shop_close" name="shop_close" value="<?php echo e($vendor->shop_close); ?>"
                                class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="is_active" class="form-label">Status</label>
                            <select id="is_active" name="is_active" class="form-select">
                                <option value="1" <?php echo e($vendor->is_active ? 'selected' : ''); ?>>Active</option>
                                <option value="0" <?php echo e(!$vendor->is_active ? 'selected' : ''); ?>>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="text-end">
                <button type="submit" class="btn btn-primary px-4" id="saveBtn">
                    <i class="fa fa-save me-2"></i>
                    <span class="btn-text">Save Changes</span>
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                </button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/counter/jquery.waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/counter/jquery.counterup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/counter/counter-custom.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/support-ticket-custom.js')); ?>"></script>

    <script>
        $('#vendorForm').on('submit', function(e) {
            e.preventDefault();
            let btn = $('#saveBtn');

            btn.prop('disabled', true);
            btn.find('.btn-text').text('Saving...');
            btn.find('.spinner-border').removeClass('d-none');

            let formData = new FormData(this);

            $.ajax({
                url: "<?php echo e(route('salon.profileupdate')); ?>",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Business Details saved successfully!',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        if (response.reload) {
                            window.location.reload();
                        }
                    });

                    btn.prop('disabled', false);
                    btn.find('.btn-text').text('Save Changes');
                    btn.find('.spinner-border').addClass('d-none');
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Something went wrong',
                        confirmButtonColor: 'red',
                        confirmButtonText: 'OK'
                    });
                    btn.prop('disabled', false);
                    btn.find('.btn-text').text('Save Changes');
                    btn.find('.spinner-border').addClass('d-none');
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp8.2\htdocs\salon_unitiii\resources\views/vendor_profile.blade.php ENDPATH**/ ?>