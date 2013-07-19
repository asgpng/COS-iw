<h2> Upload New File</h2>
<?php echo $error;?>

<?php echo form_open_multipart('files/do_upload');?>

<input type="file" name="userfile" size="50" />

<br /><br />

<input type="submit" value="upload" />
</form>