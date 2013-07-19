<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/bootstrap.css');?>" />
    <!-- <link rel="stylesheet" type="text/css" href="/iw-ci/bootstrap.css" /> -->
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
            <ul class="navbar-text pull-right">
              <li>
               <a class="navbar-link" href="/iw-ci/index.php/semester">Semester: <?php echo $this->session->userdata('semester')?></a>
               <?php echo anchor('test_login', 'Test Login', 'class="navbar-link"'); ?>
               <?php echo anchor('test_login', 'Test Logout', 'class="navbar-link"'); ?>
              Logged in as <a href="/iw-ci/index.php/logout" class="navbar-link"><?php echo $this->session->userdata('netID')?></a>
              </li>
            </ul>
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
              <li class="nav-header">Files</li>
              <li><?php echo anchor('files/upload', 'Upload New File'); ?></li>
              <li><?php echo anchor('files/view_file', 'Uploaded Files'); ?></li>
              <li class="nav-header">Forms</li>
              <li><?php echo anchor('forms/project?student_netID=None', 'Project Signup Form'); ?></li>
              <li><?php echo anchor('forms/checkpoint1?student_netID=None', 'Checkpoint Form 1'); ?></li>
              <li><?php echo anchor('forms/checkpoint2?student_netID=None', 'Checkpoint Form 2'); ?></li>
              <li><?php echo anchor('forms/february?student_netID=None', 'February Progress Form'); ?></li>(for all 2-semester work)
              <?php if ($this->session->userdata('user_type') == 'student'): ?>
	      <li><?php echo anchor('forms/request_second_reader', 'Request a Second Reader'); ?></li>
              <li><?php echo anchor('student/student_cp', 'Student Control Panel'); ?></li>
		      <?php endif; ?>
	          <?php if ($this->session->userdata('user_type') == 'faculty'): ?>
              <li class="nav-header">Faculty</li>
              <li><?php echo anchor('forms/approve', 'Approve Students as Advisees'); ?></li>
              <li><?php echo anchor('forms/advisor_feedback?student_netID=None', 'Approve Final Feedback Form'); ?></li>
              <li><?php echo anchor('forms/second_reader_feedback?student_netID=None', 'Second Reader Final Feedback Form'); ?></li>
	          <?php endif; ?>
              <?php if ($this->session->userdata('user_type') == 'administrator'): ?>
              <li class="nav-header">Admin</li>
              <li><?php echo anchor('admin/view_student_projects', 'View Student Projects'); ?></li>
              <li><?php echo anchor('admin/view_checkpoint1',      'View Checkpoint 1 Forms'); ?></li>
              <li><?php echo anchor('admin/view_checkpoint2',      'View Checkpoint 2 Forms'); ?></li>
              <li><?php echo anchor('admin/view_february',         'View February Forms'); ?></li>
              <li><?php echo anchor('admin/view_advisor_feedback', 'View Advisor Feedback'); ?></li>
              <li><?php echo anchor('admin/view_sr_feedback',      'View Second Reader Feedback'); ?></li>
              <li><?php echo anchor('admin/user_upload',           'User List Uploads'); ?></li>
              <li><?php echo anchor('admin/users',                 'View Users'); ?></li>
              <!-- <li><a href="/iw-ci/index.php/messages">Messages</a></li> -->
	          <?php endif ?>
            </ul>
          </div>
        </div>
        <div class="span9">
