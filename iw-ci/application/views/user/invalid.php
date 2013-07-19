<h1>User Entry Redirect</h1>
<p>Your user submission has been declined because the user <b>{{netID}}</b> of type <b>{{user_type}}</b> already exists.</p>
<!-- update with user query -->
<a href="user_view?{{ {'user_type':user.user_type, 'user_netID':user.netID} | urlencode}}">View previous submission </a>
