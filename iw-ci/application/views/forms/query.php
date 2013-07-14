{% extends "base.html.twig" %}
{% block title %}Form Query{% endblock %}
{% block content %}
<h2>Form Query</h2>

<div class="container">

  <p>Search for a form using specified criteria. Leave form type blank if you wish to find all the forms of a particular student or advisor.</p>
  <form action="/forms/query", method="post">
    <div>
      <label>Student Name:</label>
      <input type="text" name="student_name"/>
    </div>
    <div>
      <label>Student NetID:</label>
      <input type="text" name="student_netID"/>
    </div>
    <div>
      <label>Advisor Name:</label>
      <input type="text" name="advisor_name"/>
    </div>
    <div>
      <label>Advisor Name:</label>
      <input type="text" name="advisor_netID"/>
    </div>
    <div>
      <div class="radio">
        <input type="radio" name="form_type" value="signup">Signup Form<br>
        <input type="radio" name="form_type" value="checkpoint">Checkpoint Form<br>
        <input type="radio" name="form_type" value="february">February Form<br>
        <input type="radio" name="form_type" value="second_reader">Second Reader Form<br>
      </div>
    </div>
    <div id="submit">
      <input type="submit" value="Submit">
    </div>
  </form>
</div>

<hr>
{% endblock %}
