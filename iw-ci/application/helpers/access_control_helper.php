<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('is_logged_in')) {
  function is_logged_in() {
    $CI =& get_instance();
    $is_logged_in = $CI->session->userdata('is_logged_in');
    if(!isset($is_logged_in) || $is_logged_in != true) {
      echo 'You must login to access this page. <a href="/iw-ci/index.php/login">Login</a>';
      die();
    }
  }
}

/* to prevent access of certain views by students */
/* Can easily change to redirect to 404 instead */
if(!function_exists('not_student')) {
  function not_student() {
    $CI =& get_instance();
    if ($CI->session->userdata('user_type') == 'student') {
      echo 'You do not have permission to access this page.';
      die();
    }
  }
}

/* to ensure this is viewable only by faculty */
/* Can easily change to redirect to 404 instead */
if(!function_exists('is_faculty')) {
  function is_faculty() {
    $CI =& get_instance();
    if ((!$CI->session->userdata('user_type') == 'faculty')) {
      echo 'You do not have permission to access this page.';
      die();
    }
  }
}

/* to ensure this is viewable only by admin */
/* Can easily change to redirect to 404 instead */
if(!function_exists('is_administrator')) {
  function is_administrator() {
    $CI =& get_instance();
    if (!($CI->session->userdata('user_type') == 'administrator')) {
      echo 'You do not have permission to access this page.';
      die();
    }
  }
}
