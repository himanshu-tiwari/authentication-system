{% extends 'templates/default.php' %}

{% block title %}{{ user.getFullNameOrUsername }}{% endblock %}

{% block content %}
	<h2>{{ user.username }}</h2>
	<img src="{{ user.getAvatarUrl({size: 30}) }}" alt="Profile picture for {{ user.getFullNameOrUsername }}">

	<dl>
		{% if user.getFullName %}
			<dt>Full Nmae</dt>
			<dd>{{ user.getFullName }}</dd>
		{% endif %}

		<dt>Email</dt>
		<dd>{{ user.email }}</dd>
	</dl>
    
    {% if auth %}
 		<li><a href="{{ urlFor('password.change') }}">Change Password</a></li>

 		<li><a href="{{ urlFor('account.profile') }}">Update Profile</a></li> 
 	{% endif %}

{% endblock %}
