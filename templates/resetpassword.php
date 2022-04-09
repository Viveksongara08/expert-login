<?php
$login_page_id = get_option('login_page_id');
$registration_page_id = get_option('registration_page_id');
$forget_page_id = get_option('forget_page_id');
$reset_page_id = get_option('reset_page_id');


?>
<div class="login-wrap">
    <div class="login-content">
        <div class="login-logo">
            <h1>
                <?php echo get_the_title($reset_page_id); ?>
            </h1>
        </div>
        <div class="login-form">
            <form name="expertresetpassword" id="expertresetpassword" action="" method="">

                <div class="form-group">
                    <label>Password</label>
                    <input class="au-input au-input--full" type="password" name="password" id="password" placeholder="Password">
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input class="au-input au-input--full" type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password">
                </div>

                <button class="au-btn au-btn--block au-btn--green m-t-20" type="submit">Reset Password</button>
                <?php do_action('expert_reset_form_nonce'); ?>
            </form>
            <div class="register-link">
                <p>
                    Back to login
                    <a href="<?php echo get_permalink($login_page_id); ?>">Sign In Here</a>
                </p>
            </div>
            <p id="sucess_box"></p>
        </div>
    </div>
</div>