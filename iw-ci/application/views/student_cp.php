{% extends "base.html.twig" %}
{% block student %}
{% if not_init %}
<h3>You must fill out the sign-up form to initialize the independent research process for the current semester.</h3>
{% else %}
<h1>Student Control Panel</h1>
<h3>Current Status</h3>
<div class="container">
<br>
<div>
<label>Current Advisor:
<b>   {{ advisor_netID}} </b>
{% if approved_advisor %}
(Approved)
{% else %}
(Request Pending)
{% endif %}
</label>
</div>
{% endif %}

<label>Current Second Reader:
<b>   {{ sr_netID}} </b>
{% if sr_netID != None %}
({{approved_sr}})
{% endif %}
</label>
</div>
{% endblock %}
