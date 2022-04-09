<?php

class ExpertLogin
{

    function __construct()
    {

        add_shortcode('expert_login_form',  [$this, 'expert_login_form_shortcode']);
        add_shortcode('expert_registaration_form', [$this, 'expert_registration_form_shortcode']);
        add_shortcode('expert_frogotpassword_form', [$this, 'expert_frogotpassword_form_shortcode']);
        add_shortcode('expert_resetpassword_form', [$this, 'expert_resetpassword_form_shortcode']);
        add_shortcode('expert_profile_form', [$this, 'expert_profile_form_shortcode']);

        add_action('wp_enqueue_scripts', [$this, 'expert_login_scripts_styles']);

        add_action('expert_login_form_nonce', [$this, 'expert_add_login_form_nonce']);
        add_action('expert_registration_form_nonce', [$this, 'expert_add_registration_form_nonce']);
        add_action('expert_forget_form_nonce', [$this, 'expert_add_forgetpassword_form_nonce']);
        add_action('expert_reset_form_nonce', [$this, 'expert_add_resetpassword_form_nonce']);
        add_action('expert_editprofile_form_nonce', [$this, 'expert_add_editprofile_form_nonc']);


        add_action('expert_after_login', [$this, 'expert_after_login_screen']);



        //add_shortcode( 'auth_add_deals_form', [$this,'auth_add_deals_form_shortcode'] );
        //add_shortcode( 'auth_edit_deals_form', [$this,'auth_edit_deals_form_shortcode'] );
        //add_shortcode( 'auth_deal_listing', [$this,'auth_deal_listing_shortcode'] );


    }

    // ********* // Add nonce // ******** //
    function expert_add_login_form_nonce()
    {

        $nonce = wp_create_nonce("expert_login_nonce");
?>
        <input type="hidden" name="nonce" id="nonce" value="<?php echo $nonce; ?>" />
    <?php
    }

    function expert_add_registration_form_nonce()
    {

        $nonce = wp_create_nonce("expert_registration_nonce");
    ?>
        <input type="hidden" name="nonce" id="nonce" value="<?php echo $nonce; ?>" />
    <?php
    }


    function expert_add_forgetpassword_form_nonce()
    {

        $nonce = wp_create_nonce("expert_forgetpassword_nonce");
    ?>
        <input type="hidden" name="nonce" id="nonce" value="<?php echo $nonce; ?>" />
    <?php
    }

    function expert_add_resetpassword_form_nonce()
    {
        $encodedUrl = $_REQUEST["reset"];
        $resetemail = urldecode($encodedUrl);
        $nonce = wp_create_nonce("expert_resetpassword_nonce");
    ?>
        <input type="hidden" name="nonce" id="nonce" value="<?php echo $nonce; ?>" />
        <input type="hidden" name="resetemail" id="resetemail" value="<?php echo $resetemail; ?>" />
    <?php

    }

    function expert_add_editprofile_form_nonc()
    {

        $nonce = wp_create_nonce("expert_editprofile_nonce");
    ?>
        <input type="hidden" name="nonce" id="nonce" value="<?php echo $nonce; ?>" />
    <?php

    }




    // ********* // Login Shortcode [expert_login_form] // ******** //
    function expert_login_form_shortcode()
    {
        ob_start();
        global $post;
        if (!is_user_logged_in()) {
            include('templates/login.php');
        } else {
            do_action('expert_after_login');
        }

        return ob_get_clean();
    }

    // ********* // Registration Shortcode [expert_registaration_form] // ******** //
    function expert_registration_form_shortcode()
    {
        ob_start();
        global $post;
        if (!is_user_logged_in()) {
            include('templates/registration.php');
        } else {
            do_action('expert_after_login');
        }
        return ob_get_clean();
    }


    // ********* // Frogotpassword Shortcode [expert_frogotpassword_form] // ******** //
    function expert_frogotpassword_form_shortcode()
    {
        ob_start();
        global $post;
        if (!is_user_logged_in()) {
            include('templates/frogotpassword.php');
        } else {
            do_action('expert_after_login');
        }
        return ob_get_clean();
    }


    // ********* // Resetpassword Shortcode [expert_resetpassword_form] // ******** //
    function expert_resetpassword_form_shortcode()
    {
        ob_start();
        global $post;
        if (!is_user_logged_in()) {
            include('templates/resetpassword.php');
        } else {
            do_action('expert_after_login');
        }
        return ob_get_clean();
    }


    // ********* // Profile Shortcode [expert_profile_form] // ******** //
    function expert_profile_form_shortcode()
    {
        ob_start();
        global $post;
        if (is_user_logged_in()) {
            include('templates/profile.php');
        }
        return ob_get_clean();
    }


    // ********* // Adddeal Shortcode [expert_add_deals_form] // ******** //

    function expert_add_deals_form_shortcode()
    {
        ob_start();
        global $post;

        include('templates/add_deals.php');
        return ob_get_clean();
    }



    // ********* // Editdeal Shortcode [expert_edit_deals_form] // ******** //

    function expert_edit_deals_form_shortcode()
    {
        ob_start();
        global $post;

        include('templates/edit_deals.php');
        return ob_get_clean();
    }


    // ********* // Deallisting Shortcode [expert_deal_listing] // ******** //

    function expert_deal_listing_shortcode()
    {
        ob_start();
        global $post;

        include('templates/deal_listing.php');
        return ob_get_clean();
    }

    function expert_login_scripts_styles()
    {
        //  Add css
        wp_enqueue_style('theme', plugins_url('/css/theme.css', __FILE__), false, '1.0.0', 'all');
    }

    function expert_after_login_screen()
    {
        $userid = get_current_user_id();
        $UserData = get_userdata($userid);


    ?>
        <p>Hello , <?php echo $UserData->display_name; ?> </p>
        <a href="<?php echo wp_logout_url(site_url()); ?>"> LOG OUT </a>
<?php
    }
}

$obj = new ExpertLogin();
