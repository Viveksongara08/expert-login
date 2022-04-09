<?php

/**
 * Expert Login plugin for use for theme options
 * Take this as a base plugin and modify as per your need.
 *
 * @package Expert Login
 * @author vivek songara
 * @license GPL-2.0+
 * @link http://expertwebinfotech.com
 * @copyright 2022 Vivek songara, LLC. All rights reserved.
 *
 *            @wordpress-plugin
 *            Plugin Name: Expert Login
 *            Plugin URI: http://expertwebinfotech.com
 *            Description: Expert Login Plugin
 *            Version: 1.1
 *            Author: Vivek Songara
 *            Author URI: 
 *            Text Domain: Expert Login
 *            Contributors: Vivek Songara
 *            License: GPL-2.0+
 *            License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

/**
 * Adding Album Gallery Setting Menu
 *
 * @since 1.0
 */


if (!defined('ABSPATH')) exit;
//************************************//

define('EXPERT_LOGIN_VERSION', '0.1');
define('METADATA_VERSION', '0.1');

require_once('expert_shortcode.php');
require_once('expert_framwork.php');

//*****************


class Setting
{

    public function expert_login_action_links($links)
    {
        $expert_login_settings_link = '<a href="' . admin_url('admin.php?page=expert-login-setting') . '">' . translate('Settings') . '</a>';
        array_unshift($links, $expert_login_settings_link);
        return $links;
    }

    function expert_login_plugin_activation()
    {
        if (!current_user_can('activate_plugins')) return;

        global $wpdb;

        //*************// create login page //*************//  

        if (null === $wpdb->get_row("SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'login'", 'ARRAY_A')) {
            $current_user = wp_get_current_user();

            // create post object
            $page = array(
                'post_title'  => __('Login'),
                'post_content'  => '[expert_login_form]',
                'post_status' => 'publish',
                'post_author' => $current_user->ID,
                'post_type'   => 'page',

            );
            $login_page_id = wp_insert_post($page);
            update_option('login_page_id', $login_page_id);
        }

        //*************// create registration page //*************//  

        if (null === $wpdb->get_row("SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'registration'", 'ARRAY_A')) {
            $current_user = wp_get_current_user();

            // create post object
            $page = array(
                'post_title'  => __('Registration'),
                'post_content'  => '[expert_registaration_form]',
                'post_status' => 'publish',
                'post_author' => $current_user->ID,
                'post_type'   => 'page',

            );
            $registration_page_id = wp_insert_post($page);
            update_option('registration_page_id', $registration_page_id);
        }

        //*************// create forget password page //*************//  

        if (null === $wpdb->get_row("SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'froget-password'", 'ARRAY_A')) {
            $current_user = wp_get_current_user();

            // create post object
            $page = array(
                'post_title'  => __('Froget password'),
                'post_content'  => '[expert_frogotpassword_form]',
                'post_status' => 'publish',
                'post_author' => $current_user->ID,
                'post_type'   => 'page',

            );
            $forget_page_id = wp_insert_post($page);
            update_option('forget_page_id', $forget_page_id);
        }

        //*************// create reset password page //*************//

        if (null === $wpdb->get_row("SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'reset-password'", 'ARRAY_A')) {
            $current_user = wp_get_current_user();

            // create post object
            $page = array(
                'post_title'  => __('Reset password'),
                'post_content'  => '[expert_resetpassword_form]',
                'post_status' => 'publish',
                'post_author' => $current_user->ID,
                'post_type'   => 'page',

            );
            $reset_page_id = wp_insert_post($page);
            update_option('reset_page_id', $reset_page_id);
        }

        //*************// create profile page //*************//

        if (null === $wpdb->get_row("SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'profile'", 'ARRAY_A')) {
            $current_user = wp_get_current_user();

            // create post object
            $page = array(
                'post_title'  => __('Profile'),
                'post_content'  => '[expert_profile_form]',
                'post_status' => 'publish',
                'post_author' => $current_user->ID,
                'post_type'   => 'page',

            );
            $profile_page_id = wp_insert_post($page);
            update_option('profile_page_id', $profile_page_id);
        }
    }

    public function __construct()
    {
        //add_filter('plugin_action_links_'.parent::$plugin_basename, array(__CLASS__, 'add_action_link') );
        add_filter('plugin_action_links_' . plugin_basename(__FILE__), array(__CLASS__, 'expert_login_action_links'));
        add_action('admin_menu', 'expert_login_page_setting');
        register_activation_hook(__FILE__, [$this, 'expert_login_plugin_activation']);
    }
}
$obj = new Setting();

function expert_login_page_setting()
{
    add_menu_page(
        'Expert login setting',     // page title
        'Expert login setting',     // menu title
        'manage_options',   // capability
        'expert-login-setting',     // menu slug
        'expert_login_page_setting_render' // callback function
    );
}
function expert_login_page_setting_render()
{
    global $title;

    print '<div class="wrap">';
    print "<h1>$title</h1>";
    include('expert_login_setting_page.php');
    print '</div>';
}
