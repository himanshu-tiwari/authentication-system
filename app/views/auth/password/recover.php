{% extends 'templates/default.php' %}

{% block title %}Recover{% endblock %}

{% block content %}
	
	<p>Enter Email address to start password recovery.</p>
	<form action="{{ urlFor('password.recover.post') }}" method="post" autocomplete="off" {% if request.post('email') %} value="{{ request.post('email') }}" {% endif %}>
		<div>
			<label for="email">Email</label>
			<input type="text" name="email", id="email">
			{% if errors.has('email') %}{{ errors.first('email') }}{% endif %}
		</div>
		<div>
			<input type="submit" value="Request Reset">
		</div>	
		<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
	</form>

{% endblock %}
