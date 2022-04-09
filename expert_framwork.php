<?php

add_action('init', 'script_enqueuer');

function script_enqueuer()
{


    // Register the JS file with a unique handle, file location, and an array of dependencies
    wp_register_script("custom-js", plugins_url('/js/custom.js', __FILE__), array('jquery'));

    // localize the script to your domain name, so that you can reference the url to admin-ajax.php file easily
    wp_localize_script('custom-js', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php')));

    // enqueue jQuery library and the script you registered above
    wp_enqueue_script('jquery');
    wp_enqueue_script('custom-js');
}



// define the actions for the two hooks created, first for logged in users and the next for logged out users
//add_action("wp_ajax_expert_login", "expert_login");
add_action("wp_ajax_nopriv_expert_login", "expert_login");


// define the function to be fired for logged in users
// function expert_login()
// {

//     echo "Your alrady login in.";
//     die();
// }

// define the function for login
function expert_login()
{
    //check_ajax_referer( 'ajax-login-nonce', 'security' );
    $loginurl = get_option('expert_after_login_redirect_url');
    if (!wp_verify_nonce($_REQUEST['nonce'], "expert_login_nonce")) {
        exit("Woof Woof Woof");
    }
    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = sanitize_text_field(trim($_REQUEST["cusername"]));
    $info['user_password'] = sanitize_text_field(trim($_REQUEST["cpassword"]));
    $info['remember'] = true;

    $user_signon = wp_signon($info, false);
    if (is_wp_error($user_signon)) {
        echo json_encode(array('loggedin' => false, 'message' => __('Wrong username or password.')));
    } else {
        echo json_encode(array('loggedin' => true, 'message' => __('Login successful, redirecting...'), 'url' => $loginurl));
    }

    die();
}

// Define the function function for registration
add_action("wp_ajax_nopriv_expert_registration", "expert_registration");


function expert_registration()
{

    if (!wp_verify_nonce($_REQUEST['nonce'], "expert_registration_nonce")) {
        exit("Woof Woof Woof");
    }

    $username = sanitize_text_field(trim($_POST['username']));
    $emailaddress = sanitize_text_field(trim($_POST['emailaddress']));
    $password = sanitize_text_field(trim($_POST['password']));

    $user_roal = "subscriber";


    if (username_exists($username)) {

        echo json_encode(array('registerin' => false, 'message' => __('Username already exist.')));
    } else {
        if ($emailaddress == "" || $password == "" ||  $username == "" || $password == "") {

            echo json_encode(array('registerin' => false, 'message' => __('Please don\'t leave the required fields.')));
        } else if (!filter_var($emailaddress, FILTER_VALIDATE_EMAIL)) {

            echo json_encode(array('registerin' => false, 'message' => __('Invalid email address.')));
        } else if (email_exists($emailaddress)) {

            echo json_encode(array('registerin' => false, 'message' => __('Email already exist.')));
        } else {
            $user_id = wp_insert_user(array('first_name' => apply_filters('pre_user_first_name', $username), 'user_pass' => apply_filters('pre_user_user_pass', $password), 'user_login' => apply_filters('pre_user_user_login', $username), 'user_email' => apply_filters('pre_user_user_email', $emailaddress), 'role' => $user_roal));

            if (is_wp_error($user_id)) {
                if (!empty($user_id->errors["existing_user_login"][0])) {
                    $error = $user_id->errors["existing_user_login"][0];
                    echo json_encode(array('registerin' => false, 'message' => $error));
                } else {

                    echo json_encode(array('registerin' => false, 'message' => __('Error on user creation.')));
                }
            } else {


                $login_data['user_login'] = $username;
                $login_data['user_password'] = $password;
                $user_verify = wp_signon($login_data, false);
                $registerurl = get_option('expert_after_regsitration_redirect_url');
                if (is_wp_error($user_verify)) {

                    $subject = __('Regisatration', 'expertlogin');
                    $headers = array('Content-Type: text/html; charset=UTF-8');
                    $content = "Your account create scuessfully you can login now.";

                    $status = wp_mail($forgetemail, $subject, $content, $headers);

                    echo json_encode(array('registerin' => false, 'message' => __('Wrong username or password.')));
                } else {
                    echo json_encode(array('registerin' => true, 'message' => __('Account successfully created. redirecting...'), 'url' => $registerurl));
                }
                die();
            }
        }
    }
}

// Define function for forgat password
add_action("wp_ajax_nopriv_expert_forgetpassword", "expert_forgetpassword");
function expert_forgetpassword()
{

    if (!wp_verify_nonce($_REQUEST['nonce'], "expert_forgetpassword_nonce")) {
        exit("Woof Woof Woof");
    }

    $forgetemail = sanitize_text_field(trim($_POST['forgetemail']));

    if (email_exists($forgetemail)) {

        $reset_page_id = get_option('reset_page_id');
        $token =  random_str(32);
        $encodedUrl = urlencode($forgetemail);
        $url = get_permalink($reset_page_id) . "?token=" . $token . "&reset=" . $encodedUrl;

        $subject = __('Forget Password', 'expertlogin');
        $headers = array('Content-Type: text/html; charset=UTF-8');
        $content = "Reset Password Link Below.<br/>" . $url;

        $status = wp_mail($forgetemail, $subject, $content, $headers);
        if ($status) {
            echo json_encode(array('forgetin' => true, 'message' => __('Please check your email address.'), 'url' => home_url()));
        } else {
            echo json_encode(array('forgetin' => false, 'message' => __('Somthing was wrong.')));
        }
    } else {
        echo json_encode(array('forgetin' => false, 'message' => __('Enter Valid Email Address !')));
    }
    die();
}

// Define function for forgat password
add_action("wp_ajax_nopriv_expert_resetpassword", "expert_resetpassword");
function expert_resetpassword()
{
    if (!wp_verify_nonce($_REQUEST['nonce'], "expert_resetpassword_nonce")) {
        exit("Woof Woof Woof");
    }
    $password = sanitize_text_field(trim($_POST['password']));
    $resetemail = sanitize_text_field(trim($_POST['resetemail']));

    if ($password != "" and  $resetemail != "") {

        $user = get_user_by('email', $resetemail);


        $update_user = wp_update_user(
            array(
                'ID' => $user->ID,
                'user_pass' => $password
            )
        );
        $subject = __('Reset Password', 'expertlogin');
        $headers = array('Content-Type: text/html; charset=UTF-8');
        $content = "Reset Password .<br/> Password : " . $password;

        $status = wp_mail($forgetemail, $subject, $content, $headers);
        echo json_encode(array('resetin' => true, 'message' => __('Reset your password.'), 'url' => home_url()));
    } else {
        echo json_encode(array('resetin' => false, 'message' => __('Somthing was wrong.')));
    }
    die();
}

// Define function for edit profile
add_action("wp_ajax_expert_editprofile", "expert_editprofile");
//add_action("wp_ajax_nopriv_expert_editprofile", "expert_editprofile");
function expert_editprofile()
{
    $user_id = get_current_user_id();
    $username = sanitize_text_field(trim($_POST['username']));
    $firstname = sanitize_text_field(trim($_POST['firstname']));
    $lastname = sanitize_text_field(trim($_POST['lastname']));
    $email = sanitize_text_field(trim($_POST['email']));
    $description = sanitize_text_field(trim($_POST['description']));
    $password = sanitize_text_field(trim($_POST['password']));

    if ($email == "" ||  $username == "") {

        echo json_encode(array('profilein' => false, 'message' => __('Please don\'t leave the required fields.')));
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        echo json_encode(array('profilein' => false, 'message' => __('Invalid email address.')));
    } else {
        if (!empty($password1)) {
            $user_data =  wp_update_user(array(
                'ID' => $user_id,
                'user_email' => $email,
                'user_pass' => $password1
            ));
        } else {

            $user_data =  wp_update_user(array(
                'ID' => $user_id,
                'user_email' => $email
            ));
        }
        update_user_meta($user_id, 'first_name', $firstname);
        update_user_meta($user_id, 'last_name', $lastname);
        update_user_meta($user_id, 'description', $description);
        echo json_encode(array('profilein' => true, 'message' => __('Update your profile.'), 'url' => ''));
    }
    die();
}
