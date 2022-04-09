<?php
$login_page_id = get_option('login_page_id');
$registration_page_id = get_option('registration_page_id');
$forget_page_id = get_option('forget_page_id');

?>
<div class="login-wrap">
    <div class="login-content">
        <div class="login-logo">
            <h1>
                <?php echo get_the_title($login_page_id); ?>
            </h1>
        </div>
        <div class="login-form">
            <form name="expertloginform" id="expertloginform" action="" method="">
                <div class="form-group">
                    <label>User Name | Email Address</label>
                    <input class="au-input au-input--full" type="text" name="cusername" id="cusername" placeholder="User Name | Email Address">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="au-input au-input--full" type="password" name="cpassword" id="cpassword" placeholder="Password">
                </div>
                <div class="login-checkbox m-t-20 ">
                    <label>
                        <input type="checkbox" name="remember">Remember Me
                    </label>
                    <label>
                        <a href="<?php echo get_permalink($forget_page_id); ?>">Forgotten Password?</a>
                    </label>
                </div>
                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                <?php do_action('expert_login_form_nonce'); ?>
            </form>
            <div class="register-link">
                <p>
                    Don't you have account?
                    <a href="<?php echo get_permalink($registration_page_id); ?>">Sign Up Here</a>
                </p>
            </div>
            <p id="sucess_box"></p>
        </div>
    </div>
</div>