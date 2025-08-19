<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/payment.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Payment Card -->
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-4">
                        <!-- Booking Summary -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card bg-light border-0 rounded-3">
                                    <div class="card-body p-4">
                                        <h5 class="fw-bold mb-3 text-primary">
                                            <i class="fas fa-calendar-check me-2"></i>
                                            Booking Details
                                        </h5>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-start">
                                                    <i class="fas fa-cogs text-muted me-2 mt-1"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Service</small>
                                                        <span class="fw-semibold text-dark"><?php echo e($service->name); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-start">
                                                    <i class="fas fa-calendar text-muted me-2 mt-1"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Date</small>
                                                        <span
                                                            class="fw-semibold text-dark"><?php echo e(\Carbon\Carbon::parse($booking['date'])->format('D, M j, Y')); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-start">
                                                    <i class="fas fa-clock text-muted me-2 mt-1"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Time Slot</small>
                                                        <span class="fw-semibold text-dark"><?php echo e($booking['slot_start']); ?> -
                                                            <?php echo e($booking['slot_end']); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-start">
                                                    <div>
                                                        <small class="text-muted d-block">Total Amount</small>
                                                        <span
                                                            class="fw-bold text-success fs-5">₹<?php echo e(number_format($service->price, 2)); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form id="paymentForm" action="" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="mb-4">
                                <h5 class="fw-bold mb-3 text-dark">
                                    <i class="fas fa-wallet me-2 text-primary"></i>
                                    Select Payment Method
                                </h5>

                                <div class="payment-methods">
                                    <div class="row g-3">
                                        <?php $__currentLoopData = $paymentTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-4 col-sm-6">
                                                <input type="radio" name="payment_method" id="method<?php echo e($method->id); ?>"
                                                    value="<?php echo e($method->name); ?>" class="d-none payment-method-radio"
                                                    <?php echo e($loop->first ? 'checked' : ''); ?>>
                                                <label for="method<?php echo e($method->id); ?>"
                                                    class="payment-method-card w-100 h-100 d-flex flex-column align-items-center justify-content-center text-decoration-none">

                                                    <div class="svg-icon">
                                                        <?php echo $method->logo_svg; ?>

                                                    </div>

                                                    <style>
                                                        .svg-icon svg {
                                                            width: 70px;
                                                            height: auto;
                                                        }
                                                    </style>

                                                </label>
                                                <div class="method-name fw-semibold text-center"><?php echo e($method->name); ?></div>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 mt-5">
                                <div id="paymentDetails">
                                    <div class="payment-detail upi-details">
                                        <div class="card border-0 bg-light rounded-3">
                                            <div class="card-body p-4">
                                                <h6 class="fw-bold mb-3 text-primary">
                                                    <i class="fab fa-google-pay me-2"></i>
                                                    UPI Payment Details
                                                </h6>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control form-control-lg"
                                                                id="upi_id" name="upi_id" placeholder="yourname@upi">
                                                            <label for="upi_id">
                                                                <i class="fas fa-at me-1"></i>
                                                                UPI ID
                                                            </label>
                                                        </div>
                                                        <small class="text-muted">
                                                            <i class="fas fa-info-circle me-1"></i>
                                                            Enter your UPI ID (e.g., yourname@paytm, yourname@gpay)
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>

                            <div class="row g-3 mt-5">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success btn-lg w-100 py-3 rounded-3 fw-bold">
                                        <i class="fas fa-check-circle me-2"></i>
                                        Confirm Payment ₹<?php echo e(number_format($service->price, 2)); ?>

                                    </button>
                                </div>
                                <div class="col-12">
                                    <a href="<?php echo e(route('appointments')); ?>" class="btn btn-outline-secondary btn-lg w-100 py-2 rounded-3">
                                        <i class="fas fa-arrow-left me-2"></i>
                                        Back to Booking
                                    </a>
                                </div>
                            </div>

                            <div class="mt-4 p-3 bg-light rounded-3 border">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <i class="fas fa-shield-check fa-2x text-success"></i>
                                    </div>
                                    <div class="col">
                                        <h6 class="mb-1 fw-bold">Secure Payment</h6>
                                        <small class="text-muted">Your payment information is protected with
                                            industry-standard encryption</small>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .payment-method-card {
            display: block;
            padding: 1.5rem 1rem;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
            min-height: 100px;
            position: relative;
            overflow: hidden;
        }

        .payment-method-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.05) 0%, rgba(13, 110, 253, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .payment-method-card:hover {
            border-color: #0d6efd;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.2);
        }

        .payment-method-card:hover::before {
            opacity: 1;
        }

        .payment-method-radio:checked+.payment-method-card {
            border-color: #0d6efd;
            background: linear-gradient(135deg, #e7f1ff 0%, #f8fbff 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.25);
        }

        .payment-method-radio:checked+.payment-method-card::after {
            content: '\f00c';
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            top: 8px;
            right: 12px;
            color: #0d6efd;
            font-size: 14px;
        }

        .method-icon {
            margin-bottom: 0.5rem;
            color: #0d6efd;
            position: relative;
            z-index: 1;
        }

        .method-icon svg,
        .method-icon img {
            max-width: 32px;
            max-height: 32px;
        }

        .method-name {
            font-weight: 600;
            color: #495057;
            font-size: 0.9rem;
            position: relative;
            z-index: 1;
        }

        /* Enhanced Payment Details Section */
        .payment-detail {
            transition: all 0.3s ease;
        }

        .form-floating>.form-control:focus~label,
        .form-floating>.form-control:not(:placeholder-shown)~label {
            color: #0d6efd;
        }

        .form-floating>.form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        /* Button Enhancements */
        .btn-success {
            background: linear-gradient(135deg, #198754 0%, #20c997 100%);
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn-success::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-success:hover::before {
            left: 100%;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(25, 135, 84, 0.3);
        }

        .btn-outline-secondary {
            border: 2px solid #6c757d;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(108, 117, 125, 0.2);
        }

        /* Card Enhancements */
        .card {
            transition: all 0.3s ease;
        }

        .rounded-top-4 {
            border-top-left-radius: 1.5rem !important;
            border-top-right-radius: 1.5rem !important;
        }

        .rounded-4 {
            border-radius: 1.5rem !important;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .payment-method-card {
                padding: 1rem 0.75rem;
                min-height: 85px;
            }

            .method-name {
                font-size: 0.85rem;
            }

            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }

        @media (max-width: 576px) {
            .payment-method-card {
                min-height: 75px;
                padding: 0.75rem 0.5rem;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function() {
                    $('.payment-method-radio').change(function() {
                        const methodName = $(this).val();
                        $('.payment-detail').addClass('d-none');
                        if (methodName.toLowerCase() === 'gpay') {
                            $('.upi-details').removeClass('d-none');
                        } else {
                            $('.card-details').removeClass('d-none');
                        }
                    });

                    $('#paymentForm').submit(function(e) {
                        e.preventDefault();

                        const form = $(this);
                        const submitBtn = form.find('[type="submit"]');
                        const originalText = submitBtn.html();

                        submitBtn.prop('disabled', true)
                            .html('<i class="fas fa-spinner fa-spin me-2"></i> Processing Payment...');

                        $.ajax({
                            url: "<?php echo e(route('payments.bookings.create')); ?>",
                            method: "POST",
                            data: form.serialize(),
                            success: function(response) {
                                if (response.status == 200) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Payment Successful!',
                                        text: response.message,
                                        confirmButtonColor: '#198754'
                                    }).then(() => {
                                        window.location.href = "<?php echo e(route('appointments')); ?>";
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Payment Failed',
                                        text: response.message ||
                                            'Something went wrong, Please try again.'
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Server Error',
                                    text: xhr.responseJSON?.message ||
                                        'Unable to process payment'
                                });
                            },
                            complete: function() {
                                submitBtn.prop('disabled', false).html(originalText);
                            }
                        });

                        // Card number formatting
                        $('#card_number').on('input', function() {
                            let value = $(this).val().replace(/\s/g, '');
                            let formattedValue = value.replace(/(.{4})/g, '$1 ').trim();
                            $(this).val(formattedValue);
                        });

                        // Expiry date formatting
                        $('#expiry').on('input', function() {
                            let value = $(this).val().replace(/\D/g, '');
                            if (value.length >= 2) {
                                value = value.substring(0, 2) + '/' + value.substring(2, 4);
                            }
                            $(this).val(value);
                        });

                        // CVV restriction
                        $('#cvv').on('input', function() {
                            $(this).val($(this).val().replace(/\D/g, ''));
                        });
                    });
                });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp8.2\htdocs\salon_unitiii\resources\views/payment_bookings.blade.php ENDPATH**/ ?>