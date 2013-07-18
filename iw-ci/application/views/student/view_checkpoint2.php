<h2>Thesis &amp; IW 2 Semester Checkpoint Form 2</h2>
<h3>Student Section:</h3>
<div>
  <label>Student NetID:</label>
  <?php echo $query->student_netID;?>
</div>
<div>
  <label>Approx. Number of Meetings with Advisor (0, 1, 2, 3-5, etc.):</label>
  <?php echo $query->number_of_meetings;?>
</div>
<div>
  <label>Student Comments:</label>
  <?php echo $query->student_comments;?>
</div>
<h3>Advisor Section:</h3>
<div>
  <label id>I read the student's 5-page progress research paper:</label>
  <?php if ($query->advisor_read == '0'): ?> Yes. <?php endif ?>
  <?php if ($query->advisor_read == '1'): ?> No.  <?php endif ?>
</div>
<div>
  <label id="second">Would you like your student to meet with you more often?</label>
  <?php if ($query->advisor_more_meetings == '0'): ?> Yes. <?php endif ?>
  <?php if ($query->advisor_more_meetings == '1'): ?> No.  <?php endif ?>
</div>
<div>
  <label id="third">Student Progress:</label>
  <?php if ($query->student_progress_eval == '0'): ?> Exceptional    <?php endif ?>
  <?php if ($query->student_progress_eval == '1'): ?> Very Good    <?php endif ?>
  <?php if ($query->student_progress_eval == '2'): ?> Good           <?php endif ?>
  <?php if ($query->student_progress_eval == '3'): ?> Unsatisfactory <?php endif ?>
</div>
<div>
  <label>Advisor Comments:</label>
  <?php echo $query->advisor_comments;?>
</div>

<hr>
