{% extends 'templates/default.php' %}

{% block title %}Login{% endblock %}

{% block content %}

  <form action = "{{ urlFor('login.post') }}" method = "post" autocomplete = "off">
  	<div>
  		<label for = "identifier">Username/Email</label>
  		<input type = "text" name = "identifier" id = "identifier" {% if request.post('identifier') %}value = "{{ request.post('identifier') }}" {% endif %}>
      {% if errors.first('identifier') %}{{ errors.first('identifier') }}{% endif %}

  	</div>
  	<div>
  		<label for = "password">Password</label>
  		<input type = "password" name = "password" id = "password">
      {% if errors.first('password') %}{{ errors.first('password') }}{% endif %}
  	</div>
    <div>
      <input type="checkbox" name="remember" id="remember"> <label for="remember">Remember Me</label>
    </div>
  	<div>
  		<input type = "submit" value = "Login">
  	</div>

    <input type = "hidden" name = "{{ csrf_key }}" value = "{{ csrf_token }}"/>

  </form>

{% endblock %}