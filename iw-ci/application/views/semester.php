<h1>Select Semester</h1>
<b><?php echo validation_errors(); ?></b>
<?php echo form_open('defaults/semester'); ?>
  <div>
    <label>Semester:</label>
    <select name="semester">
      <option value="set semester">Select Semester</option>
      <option value="F13">F13</option>
      <option value="S14">S14</option>
      <option value="F13-S14">F13-S14</option>
      <option value="F14">F14</option>
    </select>
  </div>
  <div>
    <input type="submit" value="Submit" />
  </div>
</form>
