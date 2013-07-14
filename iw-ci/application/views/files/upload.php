<script type="text/javascript">

    function check() {
    var check = document.getElementById("newFile").value;
    if (check == "") {
	window.alert("You did not select a file!");
	return false;
    }
    else
	  return true;
}
</script>

<h2> Upload New File</h2>

<!-- <form action="{{ upload_url }}"  method="POST" onsubmit="return check();" enctype="multipart/form-data"> -->

<!--   <div> -->
<!--     Upload File: -->
<!--   </div> -->
<!--   <input type="file" name="uploadField" id="newFile"/> -->
<!--   <input type="hidden" id="fileName"  name="filename" value="" /> -->
<!--   <input type="hidden" id="fileExt" name="ext" value="" /> -->
<!--   <div id="submit"> -->
<!--     <input type="submit" value="Submit"> -->
<!--   </div> -->
<!-- </form> -->
<?php echo $error;?>

<?php echo form_open_multipart('files/do_upload');?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />
