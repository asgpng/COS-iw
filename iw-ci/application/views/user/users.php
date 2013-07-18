<h2>Current Users</h2>
<div class="error"><?php echo validation_errors(); ?></div>
<?php echo form_open('admin/users'); ?>
<table border="1">
  <tr>
    <th>User netID</th>
    <th>User Type</th>
    <th>Delete</th>
  </tr>
  <?php foreach ($query->result() as $row): ?>
  <tr>
    <td>
      <?php echo $row->netID; ?>
    </td>
    <td>
      <?php echo $row->user_type; ?>
    </td>
    <td>
      <a href="<?php echo build_uri(array('netID'=>$row->netID,'action'=>'delete'),'/admin/user_delete');?>" >Delete</a>
    </td>
  </tr>
  <?php endforeach; ?>
  <tr>
    <td>
      <select name="user_type">
        <option value="student">Student</option>
        <option value="faculty">Faculty</option>
        <option value="administrator">Administrator</option>
      </select>
    </td>
    <td>
      <input type="text" name="netID"/>
    </td>
    <td>
      <input type="submit" value="New User">
    </td>
  </tr>
</tr>

</table>
</form>
