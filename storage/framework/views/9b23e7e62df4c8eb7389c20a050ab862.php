<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/animate.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/chartist.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/prism.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/vector-map.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
    <style>
        .container-fluid {
            padding: 0 !important;
        }
    </style>
    <div class="container-fluid py-4">

        <!-- Page Title & Breadcrumb -->
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3 style="color:#0a566d" class="underlined-heading mb-4 fw-bold">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-end">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active text-primary">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>


        <!-- Greeting Card -->
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="d-flex align-items-center">

                            <img src="<?php echo e(isset($vendor->cover_photo) ? asset('storage/' . $vendor->cover_photo) : ''); ?>"
                                class="rounded-circle me-3" alt="Profile" width="60" height="60">
                            <div>
                                <h5 class="mb-0">Welcome Back, <?php echo e(auth()->user()->name); ?></h5>
                                <small class="text-muted">Have a great day!</small>
                            </div>
                        </div>
                        <span class="badge bg-success rounded-pill mt-3 mt-md-0"><i class="fas fa-check-circle me-1"></i>
                            Verified</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today's Revenue & Appointments -->
        <div class="row g-3">

            <!-- Today's Revenue -->
            <div class="col-xl-3 col-md-6">
                <div class="card shadow-sm border-0 rounded-4 text-center">
                    <div class="card-body">
                        <h6 class="text-primary fw-bold">Today's Revenue</h6>
                        <h3 class="text-success fw-bold mt-2">₹ <?php echo e(number_format($todaysRevenue, 2)); ?></h3>
                        <small class="text-muted">Completed appointments</small>
                    </div>
                </div>
            </div>

            <!-- This Month's Earnings -->
            <div class="col-xl-9 col-md-6">
                <div class="card shadow-sm border-0 rounded-4 text-center">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <h6 class="text-primary fw-bold mb-2">This Month's Earnings</h6>
                        <h2 class="fw-bold text-success mb-2">
                            ₹<?php echo e(number_format($monthlyRevenue, 2)); ?>

                        </h2>
                        <small class="text-muted">Total revenue from completed appointments</small>
                    </div>
                </div>
            </div>

        </div>


        <!-- Today's Customers Table -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header bg-primary text-white fw-bold">
                        <i class="fas fa-calendar-check me-2"></i>Today's Customers
                    </div>
                    <div class="card-body p-3">
                        <?php if($todaysAppointments->isEmpty()): ?>
                            <div class="text-center py-5">
                                <i class="fas fa-user-slash fa-3x mb-3 text-muted"></i>
                                <p class="fs-5 text-muted">No customers today.</p>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Customer</th>
                                            <th>Service</th>
                                            <th class="text-center">Time</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $todaysAppointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="text-primary fw-semibold">
                                                    <i
                                                        class="fas fa-user-circle me-2 text-secondary"></i><?php echo e($appointment->customer_name); ?>

                                                </td>
                                                <td class="text-muted"><?php echo e($appointment->service_name); ?></td>
                                                <td class="text-center">
                                                    <span class="badge bg-light text-dark rounded-pill px-3 py-2 shadow-sm">
                                                        <?php echo e(\Carbon\Carbon::parse($appointment->slot_start)->format('H:i')); ?>

                                                        -
                                                        <?php echo e(\Carbon\Carbon::parse($appointment->slot_end)->format('H:i')); ?>

                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="badge rounded-pill px-3 py-2
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

        <!-- Earning Chart -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-4 p-4">
                    <canvas id="earning-chart" height="100"></canvas>
                </div>
            </div>
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