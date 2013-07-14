<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link rel="stylesheet" type="text/css" href="/iw-ci/bootstrap.css" />
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
          <a class="brand" href="/iw-ci/index.php">Princeton COS IW</a>
          <!-- <img "/silex-test/silex/web/images/princeton.gif" width="40" height="40"> -->
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
   Logged in as <a href="/iw-ci/index.php/logout" class="navbar-link"><?php echo $this->session->userdata('netID')?></a>
            </p>
            <ul class="nav">
              <li class="active"><a href="/iw-ci/index.php">Home</a></li>
              <li><a href="http://iw.cs.princeton.edu/12-13/">COS IW Website</a></li>
              <li><a href="/iw-ci/index.php/about">About</a></li>
              <li><a href="/iw-ci/index.php/contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Files</li>
              <!-- <li class="active"><a href="#">Link</a></li> -->
              <li><a href="/iw-ci/index.php/files/upload">Upload New File</a></li>
              <li><a href="/iw-ci/index.php/files/view_files">Uploaded Files</a></li>
              <li class="nav-header">Forms</li>
	          <li class="forms"><a href="/iw-ci/index.php/forms/checkpoint">Checkpoint Form</a></li>
	          <li class="forms"><a href="/iw-ci/index.php/forms/february">February Progress Form</a></li>(for all 2-semester work)
	          <li class="forms"><a href="/iw-ci/index.php/forms/second_reader">Second Reader Form</a></li>(for all 2-semester work)
		      <li class="forms"><a href="/iw-ci/index.php/student/cp">Student Control Panel</a></li>
              <li><a href="/iw-ci/index.php/forms/query">Form Query</a></li>

              <!-- custom user links: -->
              <li class="nav-header">Faculty</li>
              <li><a href="/iw-ci/index.php/forms/approve">Approve Students as Advisees</a></li>
              <li class="nav-header">Admin</li>
              <li><a href="/iw-ci/index.php/admin/users">View Users</a></li>
              <a href="/iw-ci/index.php/admin/user_upload">User List Upload</a><br>
              <li><a href="/iw-ci/index.php/messages">Messages</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <!-- block content -->