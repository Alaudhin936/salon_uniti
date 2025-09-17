<?php $__env->startSection('others_css'); ?>
<style>
.otp-container {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin: 20px 0;
}

.otp-input {
    width: 60px;
    height: 60px;
    text-align: center;
    font-size: 24px;
    font-weight: bold;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    background-color: #f8f9fa;
    transition: all 0.3s ease;
    outline: none;
}

.otp-input:focus {
    border-color: #007bff;
    background-color: #fff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.otp-input:valid {
    border-color: #28a745;
    background-color: #f8fff9;
}

.success-message {
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
    padding: 12px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    position: relative;
}

.success-message .close-btn {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    font-size: 20px;
    color: #155724;
    cursor: pointer;
    opacity: 0.7;
}

.success-message .close-btn:hover {
    opacity: 1;
}

.verify-otp-title {
    font-size: 32px;
    font-weight: bold;
    color: #333;
    text-align: center;
    margin-bottom: 10px;
}

.otp-subtitle {
    color: #666;
    text-align: center;
    margin-bottom: 30px;
    font-size: 16px;
}

.resend-section {
    text-align: center;
    margin: 20px 0;
    color: #666;
}

.resend-btn {
    color: #007bff;
    text-decoration: none;
    font-weight: 500;
}

.resend-btn:hover {
    text-decoration: underline;
}

.remember-section {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 20px 0;
    color: #666;
}

.remember-checkbox {
    width: 18px;
    height: 18px;
}

.button-group {
    display: flex;
    gap: 15px;
    margin-top: 30px;
}

.btn-back {
    background-color: #ffc107;
    border: none;
    color: #000;
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 500;
    flex: 1;
}

.btn-verify {
    background-color: #343a40;
    border: none;
    color: #fff;
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 500;
    flex: 2;
}

.create-account-section {
    text-align: center;
    margin-top: 20px;
    color: #666;
}

.create-account-btn {
    color: #007bff;
    text-decoration: none;
    font-weight: 500;
}

.hidden-input {
    opacity: 0;
    position: absolute;
    pointer-events: none;
}
</style>
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
                            <!-- Success Message -->
                            <div class="success-message">
                                OTP sent successfully!
                                <button class="close-btn" onclick="this.parentElement.style.display='none'">×</button>
                            </div>

                            <h2 class="verify-otp-title">Verify OTP</h2>
                            <p class="otp-subtitle">Enter the 4-digit code sent to you</p>

                            <form class="theme-form" method="POST" action="<?php echo e(route('verifyOTP')); ?>" id="otpForm">
                                <?php echo csrf_field(); ?>

                                <div class="otp-container">
                                    <input type="text" class="otp-input" maxlength="1" data-index="0">
                                    <input type="text" class="otp-input" maxlength="1" data-index="1">
                                    <input type="text" class="otp-input" maxlength="1" data-index="2">
                                    <input type="text" class="otp-input" maxlength="1" data-index="3">
                                </div>

                                <!-- Hidden input for form submission -->
                                <input type="hidden" name="verify_otp" id="hiddenOtpInput" required>

                                <?php $__errorArgs = ['verify_otp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-center">
                                        <small class="text-danger"><?php echo e($message); ?></small>
                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                <div class="resend-section">
                                    Didn't receive the code? <a href="#" class="resend-btn">Resend OTP</a> <span>(28s)</span>
                                </div>


                                <div class="button-group">
                                    
                                    <button type="submit" class="btn btn-primary btn-verify">Verify & Sign In</button>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const otpInputs = document.querySelectorAll('.otp-input');
    const hiddenInput = document.getElementById('hiddenOtpInput');
    const form = document.getElementById('otpForm');

    // Function to update hidden input
    function updateHiddenInput() {
        let otpValue = '';
        otpInputs.forEach(input => {
            otpValue += input.value;
        });
        hiddenInput.value = otpValue;
    }

    // Handle input events
    otpInputs.forEach((input, index) => {
        input.addEventListener('input', function(e) {
            const value = e.target.value;

            // Only allow numbers
            if (!/^\d*$/.test(value)) {
                e.target.value = '';
                return;
            }

            // Move to next input if current is filled
            if (value && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }

            updateHiddenInput();
        });

        // Handle backspace
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && !e.target.value && index > 0) {
                otpInputs[index - 1].focus();
            }
        });

        // Handle paste
        input.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedData = e.clipboardData.getData('text').slice(0, 4);

            if (!/^\d+$/.test(pastedData)) return;

            for (let i = 0; i < pastedData.length && i < 4; i++) {
                if (otpInputs[i]) {
                    otpInputs[i].value = pastedData[i];
                }
            }

            updateHiddenInput();

            // Focus the next empty input or the last one
            const nextIndex = Math.min(pastedData.length, 3);
            otpInputs[nextIndex].focus();
        });
    });

    // Auto-submit when all 4 digits are entered
    function checkAutoSubmit() {
        const allFilled = Array.from(otpInputs).every(input => input.value !== '');
        if (allFilled) {
            // Optional: Auto-submit after a short delay
            setTimeout(() => {
                form.submit();
            }, 500);
        }
    }

    otpInputs.forEach(input => {
        input.addEventListener('input', checkAutoSubmit);
    });

    // Handle form submission
    form.addEventListener('submit', function(e) {
        updateHiddenInput();
        if (hiddenInput.value.length !== 4) {
            e.preventDefault();
            alert('Please enter the complete 4-digit OTP');
            return false;
        }
    });

    // Resend OTP countdown (example)
    let countdown = 28;
    const resendBtn = document.querySelector('.resend-btn');
    const countdownSpan = resendBtn.nextElementSibling;

    const timer = setInterval(() => {
        countdown--;
        if (countdown > 0) {
            countdownSpan.textContent = `(${countdown}s)`;
        } else {
            countdownSpan.textContent = '';
            resendBtn.style.pointerEvents = 'auto';
            resendBtn.style.opacity = '1';
            clearInterval(timer);
        }
    }, 1000);
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('others.others_layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp8.2\htdocs\salon_unitiii\resources\views/others/authentication/verify_otp.blade.php ENDPATH**/ ?>