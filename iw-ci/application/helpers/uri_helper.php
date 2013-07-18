<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Convenience function to encode parameters into a uri
 * Expects $page with leading slash
 */
if (!function_exists('build_uri')) {
  function build_uri($params, $page) {
    $query = http_build_query($params);
    $url = site_url() . $page . '?' . $query;
    return $url;
  }
}
