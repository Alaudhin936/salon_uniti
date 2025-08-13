<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset ('assets/css/vendors/animate.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset ('assets/css/vendors/jkanban.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Kanban Board</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item"> Apps</li>
                        <li class="breadcrumb-item active"> Kanban Board</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid jkanban-container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4>Kanban</h4>
                    </div>
                    <div class="card-body pb-0">
                        <div id="demo1"></div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h4>Custom Board</h4>
                            </div>
                        </div>
                        <p class="mb-0">| colors, gutter, click on board&apos;s item and restricting which boards to drag
                            items to </p>
                    </div>
                    <div class="card-body pb-0">
                        <div id="demo2"></div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4>API</h4>
                        <p class="mb-0">add item, add board, delete board: </p>
                    </div>
                    <div class="card-body">
                        <div id="demo3"></div>
                        <button class="btn btn-success" id="addDefault">Add &quot;Default&quot; board</button>
                        <button class="btn btn-success" id="addToDo">Add element in &quot;To Do&quot; Board</button>
                        <button class="btn btn-danger" id="removeBoard">Remove &quot;Done&quot; Board</button>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card note p-20">jKanban is Pure agnostic Javascript plugin for Kanban boards for more options
                    please refer <a href="http://www.riccardotartaglia.it/jkanban/" target="_blank">jkanban Official site
                    </a>And <a href="https://github.com/riktar/jkanban" target="_blank">githup link</a></div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(('assets/js/jkanban/jkanban.js')); ?>"></script>
    <script src="<?php echo e(('assets/js/jkanban/custom.js')); ?>"></script>
    <script src="<?php echo e(('assets/js/typeahead/handlebars.js')); ?>"></script>
    <script src="<?php echo e(('assets/js/typeahead/typeahead.bundle.js')); ?>"></script>
    <script src="<?php echo e(('assets/js/typeahead/typeahead.custom.js')); ?>"></script>
    <script src="<?php echo e(('assets/js/typeahead-search/handlebars.js')); ?>"></script>
    <script src="<?php echo e(('assets/js/typeahead-search/typeahead-custom.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp8.2\htdocs\salon_unitiii\resources\views/kanban.blade.php ENDPATH**/ ?>