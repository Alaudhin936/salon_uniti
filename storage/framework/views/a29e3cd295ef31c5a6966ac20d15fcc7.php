<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/animate.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/chartist.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/prism.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/vector-map.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Salon Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Salon</li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid dashboard-default">
        <div class="row">
            <div class="col-xxl-6 col-xl-5 col-lg-6 dash-45 box-col-40">
                <div class="card profile-greeting">
                    <div class="card-body">
                        <div class="d-sm-flex d-block justify-content-between">
                            <div class="flex-grow-1">
                                <div class="weather d-flex">
                                    <h2 class="f-w-400"> <span>28<sup><i class="fa fa-circle-o f-10"></i></sup>C </span>
                                    </h2>
                                    <div class="span sun-bg"><i class="icofont icofont-sun font-primary"></i></div>
                                </div><span class="font-primary f-w-700">Perfect Weather</span>
                                <p>Great Day for Salon Business</p>
                            </div>
                            <div class="badge-group">
                                <div class="badge badge-light-primary f-12"> <i class="fa fa-clock-o"></i><span
                                        id="txt"></span>
                                </div>
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
                            <h4><a href="user-profile.html"><span>Welcome Back</span> Sarah </a><span class="right-circle"><i
                                        class="fa fa-check-circle font-primary f-14 middle"></i></span></h4>
                            <div><span class="badge badge-primary">8</span><span
                                    class="font-primary f-12 middle f-w-500 ms-2"> Appointments Today</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 box-col-25">
                <div class="card total-revenue overflow-hidden">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1">
                                <p class="square-after f-w-600 header-text-primary">Monthly Revenue<i
                                        class="fa fa-circle"></i>
                                </p>
                                <h4>$8,450</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="revenue-chart" id="revenue-chart"></div>
                    </div>
                </div>
                <div class="card total-investment">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1">
                                <p class="square-after f-w-600 header-text-primary">Services Booked<i
                                        class="fa fa-circle"> </i>
                                </p>
                                <h4>156 Services</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="progress sm-progress-bar">
                            <div class="progress-colors" role="progressbar" style="width: 100%" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100">
                                <div class="bg-secondary progress-1"></div>
                                <div class="bg-primary progress-2"></div>
                            </div>
                        </div>
                        <div class="bottom-progress"><span class="badge round-badge-primary font-worksans">12% <i
                                    class="fa fa-caret-up"></i></span><span
                                class="pull-right font-primary font-worksans f-w-700">85%</span></div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-md-6 dash-30 box-col-35">
                <div class="card our-user">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1">
                                <p class="square-after f-w-600 header-text-primary">Client Demographics<i
                                        class="fa fa-circle"></i>
                                </p>
                                <h4>342 Clients</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="user-chart">
                            <div id="user-chart"></div>
                            <div class="icon-donut"><i data-feather="arrow-up-circle"></i></div>
                        </div>
                        <ul>
                            <li>
                                <p class="f-w-600 font-primary f-12">Regular Clients</p><span class="f-w-600">65.2%</span>
                            </li>
                            <li>
                                <p class="f-w-600 font-primary f-12">New Clients </p><span class="f-w-600">28.4%</span>
                            </li>
                            <li>
                                <p class="f-w-600 font-primary f-12">VIP Members </p><span class="f-w-600">6.4%</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 box-col-30 xl-30">
                <div class="card our-earning">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1">
                                <p class="square-after f-w-600 header-text-primary">Service Performance<i
                                        class="fa fa-circle"> </i>
                                </p>
                                <h4>Weekly Report</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="earning-chart">
                            <div id="earning-chart"></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <ul class="d-sm-flex d-block">
                            <li>
                                <p class="f-w-600 font-primary f-12">Hair Services</p><span class="f-w-600">45%</span>
                            </li>
                            <li>
                                <p class="f-w-600 font-primary f-12">Beauty Services </p><span
                                    class="f-w-600">55%</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 box-col-40 xl-40">
                <div class="card appointment-detail">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1">
                                <p class="square-after f-w-600 header-text-primary">Today's Appointments<i
                                        class="fa fa-circle"> </i>
                                </p>
                                <h4>8 Bookings</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive theme-scrollbar">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex"><img class="img-fluid align-top circle"
                                                    src="<?php echo e('assets/images/dashboard/default/01.png'); ?>"
                                                    alt="">
                                                <div class="flex-grow-1"><a
                                                        href="<?php echo e(route('user_profile')); ?>"><span>Emma Watson</span></a>
                                                    <p class="mb-0">Hair Cut & Color</p>
                                                </div>
                                                <div class="active-status active-online"></div>
                                            </div>
                                        </td>
                                        <td>10:00 AM</td>
                                        <td class="text-end">
                                            <button class="btn btn-primary" type="button">Confirmed</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex"><img class="img-fluid align-top circle"
                                                    src="<?php echo e('assets/images/dashboard/default/02.png'); ?>"
                                                    alt="">
                                                <div class="flex-grow-1"><a
                                                        href="<?php echo e(route('user_profile')); ?>"><span>Sarah Miller</span></a>
                                                    <p class="mb-0">Facial Treatment</p>
                                                </div>
                                                <div class="active-status active-busy"></div>
                                            </div>
                                        </td>
                                        <td>11:30 AM</td>
                                        <td class="text-end">
                                            <button class="btn btn-secondary" type="button">In Progress</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex"><img class="img-fluid align-top circle"
                                                    src="<?php echo e('assets/images/dashboard/default/03.png'); ?>"
                                                    alt="">
                                                <div class="flex-grow-1"><a href="<?php echo e(route('user_profile')); ?>"><span>Lisa
                                                            Johnson</span></a>
                                                    <p class="mb-0">Manicure & Pedicure</p>
                                                </div>
                                                <div class="active-status active-offline"></div>
                                            </div>
                                        </td>
                                        <td>2:00 PM</td>
                                        <td class="text-end">
                                            <button class="btn btn-success" type="button">Confirmed</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex"><img class="img-fluid align-top circle"
                                                    src="<?php echo e('assets/images/dashboard/default/04.png'); ?>"
                                                    alt="">
                                                <div class="flex-grow-1"><a
                                                        href="<?php echo e(route('user_profile')); ?>"><span>Rachel Green</span></a>
                                                    <p class="mb-0">Hair Styling</p>
                                                </div>
                                                <div class="active-status active-online"></div>
                                            </div>
                                        </td>
                                        <td>3:30 PM</td>
                                        <td class="text-end">
                                            <button class="btn btn-info" type="button">Confirmed</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex"><img class="img-fluid align-top circle"
                                                    src="<?php echo e('assets/images/dashboard/default/05.png'); ?>"
                                                    alt="">
                                                <div class="flex-grow-1"><a href="<?php echo e(route('user_profile')); ?>"><span>Monica
                                                            Ross</span></a>
                                                    <p class="mb-0">Full Makeup</p>
                                                </div>
                                                <div class="active-status active-offline"></div>
                                            </div>
                                        </td>
                                        <td>5:00 PM</td>
                                        <td class="text-end">
                                            <button class="btn btn-danger" type="button">Pending</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 box-col-30 xl-30">
                <div class="card use-country">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1">
                                <p class="square-after f-w-600 header-text-primary">Client Location<i
                                        class="fa fa-circle"> </i>
                                </p>
                                <h4>Service Areas</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="jvector-map-height" id="asia"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 box-col-12">
                <div class="card total-growth">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1">
                                <p class="square-after f-w-600 header-text-primary">Salon Business Growth<i
                                        class="fa fa-circle"> </i>
                                </p>
                                <h4>Monthly Progress</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="growth-chart">
                            <div id="growth-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 box-col-33">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1">
                                <p class="square-after f-w-600 header-text-primary">Recent Activity<i
                                        class="fa fa-circle"> </i>
                                </p>
                                <h4>Latest Updates</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="activity-timeline">
                            <div class="d-flex">
                                <div class="activity-line"></div>
                                <div class="activity-dot-primary"></div>
                                <div class="flex-grow-1"><span class="f-w-600 d-block">New Client Registered</span>
                                    <p class="mb-0">Emma joined as VIP member for premium services.</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="activity-dot-primary"></div>
                                <div class="flex-grow-1"><span class="f-w-600 d-block">Service Package Updated</span>
                                    <p class="mb-0">Hair & Beauty combo package now available.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="activity-dot-secondary"></div>
                                <div class="flex-grow-1"><span class="f-w-600 d-block">New Review Received</span>
                                    <p class="mb-0">Sarah left 5-star review for facial treatment.</p>
                                </div><i class="fa fa-circle circle-dot-primary"></i>
                            </div>
                            <div class="d-flex">
                                <div class="activity-dot-primary"></div>
                                <div class="flex-grow-1"><span class="f-w-600 d-block">Staff Training Completed</span>
                                    <p class="mb-0">Advanced color techniques workshop finished.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="activity-dot-secondary"></div>
                                <div class="flex-grow-1"><span class="f-w-600 d-block">Inventory Restocked</span>
                                    <p class="mb-0">Premium hair care products added to inventory.</p>
                                </div><i class="fa fa-circle circle-dot-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 proorder box-col-33">
                <div class="card user-chat">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1">
                                <p class="square-after f-w-600 header-text-primary">Client Messages<i
                                        class="fa fa-circle">
                                    </i></p>
                                <h4>Live Chat</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body chat-box">
                        <div class="d-flex left-chat">
                            <div class="flex-grow-1">
                                <div class="message-main">
                                    <p class="mb-0">Hello!</p>
                                </div>
                                <div class="sub-message message-main">
                                    <p class="mb-0">Can I book for tomorrow?</p>
                                </div>
                            </div>
                            <p class="f-w-500 mb-0 px-0">2:15 PM</p>
                        </div>
                        <div class="d-flex right-chat">
                            <div class="flex-grow-1 text-end">
                                <div class="message-main pull-right">
                                    <p class="text-start mb-0">Sure! What service do you need?</p>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex left-chat">
                            <div class="flex-grow-1">
                                <div class="sub-message message-main mt-0">
                                    <p class="mb-0">Hair color and styling please</p>
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <input class="form-control" id="mail" type="text" placeholder="Type Your Message"
                                name="text">
                            <div class="send-msg"><i data-feather="send"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 box-col-33">
                <div class="card our-todolist">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1">
                                <p class="square-after f-w-600 header-text-primary">Daily Tasks<i class="fa fa-circle">
                                    </i>
                                </p>
                                <h4>To-Do List</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="activity-timeline todo-timeline">
                            <div class="d-flex">
                                <div class="activity-line"></div>
                                <div class="activity-dot-primary"></div>
                                <div class="flex-grow-1">
                                    <p class="mt-0 todo-font"><span class="font-primary">Today </span>High Priority</p>
                                    <div class="d-flex mt-0"><img class="img-fluid img-30"
                                            src="<?php echo e(asset('assets/images/dashboard/default/todo.png')); ?>" alt="">
                                        <div class="flex-grow-1"><span class="f-w-600">Inventory Check<i
                                                    class="fa fa-circle circle-dot-primary pull-right"></i></span>
                                            <p class="mb-0">Review hair product stock levels</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="activity-dot-secondary"></div>
                                <div class="flex-grow-1">
                                    <p class="mt-0 todo-font"><span class="font-primary">Today </span><span
                                            class="badge badge-primary ms-2">New</span></p><span class="f-w-600">Staff Meeting
                                        <i class="fa fa-circle circle-dot-secondary pull-right"></i></span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="activity-dot-primary"></div>
                                <div class="flex-grow-1">
                                    <p class="mt-0 todo-font"><span class="font-primary">Tomorrow </span></p><span
                                        class="f-w-600">Client Follow-ups</span>
                                    <p class="mb-0">Contact clients for feedback and rebooking.</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="activity-dot-primary"></div>
                                <div class="flex-grow-1">
                                    <p class="mt-0 todo-font"><span class="font-primary">This Week </span></p><span
                                        class="f-w-600">Equipment Maintenance<i
                                            class="fa fa-circle circle-dot-primary pull-right"></i></span>
                                    <p class="mb-0">Service styling chairs and equipment.</p>
                                </div>
                            </div>
                        </div>
                    </div>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp8.2\htdocs\salon_unitiii\resources\views/dashboards/vendor_dashboard.blade.php ENDPATH**/ ?>