<h1>Student Control Panel</h1>
<br>
<h4>Your Project:</h4>
<li><a href="/iw-ci/index.php/forms/view_project">View</a></li>
<li><a href="/iw-ci/index.php/forms/project">Edit</a><li>

<hr>

<h4>Forms Submitted:</h4>

<?php if ($checkpoint1->num_rows() != 0): ?>
<li><a href="/iw-ci/index.php/student/view_checkpoint1">Checkpoint 1</a></li>
<?php endif; ?>
<?php if ($checkpoint2->num_rows() != 0): ?>
<li><a href="/iw-ci/index.php/student/view_checkpoint2">Checkpoint 2</a></li>
<?php endif; ?>
<?php if ($february->num_rows() != 0): ?>
<li><a href="/iw-ci/index.php/student/view_february">February</a></li>
<?php endif; ?>

<hr>

<h4>Forms You Need to Submit:</h4>

<?php if ($checkpoint1->num_rows() == 0): ?>
<p>Checkpoint 1</p>
<?php endif; ?>
<?php if ($checkpoint2->num_rows() == 0): ?>
<p>Checkpoint 2</p>
<?php endif; ?>
<?php if ($february->num_rows() == 0): ?>
<p>February Form</p>
<?php endif; ?>

<hr>

<h4>Approval Status:</h4>

<p>If your advisor request is still pending after 5 days of requesting an advisor or second reader, please contact the professor and confirm whether you are in fact his/her advisee and/or pursue another advisor or second reader.</p>