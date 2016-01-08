{% extends 'email/templates/default.php' %}

{% block content %}
	<p>You have been registered!</p>
	<p>Click on the following link in order to activate your account: {{ baseUrl }}{{ urlFor('auth.activate') }}?email={{ user.email }}&identifier={{ identifier|url_encode }}</p>
{% endblock %}