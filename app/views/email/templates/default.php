{% if auth.getFullNameOrUsername() %}
	<p>Hello {{ auth.getFullNameOrUsername() }}!</p>
{% else %}
	<p>Hello there!</p>
{% endif %}

{% block content %}{% endblock %}