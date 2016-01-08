{% if auth %}
	<p>Hello, {{auth.getFullNameOrUsername()}}
		<img src = "{{ auth.getAvatarUrl({size: 30}) }}" alt = "Avatar">
	</p>
{% endif %}

<ul>
   <li>
      <a href = "{{ urlFor('home') }}">Home</a>
   </li>

   {% if auth %}
   	   <li><a href = "{{ urlFor('logout') }}">Log Out</a></li>
   	   <li><a href="{{ urlFor('user.profile', {username: auth.username}) }}">Your Profile</a></li>
         
         <li><a href="{{ urlFor('levels') }}">Lets Play</a></li>

         {% if auth.isAdmin %}
            <li> <a href="{{ urlFor('admin.example') }}">Admin Area</a> </li>
   	   {% endif %}

   	   <form action="{{ urlFor('user.search.post') }}" method="post">
    		   <input type="search" name="user_search" placeholder="Search..." id="search">
		      <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
	      </form> 

         <li>
               <a href="{{ urlFor('user.all') }}">All Users</a>
         </li>

   {% else %}
	   <li>
	      <a href = "{{ urlFor('register') }}">Register</a>
	   </li>
	   <li>
	      <a href = "{{ urlFor('login') }}">Login</a>
	   </li>
   {% endif %}
</ul>