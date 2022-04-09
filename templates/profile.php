<?php 
$profile_page_id=get_option('profile_page_id');
$current_id=get_current_user_id();
$userdata=get_userdata($current_id );

$fname = get_user_meta($current_id, 'first_name', true);
$lname = get_user_meta($current_id, 'last_name', true);
$description = get_user_meta($current_id, 'description', true);
$email=$userdata->user_email; 
$username=$userdata->user_login; 

/* $avatar_id = get_user_meta($current_id, 'wp_user_avatar', true);
$imagelink =get_post_meta ( $avatar_id, $key = '_wp_attached_file', $single = false );
 */
?>

	    <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                           <h1>
                                <?php echo get_the_title($profile_page_id); ?>
                            </h1>
                        </div>
                        <div class="login-form">
									<form action="#" method="post" id="editprofile" name="editprofile" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="userName"> User Name</label>
                                            <input type="text" readonly  class="au-input au-input--full" id="username"  name="username" value="<?php echo $username; ?>" >
                                        </div>
										<div class="form-group">
                                            <label for="firstname"> First Name</label>
                                            <input type="text"   class="au-input au-input--full" id="firstname"  name="firstname" value="<?php echo $fname; ?>" >
                                        </div>
										<div class="form-group">
                                            <label for="firstname"> Last Name</label>
                                            <input type="text"   class="au-input au-input--full" id="lastname"  name="lastname" value="<?php echo $lname; ?>" >
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="userName">Email Address</label>
                                            <input type="email"  id="email" name="email" class="au-input au-input--full" value="<?php echo $email; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">Description</label>
                                            <Textarea type="text" name="description" id="description"  value="" class="au-input au-input--full" ><?php echo $description; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">Password</label>
                                            <input type="password"  class="au-input au-input--full" id="password" name="password">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">Confirm Password</label>
                                            <input type="password"  class="au-input au-input--full" id="confirm_password" name="confirm_password">
                                        </div>
                                       
                                        <div class="form-group m-t-0">
                                            <button class="au-btn au-btn--block au-btn--green m-t-10" type="submit">Update Profile</button>
                                        </div>
										<?php echo do_action('expert_editprofile_form_nonce'); ?>
										
                                    </form>
									
<p id="sucess_box" ></p>
                                </div>
                            </div>
                        </div>

