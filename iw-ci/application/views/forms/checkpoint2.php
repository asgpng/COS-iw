<?php echo form_open("forms/checkpoint2") ?>
<h2>Princeton CS IW Checkpoint Form 2</h2>
<b><?php echo validation_errors(); ?></b>
<h3>Student Section:</h3>
<div class="container">
  <div>
    <label>Student NetID: </label>
    <input type="text" name="student_netID" id="student_netID" value="<?php echo set_value('student_netID'); ?>"/>
    <input type="hidden" name="student_netID_hidden" id="student_netID" value="<?php echo set_value('student_netID') ?>"/>
  </div>
  <div>
    <label>Approx. Number of Meetings with Advisor (0, 1, 2, 3-5, etc.):</label>
    <input type="text" name="number_of_meetings" id="number_of_meetings" value="<?php echo set_value('number_of_meetings'); ?>" />
  </div>
  <br>
  <div>
    <label>Student Self Assessment:</label>
    <textarea name="student_self_assessment" rows="5" cols="60" id="student_self_assessment"><?php echo set_value('student_self_assessment'); ?></textarea>
  </div>
</div>
<?php if ($this->session->userdata('user_type') == 'faculty') : ?>
<h3>Advisor Section:</h3>
<div class="container" >
  <div>
    <label id="first">I read the student's 1-page progress summary report</label>
    <div class="radio">
      <input type="radio" name="advisor_read" value="0" />Yes<br>
      <input type="radio" name="advisor_read" value="1" />No<br>
    </div>
  </div>
  <div>
    <label id="second">Would you like your student to meet with you more often?</label>
    <div class="radio">
      <input type="radio" name="advisor_more_meetings" value="0" />Yes<br>
      <input type="radio" name="advisor_more_meetings" value="1" />No<br>
    </div>
  </div>
  <br>
  <div>
    <label id="third">Student Progress:</label>
    <div class="radio">
      <input type="radio" name="student_progress_eval" value="0" />Exceptional<br>
      <input type="radio" name="student_progress_eval" value="1" />Very Good<br>
      <input type="radio" name="student_progress_eval" value="2" />Good<br>
      <input type="radio" name="student_progress_eval" value="3" id="unsatisfactory" />Unsatisfactory<br>
    </div>
  </div>
  <div>
    <label>Comments: <br> [If student progress is unsatisfactory, explain what steps they need to take to get on track.]</label>
    <textarea name="advisor_comments" id="advisor_comments" rows="4" cols="60"></textarea>
  </div>
</body>
<?php endif; ?>
<div id="submit">
  <input type="submit" value="Submit">
</div>
</div>
</form>

<hr>
