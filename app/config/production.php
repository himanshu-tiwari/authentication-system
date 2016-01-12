<?php

return[
     'app' => [
          'url' => 'https://polar-mesa-8063.herokuapp.com',
          'hash' =>[
               'algo' => PASSWORD_BCRYPT,
               'cost' => 10
          ]
     ],
     'db' => [
          'driver' => 'mysql',
          'host' => '127.0.0.1',
          'name' => 'site',
          'username' => '',
     	    'password' => '',
          'charset' => 'utf8',
          'collation' => 'utf8_unicode_ci',
          'prefix' => ''
      ],
      'auth' =>[
           'session' => 'user_id',
           'remember' => 'user_r'
      ],
      'mail' =>[
           'secret' => 'key-476072bc39befde93ba249e16ffd3443',
           'domain' => 'sandbox1425eb5c92ca46a1b0cdc631f5785508.mailgun.org',
           'from' => 'Mailgun Sandbox <postmaster@sandbox1425eb5c92ca46a1b0cdc631f5785508.mailgun.org>',
      ],
      'twig' =>[
           'debug' => true
      ],
      'csrf' => [
           'key' => 'csrf_token'
      ]
];

?>