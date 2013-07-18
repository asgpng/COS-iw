<div class="error"><?php echo form_open("forms/advisor_feedback") ?></div>
<h1>Advisor Grade Feedback Form</h1>
<b><?php echo validation_errors(); ?></b>
<br>
<div>
  <label>Student netID:</label>
  <input type="text" name="student_netID" id="student_netID" value=<?php set_value('student_netID'); ?>>
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
  <label>Initiative:</label>
  <input type="radio" name="initiative" value="2"> Student's ideas yielded significant and unanticipated insight into the problem.<br>
  <input type="radio" name="initiative" value="1"> Student moved beyond what I suggested, but in ways I might have expected.<br>
  <input type="radio" name="initiative" value="0"> I or another group heavily guided the student.<br>
</div>
<br>
<div>
  <label>Plans - Do you plan to work with this student to take this project to publication?</label>
  <input type="radio" name="plans" value="3"> Yes, she is the primary author of a major publication.<br>
  <input type="radio" name="plans" value="2"> Yes, the student is one of several authors OR is the main author in a small publication.<br>
  <input type="radio" name="plans" value="1"> No, but it is theoretically possible.<br>
  <input type="radio" name="planes" value="0"> No.<Br>
</div>
<br>
<div>
  <label>Paper - Description of Research:</label>
  <input type="radio" name="paper" value="3"> Excellent, the student clearly explained his/her results and contributions with sufficient details so that it is possible to verify/reproduce them.<br>
  <input type="radio" name="paper" value="2"> Good.<br>
  <input type="radio" name="paper" value="1"> Fair.<br>
  <input type="radio" name="paper" value="0"> Poor.<br>
</div>
<br>
<div>
  <label>Student's Work is in the Top % of All Students I've Advised</label>
  <input type="radio" name="percentile" value="Top 5%"> 5%<br>
  <input type="radio" name="percentile" value="Top 10%"> 10%<br>
  <input type="radio" name="percentile" value="Top 25%"> 25%<br>
  <input type="radio" name="percentile" value="Top 50%"> 50%<br>
  <input type="radio" name="percentile" value="Top 75%"> 75%<br>
  <input type="radio" name="percentile" value="Top 100%"> 100%<br>
</div>
<br>
<div>
  <label>Suggested Grade:</label>
  <input type="radio" name="grade" value="A+"> A+<br>
  <input type="radio" name="grade" value="A"> A<br>
  <input type="radio" name="grade" value="A-"> A-<br>
  <input type="radio" name="grade" value="B+"> B+<br>
  <input type="radio" name="grade" value="B"> B<br>
  <input type="radio" name="grade" value="B-"> B-<br>
  <input type="radio" name="grade" value="C+"> C+<br>
  <input type="radio" name="grade" value="C"> C<br>
  <input type="radio" name="grade" value="C-"> C-<br>
  <input type="radio" name="grade" value="D"> D<br>
  <input type="radio" name="grade" value="F"> F<br>
</div>
<br>
<div>
  <label>Additional Comments</label>
  <textarea name="comments" id="comments"></textarea>
</div>
<input type="submit" value="Submit">
</div>
