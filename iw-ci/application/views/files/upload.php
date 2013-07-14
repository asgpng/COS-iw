{% extends "base.html.twig" %}
{% block title %} Upload New File{% endblock %}
{% block head %}
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

{% endblock %}
{% block content %}
<h2> Upload New File</h2>

<div class="container">
  <form action="{{ upload_url }}"  method="POST" onsubmit="return check();" enctype="multipart/form-data">

    <div>
      Upload File:
    </div>
    <input type="file" name="uploadField" id="newFile"/>
    <input type="hidden" id="fileName"  name="filename" value="" />
    <input type="hidden" id="fileExt" name="ext" value="" />
    <div id="submit">
      <input type="submit" value="Submit">
    </div>
  </form>
</div>
{% endblock %}
