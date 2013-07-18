<h1>User Login</h1>
<p>Please enter or netID and password to log in</p>
<b><?php echo validation_errors(); ?></b>
<?php echo form_open('defaults/test_login'); ?>
<!-- <form action="/iw-ci/index.php/login" method="post"> -->
  <div>
    <label>NetID:</label>
    <input type="text" name="netID" value="<?php echo set_value('netID'); ?>"/>
  </div>
  <div>
    <label>Password:</label>
    <input type="password" name="password" value="<?php echo set_value('netID'); ?>"/>
  </div>
  <div>
    <input type="submit" value="Submit" />
  </div>
</form>
