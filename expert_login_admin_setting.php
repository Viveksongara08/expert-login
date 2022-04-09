<?php

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


class Setting
{

  public static function expert_login_action_links($links)
  {
    $expert_login_settings_link = '<a href="' . admin_url('admin.php?page=expert-login-setting') . '">' . translate('Settings') . '</a>';
    array_unshift($links, $expert_login_settings_link);
    return $links;
  }

  public function __construct()
  {
    //add_filter('plugin_action_links_'.parent::$plugin_basename, array(__CLASS__, 'add_action_link') );
    add_filter('plugin_action_links_' . plugin_basename(__FILE__), array(__CLASS__, 'expert_login_action_links'));
    add_action('admin_menu', 'expert_login_page_setting');
  }
}

$obj = new Setting();
