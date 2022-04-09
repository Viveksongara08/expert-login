<?php
$login_page_id = get_option('login_page_id');
$registration_page_id = get_option('registration_page_id');
$forget_page_id = get_option('forget_page_id');

?>
<div class="login-wrap">
    <div class="login-content">
        <div class="login-logo">
            <h1>
                <?php echo get_the_title($forget_page_id); ?>
            </h1>
        </div>
        <div class="login-form">
            <form name="expertforgetpassword" id="expertforgetpassword" action="" method="">
                <div class="form-group">
                    <label>Email Address</label>
                    <input class="au-input au-input--full" type="text" name="forgetemail" id="forgetemail" placeholder="Email Address">
                </div>

                <button class="au-btn au-btn--block au-btn--green m-t-20" type="submit">Forgat Password</button>
                <?php do_action('expert_forget_form_nonce'); ?>
            </form>
            <div class="register-link">
                <p>
                    Back to
                    <a href="<?php echo get_permalink($login_page_id); ?>">Log in </a>
                </p>
            </div>
            <p id="sucess_box"></p>
        </div>
    </div>
</div>