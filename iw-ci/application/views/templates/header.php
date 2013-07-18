<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">


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
              <a href="/iw-ci/index.php/semester">Semester: <?php echo $this->session->userdata('semester')?></a>
              <a href="/iw-ci/index.php/test_login">Test Login</a>
              <a href="/iw-ci/index.php/test_login">Test Logout</a>
              Logged in as <a href="/iw-ci/index.php/logout" class="navbar-link"><?php echo $this->session->userdata('netID')?></a>
            </p>
            <ul class="nav">
              <li class="active"><a href="/iw-ci/index.php">Home</a></li>
              <li><a href="http://iw.cs.princeton.edu/12-13/">COS IW Website</a></li>
              <li><a href="/iw-ci/index.php/about">About</a></li>
              <li><a href="/iw-ci/index.php/contact">Contact</a></li>
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
              <li><a href="/iw-ci/index.php/files/upload">Upload New File</a></li>
              <li><a href="/iw-ci/index.php/files/view_files">Uploaded Files</a></li>
              <li class="nav-header">Forms</li>
                 	          <li class="forms"><a href="/iw-ci/index.php/forms/project?student_netID=None">Project Signup Form</a></li>
		 	          <li class="forms"><a href="/iw-ci/index.php/forms/checkpoint1?student_netID=None">Checkpoint Form 1</a></li>
	          <li class="forms"><a href="/iw-ci/index.php/forms/checkpoint2?student_netID=None">Checkpoint Form 2</a></li>
	          <li class="forms"><a href="/iw-ci/index.php/forms/february?student_netID=None">February Progress Form</a></li>(for all 2-semester work)
                  <?php if ($this->session->userdata('user_type') == 'student'): ?>
	          <li class="forms"><a href="/iw-ci/index.php/student/student_cp">Student Control Panel</a></li>
		  <?php endif; ?>
	      <?php if ($this->session->userdata('user_type') == 'faculty'): ?>
              <li class="nav-header">Faculty</li>
                  <li><a href="/iw-ci/index.php/forms/approve">Approve Students as Advisees</a></li>
	          <li><a href="/iw-ci/index.php/forms/advisor_feedback?student_netID=None">Advisor Final Feedback Form</a></li>
	          <li><a href="/iw-ci/index.php/forms/second_reader_feedback?student_netID=None">Second Reader Final Feedback Form</a></li>
	      <?php endif; ?>
              <?php if ($this->session->userdata('user_type') == 'administrator'): ?>
              <li class="nav-header">Admin</li>
                  <li><a href="/iw-ci/index.php/admin/view_student_projects">View Student Projects</a></li>
                  <li><a href="/iw-ci/index.php/admin/view_checkpoint1">View Checkpoint 1 Forms</a></li>
                  <li><a href="/iw-ci/index.php/admin/view_checkpoint2">View Checkpoint 2 Forms</a></li>
                  <li><a href="/iw-ci/index.php/admin/view_february">View February Forms</a></li>
                  <li><a href="/iw-ci/index.php/admin/view_advisor_feedback">View Advisor Feedback</a></li>
                  <li><a href="/iw-ci/index.php/admin/view_sr_feedback">View Second Reader Feedback</a></li>
                  <li><a href="/iw-ci/index.php/admin/user_upload">User List Uploads</a></li>
                  <li><a href="/iw-ci/index.php/admin/users">View Users</a></li>
                  <li><a href="/iw-ci/index.php/messages">Messages</a></li>
	      <?php endif ?>
            </ul>
          </div>
        </div>
        <div class="span9">
