<script type="text/javascript">

  //     function invalid() {

  //     alert("The inputted faculty netID was not found on the server!");
  // }

  function proceed() {

  var proceed =  highlight(year(), radio(), text0(), text1(), text2(), text3(), text4(), signature());
  if (!proceed) {
  window.alert("Please check highlighted field(s)!");
  }

  return proceed;
  }

  function highlight(year, radio, text0, text1, text2, text3, text4, sig) {

  if (year)
  document.getElementById("class_year").style.backgroundColor='#fff';
  else
  document.getElementById("class_year").style.backgroundColor='#fa7f00';

  if (radio)
  document.getElementById("radioHL").style.color='#000';
  else
  document.getElementById("radioHL").style.color='#fa7f00';

  if (text0)
  document.getElementById("student_name").style.backgroundColor='#fff';
  else
  document.getElementById("student_name").style.backgroundColor='#fa7f00';

  if (text1)
  document.getElementById("project_title").style.backgroundColor='#fff';
  else
  document.getElementById("project_title").style.backgroundColor='#fa7f00';

  if (text2)
  document.getElementById("description").style.backgroundColor='#fff';
  else
  document.getElementById("description").style.backgroundColor='#fa7f00';

  if (text3)
  document.getElementById("advisor_name").style.backgroundColor='#fff';
  else
  document.getElementById("advisor_name").style.backgroundColor='#fa7f00';

  if (text4)
  document.getElementById("advisor_netID").style.backgroundColor='#fff';
  else
  document.getElementById("advisor_netID").style.backgroundColor='#fa7f00';

  if (sig)
  document.getElementById("sigHL").style.color='#fff';
  else
  document.getElementById("sigHL").style.color='#fa7f00';

  var checked = year && radio && text0 && text1 && text2 && text3 && text4 && sig;
  return checked;

  }

  function year() {

  var re = /^\d{4}$/;
  var year = document.getElementById("class_year").value;

  return re.test(year);
  }

  function radio() {

  var radios = document.getElementsByName("coursework");
  var OK = false;

  for (var i = 0;i<radios.length;i++) {
                                      if (radios[i].checked) {
	                                  OK = true;
	                                  break; }
                                      }
                                      return(OK);
                                      }

                                      function text0() {

                                      var re = /.+/;
                                      var name = document.getElementById("student_name").value;
                                      return re.test(name);
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
                                      var advisor_name = document.getElementById("advisor_name").value;

                                      return re.test(advisor_name);
                                      }

                                      function text4() {

                                      var re = /.+/;
                                      var advisor_netID = document.getElementById("advisor_netID").value;

                                      return re.test(advisor_netID);
                                      }

                                      function signature() {
                                      return document.getElementById("signature").checked;
                                      }
				                      </script>

{% endblock %}

{% block student %}
{% if invalid_netID %}
<body onload=invalid()> </body>
{% endif %}
<h2>Princeton CS IW & Thesis Signup Form</h2>
<b><?php echo validation_errors(); ?></b>
<?php echo form_open('defaults/login'); ?>

<form action="/iw-ci/index.php/forms/signup" method="post" onsubmit="return proceed();">
  <div>
	<label>Student NetID:</label>
	<input type="text" name="student_netID" value="<?php echo set_value('netID'); ?>" />
	<!-- <input type="hidden" name="student_netID_hidden" value="{{ current_user.netID }}"> -->
	<div>
      <label>Name:</label>
      <input type="text" name="student_name" id="student_name">
    </div>
    <div>
      <label>Class:</label>
      <input type="text" name="class_year" id="class_year"/>
    </div>
    <div>
      <label id="radioHL">Please check one:</label>
	</div>
    <div class = "radio">
      <Input type="radio" name="coursework" value="0">397<br>
      <input type="radio" name="coursework" value="1">398<br>
      <input type="radio" name="coursework" value="2">497<br>
      <input type="radio" name="coursework" value="3">498<br>
      <input type="radio" name="coursework" value="4">AB JIW<br>
      <input type="radio" name="coursework" value="5">AB Senior Thesis<br>
      <input type="radio" name="coursework" value="6">BSE Senior Thesis<br>
	</div>
    <div>
      <label>Title of Project:</label>
      <textarea name="project_title" id="project_title"></textarea>
    </div>
    <div>
      <label>Description:</label>
      <textarea name="description" id="description" rows="10" cols="23"></textarea>
      <div>
        <label>Advisor's Name:</label>
        <input type="text" name="advisor_name" id="advisor_name"/>
      </div>
	  <div>
	    <label>Advisor's NetID:</label>
	    <input type="text" name="advisor_netID" id="advisor_netID" />
	  </div>
      <div>
        <label>Advisor's Department:</label>
	    <select name="advisor_department">
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
	  <label id="sigHL">I agree to be responsible for all relevant deadlines.</label>
	  <input type="checkbox" name="signature" id="signature"/>
      <div id="submit">
        <input type="submit" value="Submit">
      </div>
    </div>
  </div>
</form>
<hr>
