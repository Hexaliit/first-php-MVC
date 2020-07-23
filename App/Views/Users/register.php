<?php require_once 'App/Views/inc/header.php'; ?>

<p>Register</p>

<div class="row justify-content-center">
    <div class="col-12 col-md-5 bg-white border pb-2">
        <?php flash('register_success'); ?>
        <h2>Register</h2>
        <p>Please fill out this form</p>
        <form action="<?php echo ROOT;?>/users/register" method="post">
            <div class="form-group">
                <label for="email">email<sup>*</sup></label>
                <input name="email" type="text" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : "";?>" value="<?php echo $email;?>">
                <span class="invalid-feedback"><?php echo $email_err;?></span>
            </div>
            <div class="form-group">
                <label for="phone">phone<sup>*</sup></label>
                <input  name="phone" type="text" class="form-control <?php echo (!empty($phone_err)) ? 'is-invalid' : "";?>" value="<?php echo $phone;?>">
                <span class="invalid-feedback"><?php echo $phone_err;?></span>
            </div>
            <div class="form-group">
                <label for="password">password<sup>*</sup></label>
                <input name="password" type="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : "";?>" value="<?php echo $password;?>">
                <span class="invalid-feedback"><?php echo $password_err;?></span>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password<sup>*</sup></label>
                <input name="confirm_password" type="password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : "";?>" value="<?php echo $confirm_password;?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err;?></span>
            </div>
            <input type="submit" class="btn btn-success btn-block" value="Register">
        </form>
    </div>
    <div class="col-12 col-md-3 bg-white border-dark h-25 py-3">
        <p>You are already registered?</p>
        <hr>
        <a href="<?php echo ROOT;?>/users/login" class="btn btn-light btn-block text-dark border-dark">Login</a>
    </div>
</div>

<?php require_once 'App/Views/inc/footer.php'; ?>