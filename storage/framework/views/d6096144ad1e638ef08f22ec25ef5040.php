<!DOCTYPE html>
<html lang="en" <?php if(Route::currentRouteName()=='layout_rtl'): ?> dir="rtl" <?php endif; ?>>

<head>
    <?php echo $__env->make('layout.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- comman css-->
    <?php echo $__env->make('layout.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<?php switch(Route::currentRouteName()):
    case ('dashboard'): ?>
        <body onload="startTime()">
        <?php break; ?>

    <?php case ('box_layout'): ?>
        <body class="box-layout">
        <?php break; ?>

    <?php case ('layout_rtl'): ?>
        <body class="rtl">
        <?php break; ?>

    <?php case ('layout_dark'): ?>
        <body class="dark-only">
        <?php break; ?>

    <?php default: ?>
        <body>
<?php endswitch; ?>


    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->

    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"> </div>
        <div class="dot"></div>
    </div>
    <!-- Loader ends-->

    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper compact-sidebar" id="pageWrapper">

        <!-- Page Header Start-->
        <?php echo $__env->make('layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Page Header Ends-->

        <!-- Page Body Start-->
        <div class="page-body-wrapper">

            <!-- Page Sidebar Start-->
            <?php echo $__env->make('layout.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- Page Sidebar Ends-->

            
            <div class="page-body">
                <?php echo $__env->yieldContent('main_content'); ?>
                <!-- Container-fluid Ends-->
            </div>

            <!-- footer start-->
            <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>
    </div>
    
    <?php echo $__env->make('layout.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    

</body>
</html>
<?php /**PATH C:\xampp8.2\htdocs\salon_unitiii\resources\views/layout/master.blade.php ENDPATH**/ ?>