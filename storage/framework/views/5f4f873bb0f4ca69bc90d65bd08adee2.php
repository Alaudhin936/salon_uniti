<div class="sidebar-wrapper">
    <?php if(auth()->user()->role_id == 2): ?>
       <div class="sidebar-container">
    <!-- Logo & Top Controls -->
    <div class="logo-wrapper d-flex align-items-center justify-content-between px-3 py-2">
        <a href="<?php echo e(route('vendor_dashboard')); ?>" style="height: 75px" class="d-flex align-items-center">
            <img src="<?php echo e(asset('assets/images/SALONUNITII LOGO-04 3.svg')); ?>"
                 alt="Salon Uniti Logo"
                 class="img-fluid"
                 style="max-height: 120px; width: auto;">
        </a>
        <div class="d-flex align-items-center">
            <div class="back-btn me-2"><i data-feather="arrow-left-circle"></i></div>
            <div class="toggle-sidebar icon-box-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="menu"></i></div>
        </div>
    </div>

    <!-- Home Icon -->
    <div class="logo-icon-wrapper text-center my-3">
        <a href="<?php echo e(route('dashboard')); ?>">
            <div class="icon-box-sidebar"><i data-feather="home"></i></div>
        </a>
    </div>

    <!-- Sidebar Navigation -->
    <nav class="sidebar-main">
        <div id="sidebar-menu">
            <ul class="sidebar-links list-unstyled px-2" id="simple-bar">
                <li class="sidebar-list mb-2">
                    <a class="sidebar-link sidebar-title" href="<?php echo e(route('vendor_dashboard')); ?>">
                        <i data-feather="scissors"></i><span class="ms-2">Salon</span>
                    </a>
                </li>

                <li class="sidebar-list mb-2">
                    <a class="sidebar-link sidebar-title" href="<?php echo e(route('customers')); ?>">
                        <i data-feather="users"></i><span class="ms-2">Customers</span>
                    </a>
                </li>

                <li class="sidebar-list mb-2">
                    <a class="sidebar-link sidebar-title" href="<?php echo e(route('support_ticket')); ?>">
                        <i data-feather="clock"></i><span class="ms-2">Time slots</span>
                    </a>
                </li>

                <li class="sidebar-list mb-2">
                    <a class="sidebar-link sidebar-title" href="<?php echo e(route('services')); ?>">
                        <i data-feather="briefcase"></i><span class="ms-2">Services</span>
                    </a>
                </li>

                <li class="sidebar-list mb-2">
                    <a class="sidebar-link sidebar-title" href="<?php echo e(route('appointments')); ?>">
                        <i data-feather="calendar"></i><span class="ms-2">Appointments</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="<?php echo e(route('support_ticket')); ?>">
                        <i data-feather="settings"></i><span class="ms-2">Settings</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>

    <?php elseif(auth()->user()->role_id == 1): ?>
        <div>
            <div class="logo-wrapper">
                <a href="<?php echo e(route('vendor_dashboard')); ?>">
                    <h3>Salon Unitii</h3>
                </a>
                <a class="logo-wrapper">Admin Page</a>
                <div class="back-btn"><i data-feather="arrow-left-circle"></i></div>
                <div class="toggle-sidebar icon-box-sidebar"><i class="status_toggle middle sidebar-toggle"
                        data-feather="menu"></i></div>
            </div>

            <div class="logo-icon-wrapper">
                <a href="<?php echo e(route('dashboard')); ?>">
                    <div class="icon-box-sidebar"><i data-feather="home"></i></div>
                </a>
            </div>

            <nav class="sidebar-main">
                <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                <div id="sidebar-menu">
                    <ul class="sidebar-links" id="simple-bar">
                        <li class="back-btn">
                            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                    aria-hidden="true"></i></div>
                        </li>
                        <hr>

                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title" href="<?php echo e(route('dashboard')); ?>">
                                <i data-feather="home"></i><span class="lan-3"></span>
                            </a>
                        </li>
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('salons')); ?>">
                                <i data-feather="scissors"></i><span>Salonss</span>
                            </a>
                        </li>


                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('support_ticket')); ?>">
                                <i data-feather="layers"></i><span>Salon Type</span>
                            </a>
                        </li>
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('support_ticket')); ?>">
                                <i data-feather="log-out"></i><span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\xampp8.2\htdocs\salon_unitiii\resources\views/layout/sidebar.blade.php ENDPATH**/ ?>