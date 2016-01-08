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

 	<li><a href="{{ urlFor('auth.password.change') }}">Change Password</a></li>

{% endblock %}
