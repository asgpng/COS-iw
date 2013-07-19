<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Basic function to be called in controller constructors to ensure that a
 * user is logged in. If so, it does nothing. If not, it redirects them to
 * login, encoding their requested page in the url, so that when they are
 * logged in, they are redirected to their original requested page.
 */
if(!function_exists('is_logged_in')) {
  function is_logged_in() {
    $CI =& get_instance();
    $CI->load->helper('uri');
    $is_logged_in = $CI->session->userdata('is_logged_in');
    if(!isset($is_logged_in) || $is_logged_in != true) {
      /* change 'test_login' to 'login' for production */
      $login =  build_uri(array('next' => uri_string()), '/login');
      echo 'You must login to access this page. <a href="' . $login . '">Login</a>';
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
