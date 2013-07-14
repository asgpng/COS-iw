{% extends "base.html.twig" %}
{% block head %}
<script type = "text/javascript">


function disable() {

document.getElementById("student_netID").disabled=true;
document.getElementById("student_name").disabled=true;
document.getElementById("project_title").disabled=true;
document.getElementById("advisor_name").disabled=true;
document.getElementById("number_of_meetings").disabled=true;
document.getElementById("student_comments").disabled=true;

}

function checkStudent() {

var student_name = document.getElementById("student_name").value;
var project_title = document.getElementById("project_title").value;
var advisor = document.getElementById("advisor_name").value;
var meetings = document.getElementById("number_of_meetings").value;

var re = /.+/;
var re2 = /[0-9]+/;

var OK0 = re.test(student_name);
var OK1 = re.test(project_title);
var OK2 = re.test(advisor);
var OK3 = re2.test(meetings);

if (OK0)
    document.getElementById("student_name").style.backgroundColor='#fff';
else
    document.getElementById("student_name").style.backgroundColor='#fa7f00';

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


var result = OK0 && OK1 && OK2 && OK3;

if (!result)
    window.alert("Please check highlighted field(s)!");

return result;
}

function checkAdvisor() {

var read = document.getElementsByName('advisor_read');
var meetings = document.getElementsByName('advisor_more_meetings');
var progress = document.getElementsByName('student_progress_eval');

var checks = new Array(read, meetings, progress);
var OK = new Array(false, false, false);

for (var i = 0; i < checks.length; i++) {
    var temp = checks[i];
    for (var j = 0; j < temp.length; j++) {
        if (temp[j].checked) {
           OK[i] = true;
           break;
	}
    }
}

if (OK[0])
    document.getElementById("first").style.color='#000';
else
    document.getElementById("first").style.color='#fa7f00';


if (OK[1])
    document.getElementById("second").style.color='#000';
else
    document.getElementById("second").style.color='#fa7f00';


if (OK[2])
    document.getElementById("third").style.color='#000';
else
    document.getElementById("third").style.color='#fa7f00';

var result = OK[0] && OK[1] && OK[2];

if (!result)
    window.alert("Please check highlighted field(s)!");

return result;
}

</script>
{% endblock %}

{% block title %}February Progress Form
{% endblock %}
{% block header %}
<h2>Thesis &amp; IW 2 Semester February Progress Form</h2>
<div class="container">
{% if  current_user.user_type=="student" %}
<form action="/forms/february" method="post" onsubmit ="return checkStudent();">
{% elseif current_user.user_type=="faculty" %}
<form action="/forms/february" method="post" onsubmit ="return checkAdvisor();">
{% endif %}
{% endblock %}

{% block studentOnly %}
  <h3>Student Section:</h3>

  <div>
    <label>Student NetID:</label>
    <input type="text" name="student_netID" id="student_netID" value="{{current_user.netID}}" disabled/>
    <input type="hidden" name="student_netID_hidden" value="{{current_user.netID}}">
  </div>
  <div>
    <label>Student Name:</label>
    <input type="text" name="student_name" id="student_name"/>
  </div>
  <div>
    <label>Title of Project:</label>
    <textarea name="project_title" id="project_title" rows="2" cols="23"></textarea>
  </div>
    <div>
    <label>Advisor Name:</label>
    <input type="text" name="advisor_name" id="advisor_name"/>
  </div>
  <div>
    <label>Approximate Number of Meetings with Advisor (0, 1, 2, 3-5, etc.):</label>
    <input type="text" name="number_of_meetings" id="number_of_meetings"/>
  </div>
  <br>
  <div>
    <label>Student Comments:</label>
    <textarea name="student_comments" id="student_comments" rows="2" cols="23"></textarea>
  </div>
{% endblock %}
{% block advisor %}
<body onload="disable()">
  <h3>Student Section:</h3>

  <div>
    <label>Student NetID:</label>
    <input type="text" name="student_netID" id="student_netID" value="{{form.student_netID}}"/>
    <input type="hidden" name="student_netID_hidden" value="{{form.student_netID}}">
  </div>
      <label>Student Name:</label>
    <input type="text" name="student_name" id="student_name" value="{{form.student_name}}" />
  </div>
  <div>
    <label>Title of Project:</label>
    <textarea name="project_title" id="project_title" rows="2" cols="23">{{form.project_title}}</textarea>
  </div>
  <div>
    <label>Advisor:</label>
    <input type="text" name="advisor_name" id="advisor_name" value="{{form.advisor_name}}" />
  </div>
  <div>
    <label>Approximate Number of Meetings with Advisor (0, 1, 2, 3-5, etc.):</label>
    <input type="text" name="number_of_meetings" id="number_of_meetings" value="{{form.number_of_meetings}}"/>
  </div>
  <br>
  <div>
    <label>Student Comments:</label>
    <textarea name="student_comments" id="student_comments" rows="2" cols="23">{{form.student_comments}}</textarea>
  </div>
    <h3>Advisor Section:</h3>
    <div>
      <label id="first">I read the student's 5-page progress research paper:</label>
      <div class="radio">
        <input type="radio" name="advisor_read" value="0">Yes<br>
        <input type="radio" name="advisor_read" value="1">No<br>
      </div>
    </div>
    <div>
      <label id="second">Would you like your student to meet with you more often?</label>
      <div class="radio">
        <input type="radio" name="advisor_more_meetings" value="0">Yes<br>
        <input type="radio" name="advisor_more_meetings" value="1">No<br>
      </div>
    </div>
    <br>
    <div>
      <label id="third">Student Progress:</label>
      <div class="radio">
        <input type="radio" name="student_progress_eval" value="0">Sensational<br>
        <input type="radio" name="student_progress_eval" value="1">Good<br>
        <input type="radio" name="student_progress_eval" value="2">Unsatisfactory<br>
      </div>
    </div>
    <div>
      <label>Advisor Comments:</label>
      <textarea name="advisor_comments" rows="2" cols="23"></textarea>
    </div>
</body>
{% endblock %}
{% block submit %}
    <div id="submit">
      <input type="submit" value="Submit">
    </div>

  </form>
</div>

<hr>
{% endblock %}
