<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/animate.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/chartist.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/prism.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/vector-map.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
    <style>
       .container-fluid{
        padding: 0 !important;
       }
    </style>
    <div class="container-fluid">
        <div class="page-title py-4">
            <div class="row">
                <div class="col-sm-6">
                    <h3></h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item active">Default</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid dashboard-default">

        <div class="col-12 box-col-40 mb">
            <div class="card profile-greeting fade-in">
                <div class="card-body">
                    <div class="d-sm-flex d-block justify-content-between">
                        <div class="badge-group">

                        </div>
                    </div>
                    <div class="greeting-user">
                        <div class="profile-vector">
                            <ul class="dots-images">
                                <li class="dot-small bg-info dot-1"></li>
                                <li class="dot-medium bg-primary dot-2"></li>
                                <li class="dot-medium bg-info dot-3"></li>
                                <li class="semi-medium bg-primary dot-4"></li>
                                <li class="dot-small bg-info dot-5"></li>
                                <li class="dot-big bg-info dot-6"></li>
                                <li class="dot-small bg-primary dot-7"></li>
                                <li class="semi-medium bg-primary dot-8"></li>
                                <li class="dot-big bg-info dot-9"></li>
                            </ul><img class="img-fluid" src="<?php echo e('assets/images/dashboard/default/profile.png'); ?>"
                                alt="">
                            <ul class="vector-image">
                                <li> <img src="<?php echo e('assets/images/dashboard/default/ribbon1.png'); ?>" alt="">
                                </li>
                                <li> <img src="<?php echo e('assets/images/dashboard/default/ribbon3.png'); ?>" alt="">
                                </li>
                                <li> <img src="<?php echo e('assets/images/dashboard/default/ribbon4.png'); ?>" alt="">
                                </li>
                                <li> <img src="<?php echo e('assets/images/dashboard/default/ribbon5.png'); ?>" alt="">
                                </li>
                                <li> <img src="<?php echo e('assets/images/dashboard/default/ribbon6.png'); ?>" alt="">
                                </li>
                                <li> <img src="<?php echo e('assets/images/dashboard/default/ribbon7.png'); ?>" alt="">
                                </li>
                            </ul>
                        </div>
                        <h4><a href="user-profile.html"><span>Welcome Back</span> <?php echo e(auth()->user()->name); ?> </a><span
                                class="right-circle"><i class="fa fa-check-circle font-primary f-14 middle"></i></span>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Today's Revenue Card -->
            <div class="col-xl-3 col-md-6 ">
                <div class="card shadow border-0 rounded-lg">
                    <div class="card-body text-center">
                        <h6 class="fw-bold text-primary">Today's Revenue</h6>
                        <h3 class="fw-bold text-success">
                            ₹ <?php echo e(number_format($todaysRevenue, 2)); ?>

                        </h3>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-md-6 mb-4">
                <div class="card shadow border-0 rounded-lg">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">Today's Appointments</h6>
                        <?php if($todaysAppointments->isEmpty()): ?>
                            <p class="text-muted">No appointments today.</p>
                        <?php else: ?>
                            <ul class="list-group list-group-flush">
                                <?php $__currentLoopData = $todaysAppointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li style="background: #d6f5e6" class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong><?php echo e($appointment->customer_name); ?></strong> has
                                            <?php echo e($appointment->status); ?> <em><?php echo e($appointment->service_name); ?></em>
                                        </div>
                                        <span class="badge bg-info">
                                            <?php echo e(\Carbon\Carbon::parse($appointment->slot_start)->format('H:i')); ?> -
                                            <?php echo e(\Carbon\Carbon::parse($appointment->slot_end)->format('H:i')); ?>

                                        </span>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 box-col-35">
                <div class="card mb-5 shadow-sm border-0">

                    <div class="card-header bg-primary text-white fw-bold py-3">
                        <i class="fas fa-calendar-check me-2"></i>Today's Customers
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-3">
                        <?php if($todaysAppointments->isEmpty()): ?>
                            <div class="text-center py-5">
                                <i class="fas fa-user-slash fa-3x mb-3 text-muted opacity-50"></i>
                                <p class="fs-5 text-muted">No customers today.</p>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table align-middle table-borderless mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="ps-4">Customer</th>
                                            <th>Service</th>
                                            <th class="text-center">Time</th>
                                            <th class="text-center pe-4">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $todaysAppointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="border-bottom">
                                                <!-- Customer -->
                                                <td class="ps-4 fw-semibold text-primary">
                                                    <i class="fas fa-user-circle me-2 text-secondary"></i>
                                                    <?php echo e($appointment->customer_name); ?>

                                                </td>

                                                <!-- Service -->
                                                <td class="text-muted">
                                                    <?php echo e($appointment->service_name); ?>

                                                </td>

                                                <!-- Time -->
                                                <td class="text-center">
                                                    <span
                                                        class="badge bg-light text-dark border px-3 py-2 rounded-pill shadow-sm">
                                                        <?php echo e(\Carbon\Carbon::parse($appointment->slot_start)->format('H:i')); ?>

                                                        -
                                                        <?php echo e(\Carbon\Carbon::parse($appointment->slot_end)->format('H:i')); ?>

                                                    </span>
                                                </td>

                                                <!-- Status -->
                                                <td class="text-center pe-4">
                                                    <span
                                                        class="badge rounded-pill px-3 py-2 shadow-sm
                                            <?php if($appointment->status == 'booked'): ?> bg-success
                                            <?php elseif($appointment->status == 'cancelled'): ?> bg-danger
                                            <?php else: ?> bg-secondary <?php endif; ?>">
                                                        <?php echo e(ucfirst($appointment->status)); ?>

                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="earning-chart">
            <canvas id="earning-chart" height="100"></canvas>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/chart/chartist/chartist.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/chart/apex-chart/apex-chart.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/chart/apex-chart/stock-prices.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/prism/prism.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/clipboard/clipboard.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/custom-card/custom-card.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/notify/bootstrap-notify.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/vector-map/jquery-jvectormap-2.0.2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/vector-map/map/jquery-jvectormap-world-mill-en.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/vector-map/map/jquery-jvectormap-us-aea-en.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/vector-map/map/jquery-jvectormap-uk-mill-en.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/vector-map/map/jquery-jvectormap-au-mill.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/vector-map/map/jquery-jvectormap-chicago-mill-en.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/vector-map/map/jquery-jvectormap-in-mill.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/vector-map/map/jquery-jvectormap-asia-mill.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/dashboard/default.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/notify/index.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/typeahead/handlebars.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/typeahead/typeahead.bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/typeahead/typeahead.custom.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/typeahead-search/handlebars.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/typeahead-search/typeahead-custom.js')); ?>"></script>
    <script>
        localStorage.clear();
        localStorage.setItem('body-wrapper', '');
    </script>
    <script>
        $(document).ready(function() {
            let months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            let chartData = new Array(12).fill(0);

            let monthlyEarnings = <?php echo json_encode($monthlyEarnings, 15, 512) ?>;
            $.each(monthlyEarnings, function(month, value) {
                chartData[month - 1] = value;
            });

            let ctx = document.getElementById('earning-chart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Monthly Earnings',
                        data: chartData,
                        borderColor: '#6c757d',
                        backgroundColor: 'rgba(108,117,125,0.1)',
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#6c757d',
                        pointBorderWidth: 2,
                        pointRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return "₹ " + context.raw;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                color: "#666"
                            }
                        },
                        y: {
                            ticks: {
                                color: "#666",
                                callback: function(value) {
                                    return "₹ " + value;
                                }
                            }
                        }
                    }
                }
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp8.2\htdocs\salon_unitiii\resources\views/admin_unique_layout/box_dashboard.blade.php ENDPATH**/ ?>