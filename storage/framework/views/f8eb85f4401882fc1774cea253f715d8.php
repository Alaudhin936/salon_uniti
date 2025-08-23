<div class="page-header">
    <div class="header-wrapper row m-0">
        <form class="form-inline search-full col" action="#" method="get">
            <div class="form-group w-100">
                <div class="Typeahead Typeahead--twitterUsers">
                    <div class="u-posRelative">
                        <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text"
                            placeholder="Search Tivo .." name="q" title="" autofocus>
                        <div class="spinner-border Typeahead-spinner" role="status"><span
                                class="sr-only">Loading...</span>
                        </div><i class="close-search" data-feather="x"></i>
                    </div>
                    <div class="Typeahead-menu"></div>
                </div>
            </div>
        </form>
        <div class="header-logo-wrapper col-auto p-0">
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
            <div class="logo-header-main"><a href="<?php echo e(route('dashboard')); ?>"><img class="img-fluid for-light"
                        src="<?php echo e(asset('assets/images/logo/logo2.png')); ?>" alt=""><img class="img-fluid for-dark"
                        src="<?php echo e(asset('assets/images/logo/logo.png')); ?>" alt=""></a></div>
        </div>
        <div class="left-header col horizontal-wrapper ps-0">
            
            <h5 class="fw-bold text-primary"> <?php if(auth()->user()->role_id == 2): ?> Vendor Admin Panel <?php else: ?> Super Admin Panel <?php endif; ?></h5>

        </div>
        <div class="nav-right col-6 pull-right right-header p-0">
            <ul class="nav-menus">

                <li class="language-nav">
                    <div class="translate_wrapper">
                        <div class="more_lang">
                            <div class="lang selected" data-value="en"><i class="flag-icon flag-icon-us"></i><span
                                    class="lang-txt">English<span> (US)</span></span></div>
                            <div class="lang" data-value="de"><i class="flag-icon flag-icon-de"></i><span
                                    class="lang-txt">Deutsch</span></div>
                            <div class="lang" data-value="es"><i class="flag-icon flag-icon-es"></i><span
                                    class="lang-txt">Espa&ntilde;ol</span></div>
                            <div class="lang" data-value="fr"><i class="flag-icon flag-icon-fr"></i><span
                                    class="lang-txt">Fran&ccedil;ais</span></div>
                            <div class="lang" data-value="pt"><i class="flag-icon flag-icon-pt"></i><span
                                    class="lang-txt">Portugu&ecirc;s<span> (BR)</span></span></div>
                            <div class="lang" data-value="cn"><i class="flag-icon flag-icon-cn"></i><span
                                    class="lang-txt">&#x7B80;&#x4F53;&#x4E2D;&#x6587;</span></div>
                            <div class="lang" data-value="ae"><i class="flag-icon flag-icon-ae"></i><span
                                    class="lang-txt">&#x644;&#x639;&#x631;&#x628;&#x64A;&#x629; <span>
                                        (ae)</span></span></div>
                        </div>
                    </div>
                </li>
                <li class="profile-nav onhover-dropdown">
                    <div class="account-user"><i data-feather="user"></i></div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li>
                            <?php if(auth()->user()->role_id == 2): ?>
                                <a href="<?php echo e(route('salon.editprofile')); ?>"><i data-feather="user"></i><span>Update
                                        Profile</span></a>
                            <?php endif; ?>
                        </li>
                        <li><a href="<?php echo e(route('logout')); ?>"><i data-feather="log-in"> </i><span>Log out</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <script class="result-template" type="text/x-handlebars-template">
          <div class="ProfileCard u-cf">
          <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
          <div class="ProfileCard-details">
          
          </div>
          </div>
        </script>
        <script class="empty-template"
        type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
    </div>
</div>
<?php /**PATH C:\xampp8.2\htdocs\salon_unitiii\resources\views/layout/header.blade.php ENDPATH**/ ?>