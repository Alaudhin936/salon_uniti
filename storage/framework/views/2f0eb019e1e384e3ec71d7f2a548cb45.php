<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-end">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active text-primary">Salon Types</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="container mt-0" style="padding:30px;background-color:white;">

        <div class="card-header mb-5 p-4 text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 underlined-heading fw-bold" style="color: #0a566d">Salon Types</h4>
            <button class="btn btn-light btn-md px-3 py-2 rounded-pill shadow-sm fw-semibold" data-bs-toggle="modal"
                data-bs-target="#addSalonTypeModal">
                <i class="fas fa-plus-circle me-2 text-primary"></i>Add Catagory
            </button>
        </div>

        <table class="table table-bordered mt-5 p-5" id="salonTypesTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $salonTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($type->id); ?></td>
                        <td><?php echo e($type->name); ?></td>
                        <td>
                            <button class="btn btn-warning btn-xs py-1 editBtn" data-id="<?php echo e($type->id); ?>"
                                data-name="<?php echo e($type->name); ?>" data-bs-toggle="modal" data-bs-target="#editSalonTypeModal">
                                <i class="fas fa-edit"></i>
                            </button>

                            <button class="btn btn-danger btn-xs py-1 deleteBtn" data-id="<?php echo e($type->id); ?>">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addSalonTypeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addSalonTypeForm">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header">
                        <h5 class="modal-title">Add Salon Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="name" class="form-control" placeholder="Enter Salon Type" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editSalonTypeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editSalonTypeForm">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" id="edit_id">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Salon Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="name" id="edit_name" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script>
        $(document).ready(function() {

            $('#salonTypesTable').DataTable({
                responsive: true,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search salon types..."
                }
            });
            $("#addSalonTypeForm").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "<?php echo e(route('admin.salon.types.store')); ?>",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(res) {
                        if (res.success) {
                            location.reload();
                        }
                    }
                });
            });

            $("#editSalonTypeForm").submit(function(e) {
                e.preventDefault();
                let salon_type_id = $("#edit_id").val();
                let myUrl = "<?php echo e(route('admin.salon.types.edit', ':id')); ?>".replace(':id', salon_type_id);
                $.ajax({
                    url: myUrl,
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(res) {
                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: `Salon Type Updated Successfully`,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then(function(result) {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }
                    }
                });
            });

            $(document).on("click", ".editBtn", function() {
                let id = $(this).data("id");
                let name = $(this).data("name");

                $("#edit_id").val(id);
                $("#edit_name").val(name);
            });

            $(document).on("click", ".deleteBtn", function() {
                let id = $(this).data("id");
                let myUrl = "<?php echo e(route('admin.salon.types.delete', ':id')); ?>".replace(':id', id);


                Swal.fire({
                    text: 'Are Your Sure Wanted to delete this Type',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Delete!'
                }).then(function(result) {
                    if (result.isConfirmed) {

                        $.ajax({
                            url: myUrl,
                            type: "POST",
                            data: {
                                _token: "<?php echo e(csrf_token()); ?>"
                            },

                            success: function(res) {
                                if (res.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: `Salon Type Updated Successfully`,
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'OK'
                                    }).then(function(result) {
                                        if (result.isConfirmed) {
                                            window.location.reload();
                                        }
                                    });
                                }
                            }
                        });
                    }
                });
            });

        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp8.2\htdocs\salon_unitiii\resources\views/salon_types.blade.php ENDPATH**/ ?>