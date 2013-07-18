<h2>Second Reader Feedback Form</h2>
<div class="error"><?php echo validation_errors(); ?></div>
<?php echo form_open('forms/second_reader_feedback'); ?>
  <br>
  <div>
    <label>Student netID:</label>
    <input type="text" name="student_netID" id="student_netID">
  </div>
  <br>
  <div>
    <label>Research:</label>
    <input type="radio" name="research" value="3"> Grad Student Level.<br>
    <input type="radio" name="research" value="2"> Tough Undergrad Project.<br>
    <input type="radio" name="research" value="1"> Similar to Undergrad Projects I've advised in the past.<br>
    <input type="radio" name="research" value="0"> Easy Project.<br>
  </div>
  <br>
  <div>
    <label>Research Progress:</label>
    <input type="radio" name="research_progress" value="3"> Amazing, I would nominate this student for a CRA undergrad research award.<br>
    <input type="radio" name="research_progress" value="2"> Very good.<br>
    <input type="radio" name="research_progress" value="1"> Good as I would expect for independent work.<br>
    <input type="radio" name="research_progress" value="0"> Below average.<br>
  </div>
  <br>
  <div>
    <label>Paper - Description of Research:</label>
    <input type="radio" name="description" value="3"> Excellent, the student clearly explained his/her results and contributions with sufficient details so that it is possible to verify/reproduce them.<br>
    <input type="radio" name="description" value="2"> Good<br>
    <input type="radio" name="description" value="1"> Fair<br>
    <input type="radio" name="description" value="0"> Poor<br>
  </div>
  <br>
  <div>
    <label>Additional Comments</label>
    <textarea name="comments" id="comments"></textarea>
  </div>
  <input type="submit" value="Submit">
</form>
