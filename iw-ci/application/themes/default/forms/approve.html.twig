{% extends "base.html.twig" %}
{% block title %}Approve Students as your Advisees{% endblock %}
{% block head %}
<script type="text/javascript">

function check() {

    var check1;
    var check2;

var student = document.getElementById("chosen_student").value;
if (student == 0) 
    check1 = false;

else
    check1 = true;

var radios = document.getElementsByName("agreement");
    if ((radios[0].checked) || (radios[1].checked))
	check2 = true;

    else
	check2 = false;

    var result = check1 && check2;
    if (!result)
	alert("Please make a selection")

	    return result;
}

function check_sr() {

    var check1;
    var check2;

var student = document.getElementById("chosen_student_sr").value;
if (student == 0) 
    check1 = false;

else
    check1 = true;

var radios = document.getElementsByName("agreement_sr");
    if ((radios[0].checked) || (radios[1].checked))
	check2 = true;

    else
	check2 = false;

    var result = check1 && check2;
    if (!result)
	alert("Please make a selection")

	    return result;
}

</script>
{% endblock %}
{% block header %}
{% endblock %}

{% block content %}

<div class="container">
  <form action="/forms/approve" method="post" onsubmit="return check();">
  <div>
    <label>Pending requests by netID:</label>
    <select name="chosen_student" id="chosen_student">
      <option value="0">Please select a student</option>
      {% for student in current_user.student_requests %}
      <option value="{{student}}"> {{ student }} - Advisor Requested </option>
      {% endfor %}
      {% for student in current_user.second_reader_requests %}
      <option value="{{student}}"> {{ student }} - Second Reader Requested </option>
      {% endfor %}
      </select>
  </div>
  <br>
  <div class="radio">
    <input type="radio" name="agreement" value="yes">I agree to be this student's advisor/second reader.<br>
    <input type="radio" name="agreement" value="no">I do not agree to be this student's advisor/second reader.<br>
  </div>
  <div>
    <input type="submit" value="Submit"/>
  </div>
  </form>
<br>
{% endblock %}
{% block footer %}
{% endblock %}
