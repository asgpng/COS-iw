<h2>Princeton CS IW & Thesis Signup Form</h2>
<?php echo form_open('forms/view_project'); ?>
<div>
  <div>
    <label>Student NetID:</label>
    <input type="text" name="student_netID" value="<?php echo $project->student_netID;?>"  />
  </div>
  <div>
    <label>Class:</label>
    <input type="text" name="class_year" value="" />
  </div>
  <div>
    <label>Coursework:</label> 
  </div>
  <div class = "radio">
    <input type="radio" name="coursework" value="397" <?php if ($project->coursework == "397"): ?> checked <?php endif; ?> />397<br>
    <input type="radio" name="coursework" value="398" <?php if ($project->coursework == "398"): ?> checked <?php endif; ?> />398<br>
    <input type="radio" name="coursework" value="398" <?php if ($project->coursework == "497"): ?> checked <?php endif; ?> />497<br>
    <input type="radio" name="coursework" value="398" <?php if ($project->coursework == "498"): ?> checked <?php endif; ?> />498<br>
    <input type="radio" name="coursework" value="398" <?php if ($project->coursework == "AB JIW"): ?> checked <?php endif; ?> />AB JIW<br>
    <input type="radio" name="coursework" value="398" <?php if ($project->coursework == "AB Senior Thesis"): ?> checked <?php endif; ?> />AB Senior Thesis<br>
    <input type="radio" name="coursework" value="398" <?php if ($project->coursework == "BSE Senior Thesis"): ?> checked <?php endif; ?> />BSE Senior Thesis<br>
  </div>
  <br>
  <div>
    <label>Title of Project:</label>
    <textarea name="project_title"><?php echo $project->project_title;?></textarea>
  </div>
  <div>
    <input type="hidden" name="semester" value="<?php echo $this->session->userdata('semester')?>" />
  </div>
  <div>
    <label>Description:</label>
    <textarea name="description" rows="10" cols="23"><?php echo $project->description;?></textarea>
    <div>
      <label>Advisor Name:</label>
      <input type="text" name="advisor_name" value=""/>
    </div>
    <div>
      <label>Advisor NetID:</label>
      <input type="text" name="advisor_netID" value="<?php echo $project->advisor_netID;?>"/>
    </div>
    <div>
      <label>Advisor Department:</label>
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
      <label>If you have already met with your advisor, put down the date of your meeting.<b><br>If not, please schedule a meeting as soon as possible.</b></label>
      <input type="text" name="date_met" id="date_met"> (YYYY-MM-DD)
    </div>
    <div>
      <label id="sigHL">I agree to be responsible for all relevant deadlines. </label>
      <input type="checkbox" name="signature" id="signature" checked />
    </div>
    <br>
  </div>
</div>

