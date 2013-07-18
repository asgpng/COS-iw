{% extends "base.html.twig" %}
{% block title %}View Uploaded Files{% endblock %}
{% block content %}
<h2>View User List</h2>
{% if added_users %}
<p>The following users have been added to the user database:</p>
<table border="1">
  <tr>
    <th>User Type:</th>
    <th>User netID:</th>
    <th>Link:</th>
    <th>Delete:</th>
  </tr>
  {% for user in added_users %}
  <tr>
    <td>{{ user.user_type }}</td>
    <td>{{ user.netID }}</td>
    <td><a href="user_view?{{ {'user_type':user.user_type, 'user_netID':user.netID} | urlencode}}">View complete result </a></td>
    <!-- potential security issue -->
    <td><a href="user_delete?{{ {'user_type':user.user_type, 'netID':user.netID} | urlencode}}">delete user </a></td>
  </tr>
{% endfor %}
</table>
{% else %}
<p>No new users have been added to the user database.</p>
{% endif %}
<br>
<a href="/admin/users">View Users</a>
{% endblock %}
