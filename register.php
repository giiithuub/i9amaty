<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('includes/header.php');
include('config/dbcon.php');

// Set the link for index.php with the current parameters
$link = "http://" . $_SERVER['SERVER_NAME'] . '/UniStay';

?>

<style>
.p_star input.form-control {
    width: 100%;
}
</style>

<!-- Breadcrumb part start -->
<section class="breadcrumb_part" style="height : 10rem;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <h2 class="text-center">Create an Account</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb part end -->

<!-- Register Part Area -->
<section class="login_part pb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card py-4 px-5" style="box-shadow: 0 0 10px rgba(0,0,0,0.1); margin-top: -1rem;">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Registration Form</h3>
                        <?php if(isset($_SESSION['message'])): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION['message']; ?>
                            </div>
                            <?php unset($_SESSION['message']); ?>
                        <?php endif; ?>
                        <form class="contact_form" action="functions/authcode.php" method="post" novalidate="novalidate">
                            <div class="form-group p_star">
                                <label class="form-label" style="color: #4B3049;">Full Name</label>
                                <input type="text" class="form-control input-wide" id="name" name="name" value="" placeholder="Enter your username" required>
                            </div>
                            <div class="form-group p_star">
                                <label class="form-label" style="color: #4B3049;">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="" placeholder="Enter your phone number" required maxlength="10">
                                <small class="text-danger" id="phone-error" style="display: none;">Please enter a valid 10-digit phone number.</small>

                            </div>
                            <div class="form-group ">
                                <label class="form-label" style="color: #4B3049;">Email</label>
                                <input type="email" class="form-control input-wide" id="email" name="email" value="" placeholder="Enter your email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                                <small class="text-danger" id="email-error" style="display: none;">Please enter a valid email address.</small>
                            </div>
                            <div class="form-group p_star">
                                <label class="form-label" style="color: #4B3049;">Password</label>
                                <input type="password" class="form-control input-wide" id="password" name="password" value="" placeholder="Enter your password" required minlength="6">
                                <small class="text-danger" id="password-error" style="display: none;">Password must be at least 6 characters.</small>
                            </div>
                            <div class="form-group p_star">
                                <label class="form-label" style="color: #4B3049;">Confirm Password</label>
                                <input type="password" class="form-control input-wide" id="cpassword" name="cpassword" value="" placeholder="Confirm your password" required minlength="6">
                                <small class="text-danger" id="cpassword-error" style="display: none;">Passwords do not match.</small>
                            </div>
                            <div class="form-group">
                                <button type="submit" value="submit" class="btn_3 btn-block" name="register_btn">Register</button>
                                <p class="text-center mt-3">Already have an account? <a href="login.php" >Log in</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Register Part end -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    var emailInput = $('#email');
    var emailError = $('#email-error');
    var passwordInput = $('#password');
    var passwordError = $('#password-error');
    var cpasswordInput = $('#cpassword');
    var cpasswordError = $('#cpassword-error');
    var phoneInput = $('#phone');
    var phoneError = $('#phone-error');

    phoneInput.on('input', function() {
        var phone = phoneInput.val();

        if (validatePhone(phone)) {
            phoneError.hide();
        } else {
            phoneError.show();
        }
    });

    function validatePhone(phone) {
        var pattern = /^\d{10}$/;
        return pattern.test(phone);
    }

    emailInput.on('input', function() {
        var email = emailInput.val();

        if (validateEmail(email)) {
            emailError.hide();
        } else {
            emailError.show();
        }
    });

    passwordInput.on('input', function() {
        var password = passwordInput.val();

        if (password.length >= 6) {
            passwordError.hide();
        } else {
            passwordError.show();
        }
    });

    cpasswordInput.on('input', function() {
        var password = passwordInput.val();
        var cpassword = cpasswordInput.val();

        if (password === cpassword) {
            cpasswordError.hide();
        } else {
            cpasswordError.text('Passwords do not match.').show();
        }
    });

    function validateEmail(email) {
        // Email validation regex pattern
        var pattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;
        return pattern.test(email);
    }
});
</script>

<?php include('includes/footer.php'); ?>

