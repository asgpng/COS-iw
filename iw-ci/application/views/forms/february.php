<?php echo form_open("forms/february") ?>
<h2>Thesis &amp; IW 2 Semester February P.rogress Form</h2>
<div class="container">
  <h3>Student Section:</h3>
  <div>
    <label>Student NetID:</label>
    <input type="text" name="student_netID" id="student_netID" value="<?php echo set_value('student_netID') ?>"/>
    <input type="hidden" name="student_netID_hidden" value="<?php echo set_value('student_netID') ?>"/>
  </div>
  <div>
    <label>Approx. Number of Meetings with Advisor (0, 1, 2, 3-5, etc.):</label>
    <input type="text" name="number_of_meetings" id="number_of_meetings" value="<?php echo set_value('number_of_meetings'); ?>" />
  </div>
  <div>
    <label>Student Comments:</label>
    <textarea name="student_comments" id="student_comments" rows="2" cols="23"><?php echo set_value('student_comments') ?></textarea>
  </div>
  <?php if ($this->session->userdata('user_type') == 'faculty') : ?>													    
  <h3>Advisor Section:</h3>
    <div>
      <label id="first">I read the student's 5-page progress research paper:</label>
      <div class="radio">
        <input type="radio" name="advisor_read" value="0">Yes<br>
        <input type="radio" name="advisor_read" value="1">No<br>
      </div>
    </div>
    <div>
      <label id="second">Would you like your student to meet with you more often?</label>
      <div class="radio">
        <input type="radio" name="advisor_more_meetings" value="0">Yes<br>
        <input type="radio" name="advisor_more_meetings" value="1">No<br>
      </div>
    </div>
    <br>
    <div>
      <label id="third">Student Progress:</label>
      <div class="radio">
        <input type="radio" name="student_progress_eval" value="0">Sensational<br>
        <input type="radio" name="student_progress_eval" value="1">Good<br>
        <input type="radio" name="student_progress_eval" value="2">Unsatisfactory<br>
      </div>
    </div>
    <div>
      <label>Advisor Comments:</label>
      <textarea name="advisor_comments" rows="2" cols="23"></textarea>
    </div>
</body>
<?php endif; ?>
<div id="submit">
  <input type="submit" value="Submit">
</div>
</form>
</div>

<hr>
