{% extends 'templates/default.php' %}

{% block title %}All Users{% endblock %}

{% block content %}

	<h2>All Users</h2>

	{% if users is empty %}
		<p>No registered users</p>
	{% else %}
		{% for user in users %}
			<div>
				<a href="{{ urlFor('user.profile', {username: user.username}) }}">{{ user.username }}</a>
				{% if user.getFullName %}
					({{ user.getFullName }})
				{% endif %}

                {% if auth.isAdmin %}
                    (Admin)
                {% endif %}
			</div>
		{% endfor %}
	{% endif %}

{% endblock %}
