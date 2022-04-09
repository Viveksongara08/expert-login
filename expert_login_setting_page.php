<?php
global $wpdb, $PasswordHash, $current_user, $user_ID;
global $smof_data;
?>

<section id="ts-working-process" class="ts-working-process">


    <div class="container">

        <div class="row">

            <div class="col-md-12">
                <table class="wp-list-table widefat fixed striped table-view-list posts">
                    <tr>
                        <th>Name</th>
                        <th>Shortcodes</th>
                    </tr>

                    <tr>
                        <td>Login Form</td>
                        <td>[expert_login_form]</td>
                    </tr>

                    <tr>
                        <td>Registration Form</td>
                        <td>[expert_registaration_form]</td>
                    </tr>

                    <tr>
                        <td>Frogotpassword Form</td>
                        <td>[expert_frogotpassword_form]</td>
                    </tr>

                    <tr>
                        <td>Resetpassword Form</td>
                        <td>[expert_resetpassword_form]</td>
                    </tr>

                    <tr>
                        <td>Profile Form</td>
                        <td>[expert_profile_form]</td>
                    </tr>



                </table>

            </div>

        </div>
        <?php
        $loginurl = get_option('expert_after_login_redirect_url');
        $registerurl = get_option('expert_after_regsitration_redirect_url');

        ?>
        <div class="row">
            <div class="col-md-12">
                <?php print "<h1>Expert login setting</h1>"; ?>
                <table class="wp-list-table widefat fixed striped table-view-list posts">
                    <tr>
                        <th>
                            <form name="<?php echo admin_url('admin.php'); ?>" method="post">
                                <input type="hidden" name="page" value="expert-login-setting" />
                                <input value="<?php echo $loginurl; ?>" style="width:100%;padding: 10px;" name="login_url" id="login_url" placeholder="After login redirect url " />
                        </th>
                        <th></th>

                    </tr>
                    <tr>
                        <th>
                            <input value="<?php echo $registerurl; ?>" style="width:100%;padding: 10px;" name="registration_url" id="registration_url" placeholder="After registration redirect url " />
                        </th>
                        <th>

                        </th>


                    </tr>
                    <tr>
                        <th><input style="  padding: 10px;" name="submit" type="submit" value="Save" />
                            </from>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            if (isset($_REQUEST["submit"])) {
                                $login_url =  sanitize_text_field(trim($_REQUEST["login_url"]));
                                $registration_url =  sanitize_text_field(trim($_REQUEST["registration_url"]));

                                update_option('expert_after_login_redirect_url', $login_url);
                                update_option('expert_after_regsitration_redirect_url', $registration_url);

                                echo "Update";
                            }

                            ?>

                        </td>

                        </td>

                </table>
            </div>
</section>