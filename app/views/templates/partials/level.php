{% if auth.hasPermission('can_access_level1') %}
	<li><a href="{{ urlFor('levels.level1') }}">Go To Level 1</a></li>
{% endif %}

{% if auth.hasPermission('can_access_level2') %}
	<li><a href="{{ urlFor('levels.level2') }}">Go To Level 2</a></li>
{% endif %}

{% if auth.hasPermission('can_access_level3') %}
	<li><a href="{{ urlFor('levels.level3') }}">Go To Level 3</a></li>
{% endif %}