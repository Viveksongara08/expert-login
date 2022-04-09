<?php
$login_page_id = get_option('login_page_id');
$registration_page_id = get_option('registration_page_id');
$forget_page_id = get_option('forget_page_id');

?>
<div class="login-wrap">
    <div class="login-content">
        <div class="login-logo">
            <h1>
                <?php echo get_the_title($registration_page_id); ?>
            </h1>
        </div>
        <div class="login-form">
            <form name="expertregister" id="expertregister" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input class="au-input au-input--full" type="text" name="username" id="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input class="au-input au-input--full" type="email" name="emailaddress" id="emailaddress" placeholder="Email">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="au-input au-input--full" type="password" name="password" id="password" placeholder="Password">
                </div>

                <button class="au-btn au-btn--block au-btn--green m-t-20" type="submit">register</button>
                <?php do_action('expert_registration_form_nonce'); ?>
            </form>
            <div class="register-link">
                <p>
                    Already have account?
                    <a href="<?php echo get_permalink($login_page_id); ?>">Sign In</a>
                </p>
            </div>
            <p id="sucess_box"></p>
        </div>
    </div>
</div>