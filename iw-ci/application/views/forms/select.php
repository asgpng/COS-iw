<h2>Select Student</h2>
<div class="container">
  <?php echo form_open("forms/select?form="); ?>
<div> 
  <label>Students by netID.</label> 
  <select name="student_netID">
    <option value="0">Please select a student</option>
    <?php foreach ($query->result() as $row): ?>
    <option value="<?php echo $row->student_netID; ?>" <?php echo set_select('student_netID', $row->student_netID);?> ><?php echo $row->student_netID; ?></option>
<?php endforeach; ?>

  </select>
</div>
<div> 
  <input type="submit" value="Submit" /> 
</div>
</div>

<hr> 

