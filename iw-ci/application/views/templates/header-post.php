<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/bootstrap.css');?>" />
    <title><?php echo $title ?> - COS IW</title>
  </head>

  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php echo anchor('/', 'Prinecton COS IW', 'class="brand"'); ?>
          <!-- <img "/silex-test/silex/web/images/princeton.gif" width="40" height="40"> -->
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><?php echo anchor('/', 'Home'); ?></li>
              <li><a href="http://iw.cs.princeton.edu/12-13/">COS IW Website</a></li>
              <li><?php echo anchor('about', 'About'); ?></li>
              <li><?php echo anchor('contact', 'Contact'); ?></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li>You have been logged out of this site.</li>
            </ul>
          </div>
        </div>
        <div class="span9">
