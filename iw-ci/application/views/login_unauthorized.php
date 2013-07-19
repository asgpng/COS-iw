<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="en">
  <head>
    <link rel="stylesheet" type="text/css" href="/stylesheets/main.css" />
    <title>Login Unauthorized - COS IW</title>
  </head>
  <body>
    <div id="title">
      <h1>Department of Computer Science</h1>
    </div>
    <h2>Login Unauthorized</h2>
    {% if netID %}
    <p>There is no entry for user <b>{{netID}}</b> in the COS IW database. Please contact the <a href="mailto:ckenny@cs.princeton.edu">COS department administrator</a> if you would like to gain access to this web application.
    </p>
    {% else %}
    <p>You must enter your netID and password in order to login.</p>
    {% endif %}
    <hr>
    <a href="/">Return to Login</a>
  </body>
</html>
