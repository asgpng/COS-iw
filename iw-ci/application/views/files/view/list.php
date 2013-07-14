{% extends "base.html.twig" %}
{% block title %}View Uploaded Files{% endblock %}
{% block content %}
<h2>View Uploaded Files</h2>
{% for blob in blobs %}
{{blob}}<br>
<a href="/files/view_single?{{ {'blob_key':blob.blob_key} | urlencode }}">View File</a><br>
<a href="/files/delete?{{ {'blob_key':blob.blob_key} | urlencode }}">Delete</a><br>

<br>
{% endfor %}
<br>
{% endblock %}
