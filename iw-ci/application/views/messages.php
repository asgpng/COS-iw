{% extends "base.html.twig" %}
{% block title %}Messages{% endblock %}
{% block content %}

<div class="container">
  {% for message in messages %}
  <p>
    At {{message.date}} <b>{{message.author_netID}}</b> wrote: <br>
    "{{message.content}}"<br>
  </p>
  {% endfor %}

  <form action="messages" method="post">
    <div>
      <textarea name="content" rows="8" cols="40"></textarea>
    </div>
    <div id="submit">
      <input type="submit" value="Submit">
    </div>
  </form>
</div>
{% endblock %}
