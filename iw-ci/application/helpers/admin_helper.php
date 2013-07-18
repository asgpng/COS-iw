<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* to ensure this is viewable only by admin */
/* Can easily change to redirect to 404 instead */
if(!function_exists('_is_admin')) {
  function _is_admin() {
    $CI =& get_instance();
    echo $CI->session->userdata('user_type');
    if (!$CI->session->userdata('user_type') == 'administrator') {
      echo 'You do not have permission to access this page.';
      die();
    }
  }
}
