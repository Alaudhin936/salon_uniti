<?php $__env->startSection('others_css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('others_content'); ?>
<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-card">
                <div>
                    <div>
                        <a class="logo" href="<?php echo e(route('dashboard')); ?>">
                            <h2>Salon Uniti</h2>
                        </a>
                        <div class="login-main">
                            <form class="theme-form" method="POST" action="<?php echo e(route('verifyOTP')); ?>">
                                <?php echo csrf_field(); ?>


                                <div class="form-group">
                                    <label class="col-form-label">Verify OTP</label>
                                    <input class="form-control" type="text" name="verify_otp"
                                           required autofocus placeholder="****">
                                    <?php $__errorArgs = ['verify_otp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="text-danger"><?php echo e($message); ?></small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-group mb-0">
                                    <div class="text-end mt-3">
                                        <button class="btn btn-primary btn-block w-100" type="submit">Verify OTP</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('others_script'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('others.others_layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp8.2\htdocs\salon_unitiii\resources\views/others/authentication/verify_otp.blade.php ENDPATH**/ ?>