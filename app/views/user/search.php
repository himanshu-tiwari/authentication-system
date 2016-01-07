{% extends 'templates/default.php' %}

{% block title %}Results{% endblock %} 

{% block content %}
    <h2>search Results</h2>

    {% if users is empty %} 
        <p>no registered users.</p>
    {% else %}
        {% for user in users %}
            <div class="user">
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