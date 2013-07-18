<h2>Princeton CS IW & Thesis Signup Form</h2>
<b><?php echo validation_errors(); ?></b>
<?php echo form_open('forms/project'); ?>
  <div>
	<label>Student NetID:</label>
	<input type="text" name="student_netID" value="<?php echo set_value('student_netID'); ?>" disabled>
	<!-- <input type="hidden" name="student_netID_hidden" value="<?php echo set_value('student_netID')"> -->
    <div>
      <label>Class:</label>
      <input type="text" name="class_year" id="class_year"/>
    </div>
    <div>
      <label id="radioHL">Please check one:</label>
	</div>
    <div class = "radio">
      <Input type="radio" name="coursework" value="0">397<br>
      <input type="radio" name="coursework" value="1">398<br>
      <input type="radio" name="coursework" value="2">497<br>
      <input type="radio" name="coursework" value="3">498<br>
      <input type="radio" name="coursework" value="4">AB JIW<br>
      <input type="radio" name="coursework" value="5">AB Senior Thesis<br>
      <input type="radio" name="coursework" value="6">BSE Senior Thesis<br>
	</div>
    <div>
      <label>Title of Project:</label>
      <textarea name="project_title" id="project_title"></textarea>
    </div>
    <div>
      <label>Description:</label>
      <textarea name="description" id="description" rows="10" cols="23"></textarea>
      <div>
        <label>Advisor's Name:</label>
        <input type="text" name="advisor_name" id="advisor_name"/>
      </div>
	  <div>
	    <label>Advisor's NetID:</label>
	    <input type="text" name="advisor_netID" id="advisor_netID" />
	  </div>
      <div>
        <label>Advisor's Department:</label>
	    <select name="advisor_department">
	      <option value="ANT">Anthropology</option>
	      <option value="ARC">Architecture</option>
	      <option value="ART">Art and Archaeology</option>
	      <option value="AST">Astrophysical Sciences</option>
	      <option value="CBE">Chemical and Biological Engineering</option>
	      <option value="CHE">Chemistry</option>
	      <option value="CEE">Civil and Environmental Engineering</option>
	      <option value="CLA">Classics</option>
	      <option value="COM">Comparative Literature</option>
	      <option value="COS" selected = "selected">Computer Science</option>
	      <option value="EAS">East Asian Studies</option>
	      <option value="EEB">Ecology and Evolutionary Biology</option>
	      <option value="ECO">Economics</option>
	      <option value="ELE">Electrical Engineering</option>
	      <option value="ENG">English</option>
	      <option value="FIT">French and Italian</option>
	      <option value="GEO">Geosciences</option>
	      <option value="GER">German</option>
	      <option value="HIS">History</option>
	      <option value="MAT">Mathematics</option>
	      <option value="MAE">Mechanical and Aerospace Engineering</option>
	      <option value="MOL">Molecular Biology</option>
	      <option value="MUS">Music</option>
	      <option value="NES">Near Eastern Studies</option>
	      <option value="ORF">Operations Research and Financial Engineering</option>
	      <option value="PHI">Philosophy</option>
	      <option value="PHY">Physics</option>
	      <option value="POL">Politics</option>
	      <option value="PSY">Psychology</option>
	      <option value="REL">Religion</option>
	      <option value="SLA">Slavic Languages and Literatures</option>
	      <option value="SOC">Sociology</option>
	      <option value="SPO">Spanish and Portuguese</option>
	      <option value="WWS">Woodrow Wilson School</option>
	    </select>
      </div>
      <div>
	<label>If you have already met with your advisor, put down the date of your meeting. If not, please schedule a meeting as soon as possible.</label>
	<input type="text"> (MM/DD/YYYY)
      </div>
      <div>
	<label id="sigHL">I agree to be responsible for all relevant deadlines.</label>
	<input type="checkbox" name="signature" id="signature"/>
      </div>
      <div id="submit">
        <input type="submit" value="Submit">
      </div>
    </div>
  </div>

<hr>
