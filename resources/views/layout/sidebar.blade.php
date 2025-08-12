<div class="sidebar-wrapper">
    @if (auth()->user()->role_id == 2)
        <div>
            <div class="logo-wrapper">
                <a href="{{ route('vendor_dashboard') }}">
                    <h3>Salon Unitii</h3>
                </a>
                <a class="logo-wrapper">Vendor Page</a>
                <div class="back-btn"><i data-feather="arrow-left-circle"></i></div>
                <div class="toggle-sidebar icon-box-sidebar"><i class="status_toggle middle sidebar-toggle"
                        data-feather="menu"></i></div>
            </div>

            <div class="logo-icon-wrapper">
                <a href="{{ route('dashboard') }}">
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

                        <li class="pin-title sidebar-list">
                            <h6>Pinned</h6>
                        </li>
                        <hr>

                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title" href="{{ route('vendor_dashboard') }}">
                                <i data-feather="scissors"></i><span class="lan-3">Salon</span>
                            </a>
                        </li>

                         <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('customers') }}">
                                <i data-feather="clock"></i><span>Customers</span>
                            </a>
                        </li>

                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('support_ticket') }}">
                                <i data-feather="clock"></i><span>Time slots</span>
                            </a>
                        </li>

                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('services') }}">
                                <i data-feather="briefcase"></i><span>Services</span>
                            </a>
                        </li>

                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('appointments') }}">
                                <i data-feather="calendar"></i><span>Appointments</span>
                            </a>
                        </li>

                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('support_ticket') }}">
                                <i data-feather="settings"></i><span>Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
        </div>
    @elseif(auth()->user()->role_id == 1)
        <div>
            <div class="logo-wrapper">
                <a href="{{ route('vendor_dashboard') }}">
                    <h3>Salon Unitii</h3>
                </a>
                <a class="logo-wrapper">Admin Page</a>
                <div class="back-btn"><i data-feather="arrow-left-circle"></i></div>
                <div class="toggle-sidebar icon-box-sidebar"><i class="status_toggle middle sidebar-toggle"
                        data-feather="menu"></i></div>
            </div>

            <div class="logo-icon-wrapper">
                <a href="{{ route('dashboard') }}">
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

                        <li class="pin-title sidebar-list">
                            <h6>Pinned</h6>
                        </li>
                        <hr>

                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title" href="{{ route('dashboard') }}">
                                <i data-feather="home"></i><span class="lan-3"></span>
                            </a>
                        </li>
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('salons') }}">
                                <i data-feather="scissors"></i><span>Salonss</span>
                            </a>
                        </li>


                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('support_ticket') }}">
                                <i data-feather="layers"></i><span>Salon Type</span>
                            </a>
                        </li>
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('support_ticket') }}">
                                <i data-feather="log-out"></i><span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
        </div>
    @endif
</div>
