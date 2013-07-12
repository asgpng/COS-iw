{% extends "base.html.twig" %}
{% block head %}


<script type = "text/javascript">

function disable() {

document.getElementById('student_netID').disabled=true;
document.getElementById('student_name').disabled=true;
document.getElementById('project_title').disabled=true;
document.getElementById('advisor_name').disabled=true;
document.getElementById('number_of_meetings').disabled=true;
document.getElementById('student_self_assessment').disabled=true;

}

function checkStudent() {

var student_name = document.getElementById("student_name").value;
var project_title = document.getElementById("project_title").value;
var advisor = document.getElementById("advisor_name").value;
var meetings = document.getElementById("number_of_meetings").value;
var self_assessment = document.getElementById("student_self_assessment").value;

var re = /.+/;
var re2 = /[0-9]+/;

var OK0 = re.test(student_name);
var OK1 = re.test(project_title);
var OK2 = re.test(advisor);
var OK3 = re.test(meetings);
var OK4 = re.test(self_assessment);

if (OK0)
    document.getElementById("student_name").style.backgroundColor = '#fff';
else
    document.getElementById("student_name").style.backgroundColor = '#fa7f00';

if (OK1)
    document.getElementById("project_title").style.backgroundColor = '#fff';
else
    document.getElementById("project_title").style.backgroundColor = '#fa7f00';

if (OK2)
    document.getElementById("advisor_name").style.backgroundColor = '#fff';
else
    document.getElementById("advisor_name").style.backgroundColor = '#fa7f00';

if (OK3)
    document.getElementById("number_of_meetings").style.backgroundColor = '#fff';
else
    document.getElementById("number_of_meetings").style.backgroundColor = '#fa7f00';

if (OK4)
    document.getElementById("student_self_assessment").style.backgroundColor = '#fff';
else
    document.getElementById("student_self_assessment").style.backgroundColor = '#fa7f00';

var result = OK0 && OK1 && OK2 && OK3 && OK4;

if (!result)
    window.alert("Please check highlighted field(s)!");

return result;
}

function checkAdvisor() {

var advisor_read = document.getElementsByName('advisor_read');
var advisor_more_meetings = document.getElementsByName('advisor_more_meetings');
var student_progress_eval = document.getElementsByName('student_progress_eval');
var advisor_comments = document.getElementById('advisor_comments');

var checks = new Array(advisor_read, advisor_more_meetings, student_progress_eval);
var OK = new Array(false, false, false, true);

for (var i = 0; i < checks.length; i++) {
    var temp = checks[i];
    for (var j = 0; j < temp.length; j++) {
	if (temp[j].checked) {
	    OK[i] = true;
	    break;
	}
    }
}

if (document.getElementById('unsatisfactory').checked == true) {
    var re = /.+/;
    if (re.test(document.getElementById('faculty_comments').value)) {
	OK[3] = true;
	document.getElementById('faculty_comments').style.backgroundColor = "#fff";
    }

    else {
	OK[3] = false;
	document.getElementById('faculty_comments').style.backgroundColor = "#fa7f00";
    }
}

if (OK[0])
    document.getElementById('first').style.color='#000';
else
    document.getElementById('first').style.color='#fa7f00';

if (OK[1])
    document.getElementById('second').style.color='#000';
else
    document.getElementById('second').style.color='#fa7f00';

if (OK[2])
    document.getElementById('third').style.color='#000';
else
    document.getElementById('third').style.color='#fa7f00';

var result = OK[0] && OK[1] && OK[2] && OK[3];

if (!result)
   window.alert("Please check highlighted field(s)!");
return result;
}

</script>

{% endblock %}
{% block content %}


<form action="/forms/checkpoint" method="post" onsubmit="return checkAdvisor();">


<h3>Student Section:</h3>
  <div class="container">
    <div>
      <label>Student NetID: </label>
      <input type="text" name="student_netID" id="student_netID" value="" disabled />
        <input type="hidden" name="student_netID_hidden" value=""/>
    </div>
    <div>
      <label>Student Name:</label>
      <input type="text" name="student_name" id="student_name"/>
    </div>
    <div>
      <label>Title of Project:</label>
      <input type="text" name="project_title" id="project_title"/>
    </div>
    <div>
      <label>Advisor Name:</label>
      <input type="text" name="advisor_name" id="advisor_name"/>
    </div>
    <div>
      <label>Approx. Number of Meetings with Advisor (0, 1, 2, 3-5, etc.):</label>
      <input type="text" name="number_of_meetings" id="number_of_meetings"/>
    </div>
    <br>
    <div>
      <label>Student Self Assessment:</label>
      <textarea name="student_self_assessment" rows="5" cols="60" id="student_self_assessment"></textarea>
    </div>
  </div>


<h2>Princeton CS IW Checkpoint Form</h2>
<body onload="disable()">
<h3>Student Section:</h3>
  <div class="container">
    <div>
	  <label>Student NetID: </label> 
	  <input type="text" name="student_netID" id="student_netID" value="{{form.student_netID}}"/>
	  <input type="hidden" name="student_netID_hidden" id="student_netID" value="{{form.student_netID}}"/>
	</div>
    <div>
      <label>Student Name:</label>
      <input type="text" name="student_name" id="student_name" value="{{form.student_name}}"/>
    </div>
    <div>
      <label>Title of Project:</label>
      <input type="text" name="project_title" id="project_title" value="{{form.project_title}}"/>
    </div>
    <div>
      <label>Advisor Name:</label>
      <input type="text" name="advisor_name" id="advisor_name" value="{{form.advisor_name}}"/>
    </div>
    <div>
      <label>Approx. Number of Meetings with Advisor (0, 1, 2, 3-5, etc.):</label>
      <input type="text" name="number_of_meetings" id="number_of_meetings" value="{{form.number_of_meetings}}" />
    </div>
    <br>
    <div>
      <label>Student Self Assessment:</label>
      <textarea name="student_self_assessment" rows="5" cols="60" id="student_self_assessment">{{form.student_self_assessment}}</textarea>
    </div>
  </div>
 <h3>Advisor Section:</h3>
  <div class="container" >
    <div>
      <label id="first">I read the student's 1-page progress summary report</label>
      <div class="radio">
	<input type="radio" name="advisor_read" value="0" />Yes<br>
	<input type="radio" name="advisor_read" value="1" />No<br>
      </div>
    </div>
    <div>
      <label id="second">Would you like your student to meet with you more often?</label>
      <div class="radio">
	<input type="radio" name="advisor_more_meetings" value="0" />Yes<br>
	<input type="radio" name="advisor_more_meetings" value="1" />No<br>
      </div>
    </div>
    <br>
    <div>
      <label id="third">Student Progress:</label>
      <div class="radio">
	<input type="radio" name="student_progress_eval" value="0" />Exceptional<br>
	<input type="radio" name="student_progress_eval" value="1" />Very Good<br>
	<input type="radio" name="student_progress_eval" value="2" />Good<br>
	<input type="radio" name="student_progress_eval" value="3" id="unsatisfactory" />Unsatisfactory<br>
      </div>
    </div>
    <div>
      <label>Comments: <br> [If student progress is unsatisfactory, explain what steps they need to take to get on track.]</label>
      <textarea name="advisor_comments" id="advisor_comments" rows="4" cols="60"></textarea>
    </div>
</body>
    <div id="submit">
      <input type="submit" value="Submit">
    </div>

  </div>
</form>

<hr>

{% endblock %}
