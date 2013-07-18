<div class="error"><?php echo validation_errors(); ?></div>
<?php echo form_open('forms/approve'); ?>
  <div>
    <label>Pending requests by netID:</label>
    <select name="student_netID">
     <option value="0">Please select a student</option>
     <?php foreach ($query->result() as $row): ?>
     <option value="<?php echo $row->student_netID; ?>" <?php echo set_select('student_netID', $row->student_netID);?> ><?php echo $row->student_netID; ?></option>
     <?php endforeach; ?>
     </select>
  </div>
  <br>
  <div class="radio">
    <input type="radio" name="agreement" value="yes" <?php echo set_radio('agreement', 'yes'); ?> />I agree to be this student's advisor/second reader.<br>
    <input type="radio" name="agreement" value="no" <?php echo set_radio('agreement', 'no'); ?> />I do not agree to be this student's advisor/second reader.<br>
  </div>
  <div>
    <input type="submit" value="Submit"/>
  </div>
  </form>
<br>
