<!--font-awesome css-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/font-awesome.css') }}">

<!-- ico-font-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/icofont.css') }}">

<!-- Themify icon-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">

<!-- Flag icon-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/flag-icon.css') }}">

<!-- Feather icon-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">

<!--scrollbar css-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">

<!-- SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">



<!-- include css plugins-->
@yield('css')
<!--end include css plugins-->

<!-- Bootstrap css-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">

<!-- App css-->
@vite(['public/assets/scss/style.scss','resources/js/app.js']);

<link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">

<!-- Responsive css-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
