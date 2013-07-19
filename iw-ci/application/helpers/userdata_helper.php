<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* convenience function to print session variables */
if(!function_exists('print_userdata')) {
  function print_userdata() {
    $CI =& get_instance();
    $userdata = $CI->session->userdata;
    foreach ($userdata as $item) {
      echo $item;
      echo '<br>';
    }
    die();
  }
}
