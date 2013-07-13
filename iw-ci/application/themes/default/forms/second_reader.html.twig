{% extends "base.html.twig" %}
{% block title %}Second Reader Form{% endblock %}
{% block header %}
<script type="text/javascript">

function invalid() {

   alert("The inputted second reader netID was not found on the server!");
}

function check() {

    var proceed =  highlight(year(), text1(), text2(), text3(), text4());
    if (!proceed) 
	window.alert("Please check highlighted field(s)!");
    
    return proceed;
  }

function highlight(year, text1, text2, text3, text4) {

  if (year)
  document.getElementById("class_year").style.backgroundColor='#fff';
  else
  document.getElementById("class_year").style.backgroundColor='#fa7f00';

  if (text1)
  document.getElementById("project_title").style.backgroundColor='#fff';
  else
  document.getElementById("project_title").style.backgroundColor='#fa7f00';

  if (text2)
  document.getElementById("description").style.backgroundColor='#fff';
  else
  document.getElementById("description").style.backgroundColor='#fa7f00';

  if (text3)
  document.getElementById("sr_name").style.backgroundColor='#fff';
  else
  document.getElementById("sr_name").style.backgroundColor='#fa7f00';

  if (text4)
  document.getElementById("sr_netID").style.backgroundColor='#fff';
  else
  document.getElementById("sr_netID").style.backgroundColor='#fa7f00';

  var checked = year && text1 && text2 && text3 && text4;
  return checked;
  }

  function year() {

  var re = /^\d{4}$/;
  var year = document.getElementById("class_year").value;

  return re.test(year);
  }

 function text1() {

    var re = /.+/;
    var title = document.getElementById("project_title").value;
    return re.test(title);
}

function text2() {
    var re = /.+/;
    var description = document.getElementById("description").value;

    return re.test(description);
}

function text3() {
    var re = /.+/;
    var sr_name = document.getElementById("sr_name").value;

    return re.test(sr_name);
}

function text4() {

    var re = /.+/;
    var sr_netID = document.getElementById("sr_netID").value;

    return re.test(sr_netID);
}

</script>
{% endblock %}

{% block content %}
{% if invalid_netID %}
<body onload=invalid()></body>
{% endif %}
<h2> Second Reader Form for IW</h2>

<div class="container">
  <form action="/forms/second_reader" method="post" onsubmit="return check()">
	<div>
	  <label>Student NetID:</label>
	  <input type="text" name="student_netID" value="{{ current_user.netID }}" disabled/>
	  <input type="hidden" name="student_netID_hidden" value="{{ current_user.netID }}"/>
	</div>
    <div>
      <label>Student Name:</label>
      <input type="text" name="student_name"/>
    </div>
    <div>
      <label>Class:</label>
      <input type="text" name="class_year" id="class_year"/>
    </div>
    <div>
      <label>Title of Project:</label>
      <textarea name="project_title" id="project_title" rows="2" cols="23"></textarea>
    </div>
    <div>
      <label>Description:</label>
      <textarea name="description" id="description" rows="10" cols="23"></textarea>
    </div>
    <div>
      <label>Second Reader's Name</label>
      <input type="text" name="sr_name" id="sr_name"/>
      <div>
        <label>Second Reader's NetID</label>
        <input type="text" name="sr_netID" id="sr_netID"/>
      </div>
      <div>
        <label>Second Reader's Department</label>
	<select name="sr_department" id="sr_department">
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
      <br>
      <div id="submit">
        <input type="submit" value="Submit">
      </div>
      <br>
    </div>
  </form>
</div>
{% endblock %}
