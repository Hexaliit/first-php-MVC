<?php require_once 'App/Views/inc/header.php'; ?>
    <div class="row justify-content-center">
        <div class="col col-md-4 bg-white border border-dark py-3">
            <h4>Log in</h4>
            <hr>
            <form action="<?php echo ROOT;?>/users/login" method="post">
                <div class="form-group">
                    <label for="lemail">Email<sup>*</sup></label>
                    <input type="text" name="lemail" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ""?>" value="<?php echo $email; ?>">
                    <span class="invalid-feedback"><?php echo $email_err?></span>
                </div>
                <div class="form-group">
                    <label for="lpassword">Password<sup>*</sup></label>
                    <input type="password" name="lpassword" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ""?>" value="<?php echo $password; ?>">
                    <span class="invalid-feedback"><?php echo $password_err?></span>
                </div>
                <input type="submit" class="btn btn-success btn-block" value="log in">
            </form>
        </div>
        <div class="col col-md-4 bg-white border border-dark py-3">
            <h4>register</h4>
            <hr>
            <a href="<?php echo ROOT;?>/users/register" class="btn btn-light border-dark btn-block text-dark">register</a>
        </div>
    </div>


<?php require_once 'App/Views/inc/footer.php'; ?>